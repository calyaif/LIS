<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Daftar Member</h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Member Perpustakaan</h3>

        <div class="card-tools">
           
            <button type="button" class="btn btn-primary btn-sm btn-tambah">
                <i class="fas fa-plus"></i> Tambah Member
            </button>
        </div>
    </div>

    <div class="card-body table-responsive">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="view-data"></div>
        
        <div class="view-modal" style="display: none;"></div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function dataMember() {
        $.ajax({
            url: "<?= base_url('member/loadTable') ?>",
            dataType: "html",
            success: function(response) {
                $('.view-data').html(response);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    $(document).ready(function() {
        // 1. Tampilkan tabel pertama kali
        dataMember();

        // 2. Tombol Tambah Member (Panggil Modal)
        $('.btn-tambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('member/formCreate') ?>",
                dataType: "html",
                success: function(response) {
                    $('.view-modal').html(response).show();
                    $('#modal-tambah').modal('show');
                }
            });
        });

        // 3. Tombol Edit Member (Panggil Modal)
        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                type: "post",
                url: "<?= base_url('member/formEdit') ?>",
                data: { id_member: id },
                dataType: "html",
                success: function(response) {
                    $('.view-modal').html(response).show();
                    $('#modal-edit').modal('show');
                }
            });
        });

        // 4. Tombol Hapus Member
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus member ini?')) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('member/deleteAjax') ?>",
                    data: { id_member: id },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            alert(response.sukses);
                            dataMember(); // Refresh tabel otomatis
                        }
                    }
                });
            }
        });
    });
</script>

<?= $this->endSection() ?>