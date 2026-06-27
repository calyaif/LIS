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

    // ═══════════════════════════════════════════════════
    // FITUR 1: AJAX — Cari anggota berdasarkan kode anggota
    // ═══════════════════════════════════════════════════
    public function getAnggota()
    {
        $kode = $this->request->getPost('kode_anggota');

        if (empty($kode)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Kode anggota tidak boleh kosong.'
            ]);
        }

        $memberModel = new MemberModel();

        // Cari member berdasarkan code_member (exact match)
        $member = $memberModel
            ->where('code_member', $kode)
            ->where('deleted_at', null)
            ->first();

        if (!$member) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Anggota dengan kode "' . esc($kode) . '" tidak ditemukan.'
            ]);
        }

        // Langsung ambil peminjaman anggota ini
        $peminjamanModel = new PeminjamanModel();
        $peminjaman      = $peminjamanModel->getByMember($member['id_member']);

        return $this->response->setJSON([
            'success'    => true,
            'member'     => $member,
            'peminjaman' => $peminjaman,
        ]);
    }

    // ═══════════════════════════════════════════════════
    // FITUR 2: AJAX — Ambil detail anggota + riwayat peminjaman
    // ═══════════════════════════════════════════════════
    public function detailAnggota()
    {
        $idMember = $this->request->getPost('id_member');

        $memberModel     = new MemberModel();
        $peminjamanModel = new PeminjamanModel();

        $member = $memberModel->find($idMember);

        if (!$member) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data anggota tidak ditemukan.'
            ]);
        }

        $peminjaman = $peminjamanModel->getByMember($idMember);

        return $this->response->setJSON([
            'success'    => true,
            'member'     => $member,
            'peminjaman' => $peminjaman,
        ]);
    }

    // ═══════════════════════════════════════════════════
    // FITUR 3: AJAX — Simpan peminjaman baru
    // ═══════════════════════════════════════════════════
    public function store()
    {
        $id_member      = $this->request->getPost('id_member');
        $id_buku        = $this->request->getPost('id_buku');
        $tanggal_pinjam = $this->request->getPost('tanggal_pinjam');
        $durasi_pinjam  = (int) $this->request->getPost('durasi_pinjam') ?: 3;

        // Validasi: buku harus ada
        $bookModel = new BookModel();
        $book      = $bookModel->find($id_buku);
        if (!$book) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Buku tidak ditemukan.'
            ]);
        }

        // Validasi: cek stok buku
        if (isset($book['stock']) && $book['stock'] <= 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Stok buku "' . esc($book['title_book']) . '" habis.'
            ]);
        }

        // Validasi: buku tidak sedang dipinjam (status 'dipinjam')
        $peminjamanModel = new PeminjamanModel();
        $sedangDipinjam  = $peminjamanModel
            ->where('id_buku', $id_buku)
            ->where('status', 'dipinjam')
            ->first();

        if ($sedangDipinjam) {
            $pesan = ($sedangDipinjam['id_member'] == $id_member)
                ? 'Buku ini masih Anda pinjam dan belum dikembalikan.'
                : 'Buku sedang dipinjam oleh anggota lain.';

            return $this->response->setJSON([
                'success' => false,
                'message' => $pesan
            ]);
        }

        // Hitung batas kembali
        $tanggal_harus_kembali = date('Y-m-d', strtotime($tanggal_pinjam . ' +' . $durasi_pinjam . ' days'));

        // Simpan
        $isSaved = $peminjamanModel->save([
            'kode_peminjaman'       => $peminjamanModel->generateCode(),
            'id_member'             => $id_member,
            'id_buku'               => $id_buku,
            'tanggal_pinjam'        => $tanggal_pinjam,
            'tanggal_harus_kembali' => $tanggal_harus_kembali,
            'durasi_pinjam'         => $durasi_pinjam,
            'status'                => 'dipinjam',
        ]);

        if ($isSaved) {
            // Kurangi stok buku
            if (isset($book['stock'])) {
                $bookModel->update($book['id_book'], [
                    'stock' => $book['stock'] - 1
                ]);
            }

            $peminjaman = $peminjamanModel->getByMember($id_member);
            return $this->response->setJSON([
                'success'    => true,
                'message'    => 'Peminjaman berhasil disimpan!',
                'peminjaman' => $peminjaman,
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menyimpan peminjaman.'
        ]);
    }

    // ═══════════════════════════════════════════════════
    // FITUR 4 & 5: AJAX — Proses pengembalian + denda
    // ═══════════════════════════════════════════════════
    public function kembalikan()
    {
        $id_peminjaman        = $this->request->getPost('id_peminjaman');
        $tanggal_dikembalikan = $this->request->getPost('tanggal_dikembalikan');
        $denda                = (int) $this->request->getPost('denda') ?: 0;

        $peminjamanModel = new PeminjamanModel();
        $pjm = $peminjamanModel->find($id_peminjaman);

        if (!$pjm) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data peminjaman tidak ditemukan.'
            ]);
        }

        if ($pjm['status'] === 'dikembalikan') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Buku sudah dikembalikan sebelumnya.'
            ]);
        }

        // Update status jadi dikembalikan
        $peminjamanModel->update($id_peminjaman, [
            'tanggal_dikembalikan' => $tanggal_dikembalikan,
            'status'               => 'dikembalikan',
            'denda'                => $denda,
        ]);

        // Tambah stok buku kembali
        $bookModel = new BookModel();
        $book = $bookModel->find($pjm['id_buku']);
        if ($book && isset($book['stock'])) {
            $bookModel->update($book['id_book'], [
                'stock' => $book['stock'] + 1
            ]);
        }

        $peminjaman = $peminjamanModel->getByMember($pjm['id_member']);

        return $this->response->setJSON([
            'success'    => true,
            'message'    => 'Buku berhasil dikembalikan!',
            'peminjaman' => $peminjaman,
        ]);
    }

    // ═══════════════════════════════════════════════════
    // FITUR LAMA — Tetap dipertahankan
    // ═══════════════════════════════════════════════════

    public function loadTable()
    {
        $model = new PeminjamanModel();
        
        $data['peminjaman'] = $model->select('peminjaman.*, members.nama, books.title_book')
                                    ->join('members', 'members.id_member = peminjaman.id_member')
                                    ->join('books', 'books.id_book = peminjaman.id_buku')
                                    ->orderBy('peminjaman.id_peminjaman', 'DESC')
                                    ->findAll();
                                    
        return view('peminjaman/_table', $data);
    }

    public function formCreate()
    {
        if ($this->request->isAJAX()) {
            $memberModel = new MemberModel();
            $bookModel = new BookModel();
            
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