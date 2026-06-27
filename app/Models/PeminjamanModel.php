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
    
    protected $allowedFields    = [
        'kode_peminjaman',
        'id_member', 
        'id_buku', 
        'tanggal_pinjam', 
        'tanggal_harus_kembali',
        'durasi_pinjam',
        'tanggal_dikembalikan',
        'status',
        'denda',
    ];
    protected $useTimestamps    = true; 

    /**
     * Buat kode peminjaman unik berurutan per hari
     * Contoh hasil: PJM202606190001, PJM202606190002, dst.
     */
    public function generateCode(): string
    {
        $prefix = 'PJM' . date('Ymd');

        $last = $this->db->table('peminjaman')
            ->like('kode_peminjaman', $prefix, 'after')
            ->orderBy('id_peminjaman', 'DESC')
            ->limit(1)
            ->get()
            ->getRowArray();

        $seq = 1;
        if ($last && !empty($last['kode_peminjaman'])) {
            $seq = (int) substr($last['kode_peminjaman'], -4) + 1;
        }

        return $prefix . str_pad($seq, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Ambil semua peminjaman milik satu anggota (JOIN dengan tabel books)
     */
    public function getByMember(int $idMember): array
    {
        return $this->db->table('peminjaman')
            ->select('peminjaman.*, books.code_book, books.title_book, books.author_book')
            ->join('books', 'books.id_book = peminjaman.id_buku', 'left')
            ->where('peminjaman.id_member', $idMember)
            ->orderBy('peminjaman.id_peminjaman', 'DESC')
            ->get()
            ->getResultArray();
    }
}