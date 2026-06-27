<?php

namespace App\Controllers;
use App\Models\MemberModel;

class MemberController extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Daftar Member'];
        return view('members/index', $data);
    }

    // --- FUNGSI AJAX CRUD ---

    public function loadTable()
    {
        $model = new MemberModel();
        $data['members'] = $model->findAll();
        return view('members/_table', $data);
    }

    public function formCreate()
    {
        if ($this->request->isAJAX()) {
            return view('members/_create');
        }
    }

    public function saveAjax()
    {
        if ($this->request->isAJAX()) {
            $model = new MemberModel();
            $data = [
                'nama'   => $this->request->getPost('nama'),
                'email'  => $this->request->getPost('email'),
                'kontak' => $this->request->getPost('kontak'),
                'status' => $this->request->getPost('status'),
            ];
            $model->save($data);
            return $this->response->setJSON(['sukses' => 'Data member berhasil ditambahkan!']);
        }
    }

    public function formEdit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id_member');
            $model = new MemberModel();
            $data['member'] = $model->find($id);
            return view('members/_edit', $data);
        }
    }

    public function updateAjax()
    {
        if ($this->request->isAJAX()) {
            $model = new MemberModel();
            $id = $this->request->getPost('id_member');
            $data = [
                'nama'   => $this->request->getPost('nama'),
                'email'  => $this->request->getPost('email'),
                'kontak' => $this->request->getPost('kontak'),
                'status' => $this->request->getPost('status'),
            ];
            $model->update($id, $data);
            return $this->response->setJSON(['sukses' => 'Data member berhasil diperbarui!']);
        }
    }

    public function deleteAjax()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id_member');
            $model = new MemberModel();
            $model->delete($id);
            return $this->response->setJSON(['sukses' => 'Member berhasil dihapus!']);
        }
    }

    // --- FUNGSI TONG SAMPAH ---

    public function trash()
    {
        $model = new MemberModel();
        $data = ['members' => $model->onlyDeleted()->findAll()];
        return view('members/trash', $data);
    }

    public function restore($id)
    {
        $model = new MemberModel();
        if ($model->update($id, ['deleted_at' => null])) {
            session()->setFlashdata('success', 'Member berhasil dipulihkan!');
        }
        return redirect()->to('/member/trash');
    }

    public function purge($id)
    {
        $model = new MemberModel();
        if ($model->delete($id, true)) {
            session()->setFlashdata('success', 'Member berhasil dihapus permanen!');
        }
        return redirect()->to('/member/trash');
    }
}