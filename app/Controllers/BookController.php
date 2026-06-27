<?php

namespace App\Controllers;
use App\Models\BookModel;

class BookController extends BaseController
{
public function index(): string
    {
        $bookModel = new BookModel();

        $data = [
            'title' => 'Daftar Buku',
            'books' => $bookModel->findAll()
        ];
        return view('books/index', $data);
    }
    
    public function create()
    {
        $data['title'] = 'Tambah Buku';
        return view('books/create');
    }

    public function store()
    {
        $model = new BookModel();
        $data = [
            'code_book' => $this->request->getPost('code_book'),
            'isbn_book' => $this->request->getPost('isbn_book'),
            'title_book' => $this->request->getPost('title_book'),
            'author_book' => $this->request->getPost('author_book'),
            'publisher_book' => $this->request->getPost('publisher_book'),
            'published_year' => $this->request->getPost('published_year'),
            'description_book' => $this->request->getPost('description_book'),
            'stock' => $this->request->getPost('stock'),
        ];
        if ($model->save($data)) {
            session()->setFlashdata('success', 'Buku berhasil disimpan!');
            return redirect()->to('/list/books');
        } else {
            dd($model->errors());
        }

    }

   public function edit($id)
{
    $model = new BookModel();
    
    // Ambil data asli dari database berdasarkan id_book
    $book = $model->find($id);

    // Cek jika data tidak ditemukan
    if (!$book) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku dengan ID ' . $id . ' tidak ditemukan');
    }

    $data = [
        'book' => $book
    ];

    return view('books/edit', $data);
} 

public function update($id)
{
    $model = new BookModel();

    // Tangkap data dari input form (pastikan 'name' di HTML sudah sama)
    $data = [
        'code_book'        => $this->request->getPost('code_book'),
        'isbn_book'        => $this->request->getPost('isbn_book'),
        'title_book'       => $this->request->getPost('title_book'),
        'author_book'      => $this->request->getPost('author_book'),
        'publisher_book'   => $this->request->getPost('publisher_book'),
        'published_year'   => $this->request->getPost('published_year'),
        'description_book' => $this->request->getPost('description_book'),
        'stock'            => $this->request->getPost('stock'),
    ];

    // Proses update berdasarkan ID
    if ($model->update($id, $data)) {
        session()->setFlashdata('success', 'Data buku berhasil diperbarui!');
        return redirect()->to('/list/books');
    } else {
        // Jika gagal, kembali ke halaman sebelumnya dengan pesan error
        return redirect()->back()->withInput()->with('errors', $model->errors());
    }
}

    public function delete($id)
    {
        $model = new BookModel();
       if ($model->delete($id)) {
        session()->setFlashdata('success', 'Buku berhasil dihapus!');
    } else {
        session()->setFlashdata('error', 'Gagal menghapus buku.');
    }

    return redirect()->to('/list/books');
    }

    public function trash ()
    {
        $model = new BookModel();
        $data = [
            'books' => $model->onlyDeleted()->findAll()
        ];
        return view('books/trash', $data);
    }

    public function restore($id)
    {
        $model = new BookModel();
        if ($model->update($id, ['deleted_at' => null])) {
            session()->setFlashdata('success', 'Buku berhasil dipulihkan!');
        } else {
            session()->setFlashdata('error', 'Gagal memulihkan buku.');
        }

        return redirect()->to('/book/trash');
    }

    public function purge($id)
    {
        $model = new BookModel();
        if ($model->delete($id, true)) {
            session()->setFlashdata('success', 'Buku berhasil dihapus permanen!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus buku permanen.');
        }

        return redirect()->to('/book/trash');
    }
    public function loadTable()
    {
        $bookModel = new BookModel();
        $data = [
            'books' => $bookModel->findAll()
        ];
        
        // Perhatikan: yang dipanggil hanya _table, bukan index
        return view('books/_table', $data);
    }
    public function deleteAjax()
    {
        // Pastikan request datang dari Ajax
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id_book');
            $bookModel = new BookModel();
            
            // Lakukan eksekusi hapus
            $bookModel->delete($id);

            // Kirim balasan JSON kalau sukses
            $msg = [
                'sukses' => 'Buku berhasil dihapus!'
            ];
            return $this->response->setJSON($msg);
        }
    }
    public function formCreate()
{
    if ($this->request->isAJAX()) {
        return view('books/_create');
    }
}
public function saveAjax()
    {
        if ($this->request->isAJAX()) {
            $model = new BookModel();
            
            // Tangkap semua inputan
            $data = [
                'code_book'        => $this->request->getPost('code_book'),
                'isbn_book'        => $this->request->getPost('isbn_book'),
                'title_book'       => $this->request->getPost('title_book'),
                'author_book'      => $this->request->getPost('author_book'),
                'publisher_book'   => $this->request->getPost('publisher_book'),
                'published_year'   => $this->request->getPost('published_year'),
                'description_book' => $this->request->getPost('description_book'),
                'stock'            => $this->request->getPost('stock'),
            ];
            
            // Simpan ke database
            $model->save($data);

            // Kirim balasan ke Ajax bahwa proses berhasil
            $msg = [
                'sukses' => 'Data buku berhasil ditambahkan!'
            ];

            return $this->response->setJSON($msg);
        }
    }
    public function formEdit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id_book');
            $model = new BookModel();
            $data = [
                'book' => $model->find($id)
            ];
            return view('books/_edit', $data);
        }
    }

    public function updateAjax()
    {
        if ($this->request->isAJAX()) {
            $model = new BookModel();
            $id = $this->request->getPost('id_book');
            
            $data = [
                'code_book'        => $this->request->getPost('code_book'),
                'isbn_book'        => $this->request->getPost('isbn_book'),
                'title_book'       => $this->request->getPost('title_book'),
                'author_book'      => $this->request->getPost('author_book'),
                'publisher_book'   => $this->request->getPost('publisher_book'),
                'published_year'   => $this->request->getPost('published_year'),
                'description_book' => $this->request->getPost('description_book'),
                'stock'            => $this->request->getPost('stock'),
            ];
            
            $model->update($id, $data);

            $msg = ['sukses' => 'Data buku berhasil diperbarui!'];
            return $this->response->setJSON($msg);
        }
    }
}