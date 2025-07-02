<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    
    // PENTING: Pastikan semua field yang bisa diupdate ada di sini
    protected $allowedFields = [
        'judul', 
        'isi', 
        'slug', 
        'id_kategori',  // <- Pastikan ini ada
        'gambar', 
        'status'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation (opsional, bisa dipindah ke controller)
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    // Custom methods
    public function getArtikelDenganKategori()
    {
        return $this->select('artikel.*, COALESCE(kategori.nama_kategori, "Tidak ada kategori") as nama_kategori')
                    ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left')
                    ->where('artikel.status', 'published')
                    ->findAll();
    }

    public function getArtikelBySlugDenganKategori($slug)
    {
        return $this->select('artikel.*, COALESCE(kategori.nama_kategori, "Tidak ada kategori") as nama_kategori')
                    ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left')
                    ->where('artikel.slug', $slug)
                    ->where('artikel.status', 'published')
                    ->first();
    }

    public function getArtikelByKategori($id_kategori)
    {
        return $this->select('artikel.*, kategori.nama_kategori')
                    ->join('kategori', 'kategori.id_kategori = artikel.id_kategori')
                    ->where('artikel.id_kategori', $id_kategori)
                    ->where('artikel.status', 'published')
                    ->findAll();
    }
}