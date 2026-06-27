<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="50">No.</th>
            <th>Nama Member</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Batas Kembali</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($peminjaman) && is_array($peminjaman)) : ?>
            <?php $no = 1; ?>
            <?php foreach ($peminjaman as $row) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($row['nama']) ?></td>
                    <td><?= esc($row['title_book']) ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tanggal_pinjam'])) ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tanggal_harus_kembali'])) ?></td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm btn-edit" data-id="<?= $row['id_peminjaman'] ?>">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row['id_peminjaman'] ?>">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6" class="text-center">Belum ada transaksi peminjaman.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>