<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="50">No.</th>
            <th>Nama Peminjam</th>
            <th>Judul Buku</th>
            <th>Tgl Dikembalikan</th>
            <th>Kondisi Buku</th>
            <th>Denda</th>
            <th width="100">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($pengembalian) && is_array($pengembalian)) : ?>
            <?php $no = 1; ?>
            <?php foreach ($pengembalian as $row) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($row['nama']) ?></td>
                    <td><?= esc($row['title_book']) ?></td>
                    <td><?= date('d M Y', strtotime($row['tanggal_dikembalikan'])) ?></td>
                    <td>
                        <?php if ($row['kondisi_buku'] == 'Bagus') : ?>
                            <span class="badge badge-success">Bagus</span>
                        <?php elseif ($row['kondisi_buku'] == 'Rusak Ringan') : ?>
                            <span class="badge badge-warning">Rusak Ringan</span>
                        <?php else : ?>
                            <span class="badge badge-danger"><?= esc($row['kondisi_buku']) ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="<?= $row['denda'] > 0 ? 'text-danger font-weight-bold' : 'text-success' ?>">
                        Rp <?= number_format($row['denda'], 0, ',', '.') ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row['id_pengembalian'] ?>" title="Batalkan Pengembalian">
                            <i class="fas fa-trash"></i> Batal
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="7" class="text-center">Belum ada riwayat pengembalian buku.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>