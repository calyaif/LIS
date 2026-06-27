<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Transaksi Peminjaman</h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Peminjaman Buku</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm btn-tambah">
                <i class="fas fa-plus"></i> Catat Peminjaman
            </button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <div class="view-data"></div>
        <div class="view-modal" style="display: none;"></div>
    </div>
</div>
<?= $this->endSection() ?> <?= $this->section('js') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function dataPeminjaman() {
        $.ajax({
            url: "<?= base_url('peminjaman/loadTable') ?>",
            dataType: "html",
            success: function(response) {
                $('.view-data').html(response);
            }
        });
    }

    $(document).ready(function() {
        dataPeminjaman();

        // Tombol Tambah
        $('.btn-tambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('peminjaman/formCreate') ?>",
                dataType: "html",
                success: function(response) {
                    $('.view-modal').html(response).show();
                    $('#modal-tambah').modal('show');
                }
            });
        });

        // Tombol Edit
        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                type: "post",
                url: "<?= base_url('peminjaman/formEdit') ?>",
                data: { id_peminjaman: id },
                dataType: "html",
                success: function(response) {
                    $('.view-modal').html(response).show();
                    $('#modal-edit').modal('show');
                }
            });
        });

        // Tombol Hapus
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus data transaksi ini?')) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('peminjaman/deleteAjax') ?>",
                    data: { id_peminjaman: id },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            alert(response.sukses);
                            dataPeminjaman();
                        }
                    }
                });
            }
        });
    });
</script>
<?= $this->endSection() ?>
