<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="<?= base_url('book/updateAjax') ?>" class="form-edit">
                <input type="hidden" name="id_book" value="<?= $book['id_book'] ?>">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Kode Buku</label>
                            <input type="text" name="code_book" class="form-control" value="<?= esc($book['code_book']) ?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ISBN</label>
                            <input type="text" name="isbn_book" class="form-control" value="<?= esc($book['isbn_book']) ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Judul Buku</label>
                        <input type="text" name="title_book" class="form-control" value="<?= esc($book['title_book']) ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Penulis</label>
                            <input type="text" name="author_book" class="form-control" value="<?= esc($book['author_book']) ?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Penerbit</label>
                            <input type="text" name="publisher_book" class="form-control" value="<?= esc($book['publisher_book']) ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Tahun Terbit</label>
                            <input type="number" name="published_year" class="form-control" value="<?= esc($book['published_year']) ?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Stok</label>
                            <input type="number" name="stock" class="form-control" value="<?= esc($book['stock']) ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="description_book" class="form-control" rows="2"><?= esc($book['description_book']) ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-update">Update Buku</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.form-edit').submit(function(e) {
            e.preventDefault();
            
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btn-update').attr('disabled', 'disabled');
                    $('.btn-update').html('<i class="fas fa-spin fa-spinner"></i> Mengupdate...');
                },
                complete: function() {
                    $('.btn-update').removeAttr('disabled');
                    $('.btn-update').html('Update Buku');
                },
                success: function(response) {
                    if (response.sukses) {
                        $('#modal-edit').modal('hide');
                        alert(response.sukses);
                        dataBuku(); // Refresh tabel
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>