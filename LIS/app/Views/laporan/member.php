<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Laporan Member</h6>
            
            <a href="<?= base_url('laporan/cetakMember') ?>" target="_blank" class="btn btn-primary btn-sm">
                <i class="fas fa-print"></i> Cetak PDF Laporan
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($members as $member): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= is_array($member) ? $member['id_member'] : $member->id_member ?></td>
                            <td><?= is_array($member) ? $member['nama'] : $member->nama ?></td>
                            <td><?= is_array($member) ? $member['email'] : $member->email ?></td>
                            <td><?= is_array($member) ? $member['kontak'] : $member->kontak ?></td>
                            <td><?= is_array($member) ? $member['status'] : $member->status ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>