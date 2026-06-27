<div class="modal fade" id="modal-tambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Proses Pengembalian Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pengembalian/saveAjax') ?>" class="form-tambah">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Transaksi Peminjaman</label>
                        <select name="id_peminjaman" class="form-control" required>
                            <option value="">-- Pilih Buku yang Sedang Dipinjam --</option>
                            <?php foreach ($peminjaman_aktif as $p) : ?>
                                <option value="<?= $p['id_peminjaman'] ?>">
                                    <?= esc($p['nama']) ?> - <?= esc($p['title_book']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted">Hanya menampilkan buku yang belum dikembalikan.</small>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Dikembalikan</label>
                        <input type="date" name="tanggal_dikembalikan" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Kondisi Buku</label>
                        <select name="kondisi_buku" class="form-control" required>
                            <option value="Bagus">Bagus (Normal)</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Parah">Rusak Parah</option>
                            <option value="Hilang">Hilang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Total Denda (Rp)</label>
                        <input type="number" name="denda" class="form-control" value="0" min="0">
                        <small class="text-muted">Isi 0 jika tidak ada denda keterlambatan/kerusakan.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-simpan">Proses Pengembalian</button>
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
                beforeSend: function() { $('.btn-simpan').attr('disabled', 'disabled').html('<i class="fas fa-spin fa-spinner"></i> Memproses...'); },
                complete: function() { $('.btn-simpan').removeAttr('disabled').html('Proses Pengembalian'); },
                success: function(response) {
                    if (response.sukses) {
                        $('#modal-tambah').modal('hide');
                        alert(response.sukses);
                        dataPengembalian(); // Panggil ulang tabel
                    }
                }
            });
        });
    });
</script>