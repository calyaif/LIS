<?php

namespace App\Controllers;
use App\Models\BookModel;
use App\Models\MemberModel;

class LaporanController extends BaseController
{
    public function buku()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll();
        $data['title'] = 'Laporan Data Buku';

        return view('laporan/buku', $data);
    }

    public function cetakBuku()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll();
        $data['title'] = 'Laporan Data Buku';

        return view('laporan/cetak_buku', $data);
    }

    public function labelBuku()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll();
        $data['title'] = 'Cetak Label Buku';

        return view('laporan/label_buku', $data);
    }

    public function cetakLabelBuku()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll();
        $data['title'] = 'Cetak Label Buku';

        return view('laporan/cetak_label_buku', $data);
    }

    public function cetakLabelSatu($id)
    {
        $bookModel = new BookModel();
        $data['book'] = $bookModel->where('id_book', $id)->first();
        $data['title'] = 'Cetak Label Buku';

        return view('laporan/cetak_label_satu', $data);
    }

    public function member()
    {
        $memberModel = new MemberModel();
        $data['members'] = $memberModel->findAll();
        $data['title'] = 'Laporan Data Member';

        return view('laporan/member', $data);
    }

    public function cetakMember()
    {
        $memberModel = new MemberModel();
        $data['members'] = $memberModel->findAll();
        $data['title'] = 'Laporan Data Member';

        return view('laporan/cetak_member', $data);
    }

    public function labelMember()
    {
        $memberModel = new MemberModel();
        $data['members'] = $memberModel->findAll();
        $data['title'] = 'Cetak Kartu Member';
   
        return view('laporan/label_member', $data);
    }

    public function cetakLabelMember()
    {
        $memberModel = new MemberModel();
        $data['members'] = $memberModel->findAll();
        $data['title'] = 'Cetak Kartu Member';

        return view('laporan/cetak_label_member', $data);
    }

    public function cetakLabelSatuMember($id)
    {
        $memberModel = new MemberModel();
        
        // Ini kuncinya: kita paksa cari berdasarkan 'id_member', bukan 'id' biasa
        $data['member'] = $memberModel->where('id_member', $id)->first();
        $data['title'] = 'Cetak Kartu Member';

        return view('laporan/cetak_label_satu_member', $data);
    }
}