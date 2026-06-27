<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Member Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="<?= base_url('member/saveAjax') ?>" class="form-tambah">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Member</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Kontak (HP)</label>
                        <input type="text" name="kontak" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.form-tambah').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btn-simpan').attr('disabled', 'disabled').html('<i class="fas fa-spin fa-spinner"></i> Menyimpan...');
                },
                complete: function() {
                    $('.btn-simpan').removeAttr('disabled').html('Simpan');
                },
                success: function(response) {
                    if (response.sukses) {
                        $('#modal-tambah').modal('hide');
                        alert(response.sukses);
                        dataMember(); // Refresh tabel
                    }
                }
            });
        });
    });
</script>