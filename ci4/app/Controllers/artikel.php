<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\KategoriModel; 
use CodeIgniter\Exceptions\PageNotFoundException;

class Artikel extends BaseController
{
    public function index()
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        $artikel = $model->findAll();
        return view('artikel/index', compact('artikel', 'title'));
    }

    public function view($slug)
    {
        $model = new ArtikelModel();
        $data['artikel'] = $model->where('slug', $slug)->first();
        if (empty($data['artikel'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the article.');
        }
        $data['title'] = $data['artikel']['judul'];
        $artikel = $model->where('slug', $slug)->first();
        
        // Jika artikel tidak ditemukan, tampilkan 404
        if (!$artikel) {
            throw PageNotFoundException::forPageNotFound();
        }
        
        $title = $artikel['judul'];
        return view('artikel/detail', compact('artikel', 'title'));
    }

    public function admin_index()
{
    $title = 'Daftar Artikel (Admin)';
    $q = $this->request->getVar('q') ?? '';
    $kategori = $this->request->getVar('kategori') ?? '';
    
    $model = new ArtikelModel();
    $query = $model;

    // get search keyword 
    $q = $this->request->getVar('q') ?? '' ;

    // get category filter 
    $kategori_id = $this->request->getVar('kategori_id') ?? '' ;
    $page = $this->request->getVar('page') ?? 1;

    
    if ($q) {
        $query = $query->like('judul', $q);
    }
    
    if ($kategori) {
        $query = $query->where('kategori', $kategori);
    }
    
    $data = [
        'title'       => $title,
        'q'           => $q,
        'id_kategori' => $kategori_id,
        'artikel'     => $query->paginate(10), #data dibatasi 10 record per halaman 
        'pager'       => $model->pager,
        'kategoris'   => $model->distinct()->select('kategori')->findAll()
    ];
    
    // Building the query 
    $builder = $model->table('artikel')
        ->select('artikel.*, kategori.nama_kategori')
                 ->join('kategori', 'kategori.id_kategori = artikel.id_kategori'); 
    // Apply search filter if keyword is provided
    if ($q != '') {
        $builder->like('artikel.judul', $q);
}
// Apply category filter if category_id is provided
if ($kategori_id != '') {
    $builder->where('artikel.id_kategori', $kategori_id);
}


// Apply pagination
$data['artikel'] = $builder->paginate(10);
$data['pager'] = $model->pager;

// Fetch all categories for the filter dropdown
$kategoriModel = new KategoriModel();
$data['kategori'] = $kategoriModel->findAll();

    return view('artikel/admin_index', $data);

    if ($this->request->isAJAX()) {
return $this->response->setJSON($data);
} else {
$kategoriModel = new KategoriModel();
$data['kategori'] = $kategoriModel->findAll();
return view('artikel/admin_index', $data);
}

}

// ... (methods add, edit, delete remain largely the same , but update to handle id_kategori)
public function add()
{
// Validation...
if ($this->request->getMethod() == 'post' && $this->validate([
        'judul' => 'required',
        'id_kategori' => 'required|integer' // Ensure id_kategori is required and an integer
])) {
        $model = new ArtikelModel();
        $model->insert([
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'slug' => url_title($this->request->getPost('judul')),
            'id_kategori' => $this->request->getPost('id_kategori')
]);
        return redirect()->to('/admin/artikel');
} else {
    $kategoriModel = new KategoriModel();
    $data['kategori'] = $kategoriModel->findAll(); // Fetch categoriesfor the form

        $data['title'] = "Tambah Artikel";return view('artikel/form_add', $data);

}
}

    public function edit($id = null)
    {
        $model = new ArtikelModel();
        if ($this->request->getMethod() == 'post' && $this->validate([
            'judul' => 'required',
            'id_kategori' => 'required|integer'
        ])) {
            $model->update($id, [
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'id_kategori' => $this->request->getPost('id_kategori')
            ]);
            return redirect()->to('/admin/artikel');
        } else {
            $data['artikel'] = $model->find($id);
            $kategoriModel = new KategoriModel();
            $data['kategori'] = $kategoriModel->findAll(); // Fetch categories for the form
            $data['title'] = "Edit Artikel";
            return view('artikel/form_edit', $data); 
        }

        $artikel = $model->where('id', $id)->first();
        
        if (!$artikel) {
            throw PageNotFoundException::forPageNotFound();
        }
        
        // Validasi form jika ada POST request
        if ($this->request->getMethod() === 'post') {
            // Ambil data dari form
            $data = [
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'slug' => url_title($this->request->getPost('judul'), '-', true),
                'kategori' => $this->request->getPost('kategori'),
                'status' => $this->request->getPost('status') ?? $artikel['status']
            ];
            
            // Upload gambar jika ada
            $file = $this->request->getFile('gambar');
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/gambar', $newName);
                $data['gambar'] = $newName;
                
                // Hapus gambar lama jika ada
                if ($artikel['gambar'] && file_exists(ROOTPATH . 'public/gambar/' . $artikel['gambar'])) {
                    unlink(ROOTPATH . 'public/gambar/' . $artikel['gambar']);
                }
            }
            
            // Update artikel
            $model->update($id, $data);
            
            return redirect()->to('/admin/artikel');
        }
        
        $title = 'Edit Artikel';
        return view('artikel/form_edit', compact('artikel', 'title'));
    }

    public function delete($id = null)
    {
        $model = new ArtikelModel();
        $artikel = $model->where('id', $id)->first();
        
        if (!$artikel) {
            throw PageNotFoundException::forPageNotFound();
        }
        
        // Hapus gambar jika ada
        if ($artikel['gambar'] && file_exists(ROOTPATH . 'public/gambar/' . $artikel['gambar'])) {
            unlink(ROOTPATH . 'public/gambar/' . $artikel['gambar']);
        }
        
        $model->delete($id);
        return redirect()->to('/admin/artikel');
    }   

    public function data()
{
    $model = new ArtikelModel();
    $data = $model->findAll();
    return $this->response->setJSON($data);
}

}