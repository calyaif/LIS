<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="50">No.</th>
            <th>Nama Member</th>
            <th>Email</th>
            <th>Kontak (HP)</th>
            <th>Status</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($members) && is_array($members)) : ?>
            <?php $no = 1; ?>
            <?php foreach ($members as $row) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($row['nama']) ?></td>
                    <td><?= esc($row['email']) ?></td>
                    <td><?= esc($row['kontak']) ?></td>
                    <td>
                        <?php if ($row['status'] == 'Aktif') : ?>
                            <span class="badge badge-success">Aktif</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Nonaktif</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm btn-edit" data-id="<?= $row['id_member'] ?>">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row['id_member'] ?>">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6" class="text-center">Belum ada data member terdaftar.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>