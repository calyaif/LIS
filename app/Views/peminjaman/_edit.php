<div class="modal fade" id="modal-edit" tabindex="-1" role="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Transaksi Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('peminjaman/updateAjax') ?>" class="form-edit">
                <input type="hidden" name="id_peminjaman" value="<?= $peminjaman['id_peminjaman'] ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Member</label>
                        <select name="id_member" class="form-control" required>
                            <?php foreach ($members as $m) : ?>
                                <option value="<?= $m['id_member'] ?>" <?= $m['id_member'] == $peminjaman['id_member'] ? 'selected' : '' ?>><?= esc($m['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Judul Buku</label>
                        <select name="id_buku" class="form-control" required>
                            <?php foreach ($books as $b) : ?>
                                <option value="<?= $b['id_book'] ?>" <?= $b['id_book'] == $peminjaman['id_buku'] ? 'selected' : '' ?>><?= esc($b['title_book']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" class="form-control" value="<?= $peminjaman['tanggal_pinjam'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Batas Kembali</label>
                        <input type="date" name="tanggal_harus_kembali" class="form-control" value="<?= $peminjaman['tanggal_harus_kembali'] ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-update">Update Transaksi</button>
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
                beforeSend: function() { $('.btn-update').attr('disabled', 'disabled').html('Mengupdate...'); },
                complete: function() { $('.btn-update').removeAttr('disabled').html('Update Transaksi'); },
                success: function(response) {
                    if (response.sukses) {
                        $('#modal-edit').modal('hide');
                        alert(response.sukses);
                        dataPeminjaman();
                    }
                }
            });
        });
    });
</script>