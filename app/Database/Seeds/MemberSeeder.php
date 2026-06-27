<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class MemberSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'       => 'Budi Santoso',
                'email'      => 'budi.santoso@example.com',
                'kontak'     => '081234567890',
                'status'     => 'Aktif',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama'       => 'Siti Aminah',
                'email'      => 'siti.aminah@example.com',
                'kontak'     => '081298765432',
                'status'     => 'Aktif',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama'       => 'Andi Wijaya',
                'email'      => 'andi.w@example.com',
                'kontak'     => '081345678912',
                'status'     => 'Nonaktif',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama'       => 'Dewi Lestari',
                'email'      => 'dewi.l@example.com',
                'kontak'     => '085612349876',
                'status'     => 'Aktif',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama'       => 'Reza Rahadian',
                'email'      => 'reza.r@example.com',
                'kontak'     => '087812345678',
                'status'     => 'Aktif',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
        ];

        // Memasukkan semua data di atas ke tabel members
        $this->db->table('members')->insertBatch($data);
    }
}