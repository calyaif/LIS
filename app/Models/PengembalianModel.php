<?php

namespace App\Models;
use CodeIgniter\Model;

class PengembalianModel extends Model
{
    protected $table            = 'pengembalian';
    protected $primaryKey       = 'id_pengembalian';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false; // Transaksi tidak pakai tong sampah
    protected $allowedFields    = ['id_peminjaman', 'tanggal_dikembalikan', 'denda', 'kondisi_buku'];
    protected $useTimestamps    = true;
}