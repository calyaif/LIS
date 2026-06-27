<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnsPeminjamanTable extends Migration
{
    public function up()
    {
        // Tambah kolom baru ke tabel peminjaman yang sudah ada
        $this->forge->addColumn('peminjaman', [
            'kode_peminjaman' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
                'after'      => 'id_peminjaman',
            ],
            'durasi_pinjam' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 3,
                'after'      => 'tanggal_harus_kembali',
            ],
            'tanggal_dikembalikan' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'durasi_pinjam',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['dipinjam', 'dikembalikan'],
                'default'    => 'dipinjam',
                'after'      => 'tanggal_dikembalikan',
            ],
            'denda' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'after'      => 'status',
            ],
        ]);
    }

    public function down()
    {
        // Hapus kolom jika rollback
        $this->forge->dropColumn('peminjaman', 'kode_peminjaman');
        $this->forge->dropColumn('peminjaman', 'durasi_pinjam');
        $this->forge->dropColumn('peminjaman', 'tanggal_dikembalikan');
        $this->forge->dropColumn('peminjaman', 'status');
        $this->forge->dropColumn('peminjaman', 'denda');
    }
}
