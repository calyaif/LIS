<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-dark">Daftar Member — Pilih untuk Cetak Kartu</h6>
            
            <a href="<?= base_url('laporan/cetak-label-member') ?>" target="_blank" class="btn btn-danger btn-sm">
                <i class="fas fa-print"></i> Cetak Semua Kartu
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>ID Member</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Kontak</th>
                            <th>Status</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($members as $member): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $member['id_member'] ?></td>
                            <td><?= $member['nama'] ?></td>
                            <td><?= $member['email'] ?></td>
                            <td><?= $member['kontak'] ?></td>
                            <td><?= $member['status'] ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('laporan/cetak-label-satu-member/'.$member['id_member']) ?>" target="_blank" class="btn btn-warning btn-sm text-dark font-weight-bold">
                                    <i class="fas fa-tags"></i> Cetak Kartu
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>