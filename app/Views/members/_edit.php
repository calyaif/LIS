<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="<?= base_url('member/updateAjax') ?>" class="form-edit">
                <input type="hidden" name="id_member" value="<?= $member['id_member'] ?>">

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Member</label>
                        <input type="text" name="nama" class="form-control" value="<?= esc($member['nama']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= esc($member['email']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Kontak (HP)</label>
                        <input type="text" name="kontak" class="form-control" value="<?= esc($member['kontak']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="Aktif" <?= $member['status'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="Nonaktif" <?= $member['status'] == 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-update">Update</button>
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
                    $('.btn-update').attr('disabled', 'disabled').html('<i class="fas fa-spin fa-spinner"></i> Mengupdate...');
                },
                complete: function() {
                    $('.btn-update').removeAttr('disabled').html('Update');
                },
                success: function(response) {
                    if (response.sukses) {
                        $('#modal-edit').modal('hide');
                        alert(response.sukses);
                        dataMember(); // Refresh tabel
                    }
                }
            });
        });
    });
</script>
