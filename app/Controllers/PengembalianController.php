<?php

namespace App\Controllers;
use App\Models\PengembalianModel;
use App\Models\PeminjamanModel;

class PengembalianController extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Transaksi Pengembalian'];
        return view('pengembalian/index', $data);
    }

    public function loadTable()
    {
        $model = new PengembalianModel();
        // JOIN 4 TABEL: Pengembalian -> Peminjaman -> Member & Buku
        $data['pengembalian'] = $model->select('pengembalian.*, peminjaman.tanggal_pinjam, peminjaman.tanggal_harus_kembali, members.nama, books.title_book')
            ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman')
            ->join('members', 'members.id_member = peminjaman.id_member')
            ->join('books', 'books.id_book = peminjaman.id_buku')
            ->orderBy('pengembalian.id_pengembalian', 'DESC')
            ->findAll();
                                    
        return view('pengembalian/_table', $data);
    }

    public function formCreate()
    {
        if ($this->request->isAJAX()) {
            $peminjamanModel = new PeminjamanModel();
            
            // JURUS PINTAR: Hanya ambil data PEMINJAMAN yang BELUM ADA di tabel PENGEMBALIAN!
            $db = \Config\Database::connect();
            $query = $db->query("
                SELECT p.id_peminjaman, m.nama, b.title_book 
                FROM peminjaman p 
                JOIN members m ON p.id_member = m.id_member 
                JOIN books b ON p.id_buku = b.id_book 
                WHERE p.id_peminjaman NOT IN (SELECT id_peminjaman FROM pengembalian)
            ");
            
            $data['peminjaman_aktif'] = $query->getResultArray();
            return view('pengembalian/_create', $data);
        }
    }

    public function saveAjax()
    {
        if ($this->request->isAJAX()) {
            $model = new PengembalianModel();
            
            // Bersihkan format uang (misal: "Rp 50.000" jadi "50000")
            $denda = preg_replace('/[^0-9]/', '', $this->request->getPost('denda'));
            if(empty($denda)) $denda = 0;

            $data = [
                'id_peminjaman'        => $this->request->getPost('id_peminjaman'),
                'tanggal_dikembalikan' => $this->request->getPost('tanggal_dikembalikan'),
                'kondisi_buku'         => $this->request->getPost('kondisi_buku'),
                'denda'                => $denda,
            ];
            $model->save($data);
            return $this->response->setJSON(['sukses' => 'Buku berhasil dikembalikan!']);
        }
    }

    public function deleteAjax()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id_pengembalian');
            $model = new PengembalianModel();
            $model->delete($id);
            return $this->response->setJSON(['sukses' => 'Data pengembalian dibatalkan/dihapus!']);
        }
    }
}