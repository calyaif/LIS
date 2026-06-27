<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Daftar Buku</h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Buku</h3>

        <div class="card-tools">
        
          <button type="button" class="btn btn-primary btn-sm btn-tambah">
    <i class="fas fa-plus"></i> Tambah Buku
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

      <div class="view-data">
    </div>

<div class="view-modal" style="display: none;"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Fungsi untuk memanggil tabel
    function dataBuku() {
        $.ajax({
            url: "<?= base_url('book/loadTable') ?>",
            dataType: "html",
            success: function(response) {
                $('.view-data').html(response);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // JALANKAN SEMUA PERINTAH SAAT HALAMAN DIBUKA
    $(document).ready(function() {
        // 1. Panggil tabel pertama kali
        dataBuku();

        // 2. Tangkap klik pada tombol hapus
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('book/deleteAjax') ?>",
                    data: {
                        id_book: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            alert(response.sukses); 
                            dataBuku(); // Refresh tabel otomatis
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    });
    // Menangkap klik tombol Tambah Buku
        $('.btn-tambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('book/formCreate') ?>",
                dataType: "html",
                success: function(response) {
                    $('.view-modal').html(response).show();
                    $('#modal-tambah').modal('show'); // Menampilkan pop-up modal
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
        // Menangkap klik tombol Edit
        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                type: "post",
                url: "<?= base_url('book/formEdit') ?>",
                data: { id_book: id },
                dataType: "html",
                success: function(response) {
                    $('.view-modal').html(response).show();
                    $('#modal-edit').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
</script>
<?= $this->endSection() ?>