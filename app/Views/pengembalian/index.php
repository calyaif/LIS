<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Transaksi Pengembalian</h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Riwayat Pengembalian Buku</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm btn-tambah">
                <i class="fas fa-undo"></i> Proses Pengembalian
            </button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <div class="view-data"></div>
        <div class="view-modal" style="display: none;"></div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    function dataPengembalian() {
        $.ajax({
            url: "<?= base_url('pengembalian/loadTable') ?>",
            dataType: "html",
            success: function(response) {
                $('.view-data').html(response);
            }
        });
    }

    $(document).ready(function() {
        dataPengembalian(); // Panggil tabel saat halaman dimuat

        // Tampilkan Modal Tambah Pengembalian
        $('.btn-tambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('pengembalian/formCreate') ?>",
                dataType: "html",
                success: function(response) {
                    $('.view-modal').html(response).show();
                    $('#modal-tambah').modal('show');
                }
            });
        });

        // Tombol Batalkan/Hapus Riwayat
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Yakin ingin membatalkan riwayat pengembalian ini? (Buku akan dianggap masih dipinjam)')) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('pengembalian/deleteAjax') ?>",
                    data: { id_pengembalian: id },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            alert(response.sukses);
                            dataPengembalian(); // Refresh tabel
                        }
                    }
                });
            }
        });
    });
</script>
<?= $this->endSection() ?>