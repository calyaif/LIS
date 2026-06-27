<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        // 1. AMBIL SEMUA ID MEMBER DAN ID BUKU YANG ADA DI DATABASE
        $members = $this->db->table('members')->select('id_member')->get()->getResultArray();
        $books   = $this->db->table('books')->select('id_book')->get()->getResultArray();

        // Cek kalau datanya kosong
        if (empty($members) || empty($books)) {
            echo "Gagal: Data Member atau Buku masih kosong di database!\n";
            return;
        }

        // 2. AMBIL ID SECARA ACAK (RANDOM) DARI DATA YANG ADA
        $id_member_1 = $members[array_rand($members)]['id_member'];
        $id_buku_1   = $books[array_rand($books)]['id_book'];
        
        $id_member_2 = $members[array_rand($members)]['id_member'];
        $id_buku_2   = $books[array_rand($books)]['id_book'];

        // ==========================================
        // 3. MASUKKAN DATA PEMINJAMAN & AMBIL ID BARUNYA
        // ==========================================
        
        // Transaksi 1
        $this->db->table('peminjaman')->insert([
            'id_member'             => $id_member_1, 
            'id_buku'               => $id_buku_1, 
            'tanggal_pinjam'        => '2026-05-10',
            'tanggal_harus_kembali' => '2026-05-17',
            'created_at'            => Time::now(),
            'updated_at'            => Time::now(),
        ]);
        // Tangkap ID Peminjaman yang baru saja dibuat!
        $id_peminjaman_1 = $this->db->insertID(); 

        // Transaksi 2
        $this->db->table('peminjaman')->insert([
            'id_member'             => $id_member_2,
            'id_buku'               => $id_buku_2,
            'tanggal_pinjam'        => '2026-05-20',
            'tanggal_harus_kembali' => '2026-05-27',
            'created_at'            => Time::now(),
            'updated_at'            => Time::now(),
        ]);
        $id_peminjaman_2 = $this->db->insertID();

        // ==========================================
        // 4. MASUKKAN DATA PENGEMBALIAN OTOMATIS
        // ==========================================
        $dataPengembalian = [
            [
                // Mengembalikan Transaksi 1
                'id_peminjaman'        => $id_peminjaman_1, // Pasti valid karena ngambil dari ID di atas
                'tanggal_dikembalikan' => '2026-05-15',
                'denda'                => 0,
                'kondisi_buku'         => 'Bagus',
                'created_at'           => Time::now(),
                'updated_at'           => Time::now(),
            ],
            [
                // Mengembalikan Transaksi 2 (Kena Denda)
                'id_peminjaman'        => $id_peminjaman_2, 
                'tanggal_dikembalikan' => '2026-05-29',
                'denda'                => 15000,
                'kondisi_buku'         => 'Rusak Ringan',
                'created_at'           => Time::now(),
                'updated_at'           => Time::now(),
            ]
        ];

        $this->db->table('pengembalian')->insertBatch($dataPengembalian);
        
        echo "Mantap! Smart Seeder berhasil memasukkan data otomatis!\n";
    }
}