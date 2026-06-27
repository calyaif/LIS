<div class="modal fade" id="modal-tambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Catat Transaksi Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('peminjaman/saveAjax') ?>" class="form-tambah">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Member</label>
                        <select name="id_member" class="form-control" required>
                            <option value="">-- Pilih Member --</option>
                            <?php foreach ($members as $m) : ?>
                                <option value="<?= $m['id_member'] ?>"><?= esc($m['nama']) ?> (<?= esc($m['email']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pilih Buku</label>
                        <select name="id_buku" class="form-control" required>
                            <option value="">-- Pilih Buku --</option>
                            <?php foreach ($books as $b) : ?>
                                <option value="<?= $b['id_book'] ?>"><?= esc($b['title_book']) ?> (Stok: <?= esc($b['stock']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Batas Kembali</label>
                        <input type="date" name="tanggal_harus_kembali" class="form-control" value="<?= date('Y-m-d', strtotime('+7 days')) ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-simpan">Simpan Transaksi</button>
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
                beforeSend: function() { $('.btn-simpan').attr('disabled', 'disabled').html('Menyimpan...'); },
                complete: function() { $('.btn-simpan').removeAttr('disabled').html('Simpan Transaksi'); },
                success: function(response) {
                    if (response.sukses) {
                        $('#modal-tambah').modal('hide');
                        alert(response.sukses);
                        dataPeminjaman();
                    }
                }
            });
        });
    });
</script>