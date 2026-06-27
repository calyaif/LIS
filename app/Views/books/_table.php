<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="50">No.</th>
            <th>Kode Buku</th>
            <th>ISBN</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Keterangan</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($books) && is_array($books)) : ?>
            <?php $no = 1; ?>
            <?php foreach ($books as $book) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($book['code_book']) ?></td>
                    <td><?= esc($book['isbn_book']) ?></td>
                    <td><?= esc($book['title_book']) ?></td>
                    <td><?= esc($book['author_book']) ?></td>
                    <td><?= esc($book['publisher_book']) ?></td>
                    <td><?= esc($book['published_year']) ?></td>
                    <td><?= esc($book['description_book']) ?></td>
                    <td>
                        <?= isset($book['stock']) ? esc($book['stock']) : '-' ?>
                    </td>
                    <td>
                       <button type="button" class="btn btn-info btn-sm btn-edit" data-id="<?= $book['id_book'] ?>">Edit</button>
                        
                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<?= $book['id_book'] ?>">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="10" class="text-center">Tidak ada data buku ditemukan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>