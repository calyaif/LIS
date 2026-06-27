<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Buku Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="<?= base_url('book/saveAjax') ?>" class="form-tambah">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Kode Buku</label>
                            <input type="text" name="code_book" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ISBN</label>
                            <input type="text" name="isbn_book" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Judul Buku</label>
                        <input type="text" name="title_book" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Penulis</label>
                            <input type="text" name="author_book" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Penerbit</label>
                            <input type="text" name="publisher_book" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Tahun Terbit</label>
                            <input type="number" name="published_year" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Stok</label>
                            <input type="number" name="stock" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="description_book" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-simpan">Simpan Buku</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.form-tambah').submit(function(e) {
            e.preventDefault(); // Mencegah form pindah halaman
            
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(), // Mengambil semua inputan form sekaligus
                dataType: "json",
                beforeSend: function() {
                    $('.btn-simpan').attr('disabled', 'disabled');
                    $('.btn-simpan').html('<i class="fas fa-spin fa-spinner"></i> Menyimpan...');
                },
                complete: function() {
                    $('.btn-simpan').removeAttr('disabled');
                    $('.btn-simpan').html('Simpan Buku');
                },
                success: function(response) {
                    if (response.sukses) {
                        $('#modal-tambah').modal('hide'); // Tutup modal
                        alert(response.sukses); // Tampilkan pesan sukses
                        dataBuku(); // Refresh tabel secara gaib
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>