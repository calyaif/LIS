<?php

namespace App\Controllers;
use App\Models\PeminjamanModel;
use App\Models\MemberModel;
use App\Models\BookModel;

class PeminjamanController extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Data Peminjaman'];
        return view('peminjaman/index', $data);
    }

    // --- FUNGSI TAMPIL TABEL (DENGAN JOIN) ---
    public function loadTable()
    {
        $model = new PeminjamanModel();
        
        // Di sinilah keajaiban JOIN terjadi! 
        // Kita gabungkan tabel peminjaman dengan members dan books
        $data['peminjaman'] = $model->select('peminjaman.*, members.nama, books.title_book')
                                    ->join('members', 'members.id_member = peminjaman.id_member')
                                    ->join('books', 'books.id_book = peminjaman.id_buku')
                                    ->orderBy('peminjaman.id_peminjaman', 'DESC')
                                    ->findAll();
                                    
        return view('peminjaman/_table', $data);
    }

    // --- FUNGSI TAMBAH DATA ---
    public function formCreate()
    {
        if ($this->request->isAJAX()) {
            $memberModel = new MemberModel();
            $bookModel = new BookModel();
            
            // Kita kirim data member (yang aktif saja) dan buku ke dropdown form
            $data = [
                'members' => $memberModel->where('status', 'Aktif')->findAll(),
                'books'   => $bookModel->where('stock >', 0)->findAll() 
            ];
            return view('peminjaman/_create', $data);
        }
    }

    public function saveAjax()
    {
        if ($this->request->isAJAX()) {
            $model = new PeminjamanModel();
            $data = [
                'id_member'             => $this->request->getPost('id_member'),
                'id_buku'               => $this->request->getPost('id_buku'),
                'tanggal_pinjam'        => $this->request->getPost('tanggal_pinjam'),
                'tanggal_harus_kembali' => $this->request->getPost('tanggal_harus_kembali'),
            ];
            $model->save($data);
            return $this->response->setJSON(['sukses' => 'Data peminjaman berhasil disimpan!']);
        }
    }

    // --- FUNGSI UBAH DATA ---
    public function formEdit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id_peminjaman');
            $model = new PeminjamanModel();
            $memberModel = new MemberModel();
            $bookModel = new BookModel();
            
            $data = [
                'peminjaman' => $model->find($id),
                'members'    => $memberModel->where('status', 'Aktif')->findAll(),
                'books'      => $bookModel->findAll()
            ];
            return view('peminjaman/_edit', $data);
        }
    }

    public function updateAjax()
    {
        if ($this->request->isAJAX()) {
            $model = new PeminjamanModel();
            $id = $this->request->getPost('id_peminjaman');
            $data = [
                'id_member'             => $this->request->getPost('id_member'),
                'id_buku'               => $this->request->getPost('id_buku'),
                'tanggal_pinjam'        => $this->request->getPost('tanggal_pinjam'),
                'tanggal_harus_kembali' => $this->request->getPost('tanggal_harus_kembali'),
            ];
            $model->update($id, $data);
            return $this->response->setJSON(['sukses' => 'Data peminjaman berhasil diperbarui!']);
        }
    }

    // --- FUNGSI HAPUS DATA ---
    public function deleteAjax()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id_peminjaman');
            $model = new PeminjamanModel();
            $model->delete($id); // Hapus permanen karena tidak pakai Soft Deletes
            return $this->response->setJSON(['sukses' => 'Data transaksi berhasil dihapus!']);
        }
    }
}