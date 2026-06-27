<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table            = 'peminjaman';
    protected $primaryKey       = 'id_peminjaman';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Sesuai panduan dosen, Soft Deletes dimatikan (false) untuk transaksi
    protected $useSoftDeletes   = false; 
    
    protected $allowedFields    = ['id_member', 'id_buku', 'tanggal_pinjam', 'tanggal_harus_kembali'];
    protected $useTimestamps    = true; 
}