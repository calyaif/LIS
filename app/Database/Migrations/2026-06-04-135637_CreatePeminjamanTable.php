<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePeminjamanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_peminjaman' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_member' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_buku' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'tanggal_pinjam' => [
                'type'       => 'DATE',
            ],
            'tanggal_harus_kembali' => [
                'type'       => 'DATE',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_peminjaman', true);
        
        // Membuat relasi/penghubung ke tabel member dan buku
        $this->forge->addForeignKey('id_member', 'members', 'id_member', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_buku', 'books', 'id_book', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('peminjaman');
    }

    public function down()
    {
        $this->forge->dropTable('peminjaman');
    }
}