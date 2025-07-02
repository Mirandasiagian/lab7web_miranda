<?php

namespace App\Cells;

use App\Models\ArtikelModel;

class ArtikelTerkini
{
    public function render($kategori = null)
    {
        $model = new ArtikelModel();
        
        try {
            if ($kategori !== null) {
                // Gunakan where dengan nilai string yang valid
                $artikel = $model->where('kategori', $kategori)
                                ->orderBy('created_at', 'DESC')
                                ->limit(5)
                                ->findAll();
            } else {
                // Jika tidak ada kategori, ambil semua artikel
                $artikel = $model->orderBy('created_at', 'DESC')
                                ->limit(5)
                                ->findAll();
            }
        } catch (\Exception $e) {
            // Tangkap error dan berikan array kosong sebagai fallback
            $artikel = [];
            log_message('error', 'Error di ArtikelTerkini: ' . $e->getMessage());
        }
        
        return view('components/artikel_terkini', [
            'artikel' => $artikel,
            'kategori' => $kategori
        ]);
    }
}