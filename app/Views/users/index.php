<?= $this->extend('layouts/template'); ?> <?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Member Perpustakaan</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($members as $m) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $m['nama']; ?></td>
                                <td><?= $m['email']; ?></td>
                                <td>
                                    <span class="badge bg-info">Detail</span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
    </div>
</div>
<?= $this->endSection(); ?>