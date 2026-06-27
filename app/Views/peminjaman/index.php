<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><i class="fas fa-book-reader mr-2"></i><?= $title ?></h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- ═══════════════════════════════════════════════════ -->
<!-- FITUR 1: Form Pencarian Anggota                    -->
<!-- ═══════════════════════════════════════════════════ -->
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-search mr-2"></i>Cari Anggota</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group mb-0">
                    <label for="kode_anggota">Kode Anggota</label>
                    <div class="input-group">
                        <input type="text" id="kode_anggota" class="form-control"
                               placeholder="Masukkan kode anggota, misal: MBR-001" autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn btn-primary" id="btn-cari-anggota" type="button">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pesan error -->
        <div id="info-anggota-error" class="alert alert-warning mt-3" style="display:none;">
            <i class="fas fa-exclamation-triangle mr-1"></i>
            <span id="pesan-error-anggota"></span>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════ -->
<!-- FITUR 2: Detail Anggota Terpilih                   -->
<!-- ═══════════════════════════════════════════════════ -->
<div class="card card-info card-outline" id="card-detail-anggota" style="display:none;">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user mr-2"></i>Informasi Anggota</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td width="130"><strong>Kode Anggota</strong></td>
                        <td>: <span id="anggota-kode" class="font-weight-bold"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Nama</strong></td>
                        <td>: <span id="anggota-nama" class="font-weight-bold text-primary"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>: <span id="anggota-email"></span></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td width="130"><strong>Kontak</strong></td>
                        <td>: <span id="anggota-kontak"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>: <span id="anggota-status"></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════ -->
<!-- FITUR 3: Tabel Daftar Peminjaman                   -->
<!-- ═══════════════════════════════════════════════════ -->
<div class="card card-success card-outline" id="card-peminjaman" style="display:none;">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-book mr-2"></i>Buku yang Dipinjam</h3>
        <div class="card-tools">
            <button class="btn btn-success btn-sm" id="btn-tambah-peminjaman" type="button">
                <i class="fas fa-plus"></i> Tambah Peminjaman
            </button>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-striped table-sm mb-0">
            <thead class="thead-light">
                <tr>
                    <th width="40">No.</th>
                    <th>Kode Pinjam</th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Tgl Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Durasi</th>
                    <th>Status</th>
                    <th width="140">Aksi</th>
                </tr>
            </thead>
            <tbody id="tbody-peminjaman">
                <tr>
                    <td colspan="10" class="text-center text-muted py-3">Belum ada data peminjaman.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════ -->
<!-- MODAL: Tambah Peminjaman (Fitur 3)                 -->
<!-- ═══════════════════════════════════════════════════ -->
<div class="modal fade" id="modalTambahPeminjaman" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>Tambah Peminjaman Buku</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="modal-alert" class="alert" style="display:none;"></div>
                <input type="hidden" id="hidden-id-member">

                <div class="form-group">
                    <label>Pilih Buku <span class="text-danger">*</span></label>
                    <select id="select_buku" class="form-control">
                        <option value="">-- Memuat daftar buku... --</option>
                    </select>
                    <small class="form-text text-muted">Hanya buku dengan stok tersedia.</small>
                </div>

                <div class="form-group">
                    <label>Tanggal Pinjam <span class="text-danger">*</span></label>
                    <input type="date" id="tanggal_pinjam" class="form-control">
                </div>

                <div class="form-group">
                    <label>Lama Pinjam (hari) <span class="text-danger">*</span></label>
                    <input type="number" id="durasi_pinjam" class="form-control" value="3" min="1" max="60">
                    <small class="form-text text-muted">Default 3 hari. Tanggal kembali dihitung otomatis.</small>
                </div>

                <div class="form-group mb-0">
                    <label>Perkiraan Tanggal Kembali</label>
                    <input type="text" id="preview_batas_kembali" class="form-control" readonly style="background:#f4f6f9;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="btn-simpan-peminjaman">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════ -->
<!-- MODAL: Pengembalian Buku (Fitur 4 & 5)             -->
<!-- ═══════════════════════════════════════════════════ -->
<div class="modal fade" id="modalKembalikan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title"><i class="fas fa-undo mr-2"></i>Pengembalian Buku</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="modal-kembali-alert" class="alert" style="display:none;"></div>
                <input type="hidden" id="hidden-id-peminjaman-kembali">

                <!-- Info peminjaman -->
                <div class="row mb-3">
                    <div class="col-6">
                        <small class="text-muted text-uppercase">Kode Peminjaman</small>
                        <div class="font-weight-bold" id="return-kode-pinjam">—</div>
                    </div>
                    <div class="col-6">
                        <small class="text-muted text-uppercase">Judul Buku</small>
                        <div class="font-weight-bold" id="return-judul-buku">—</div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <small class="text-muted text-uppercase">Tanggal Pinjam</small>
                        <div id="return-tgl-pinjam">—</div>
                    </div>
                    <div class="col-6">
                        <small class="text-muted text-uppercase">Batas Kembali</small>
                        <div id="return-batas-kembali">—</div>
                    </div>
                </div>

                <hr>

                <!-- Info keterlambatan -->
                <div id="info-keterlambatan" class="alert alert-danger" style="display:none;">
                    <i class="fas fa-clock mr-1"></i>
                    Terlambat <strong id="hari-terlambat">0</strong> hari.
                    Denda disarankan: <strong id="saran-denda">Rp 0</strong>
                </div>

                <div class="form-group">
                    <label>Tanggal Pengembalian <span class="text-danger">*</span></label>
                    <input type="date" id="tanggal_kembali" class="form-control">
                </div>

                <div class="form-group mb-0">
                    <label>Denda (Rp)</label>
                    <input type="number" id="denda" class="form-control" value="0" min="0" step="1000">
                    <small class="form-text text-muted">Denda keterlambatan Rp 1.000 per hari.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-info" id="btn-proses-kembali">
                    <i class="fas fa-check mr-1"></i> Proses Pengembalian
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
const BASE_URL = '<?= base_url() ?>';
const DENDA_PER_HARI = 1000;
let currentMemberId = null;
let currentPeminjaman = []; // data peminjaman anggota aktif

// ═══════════════════════════════════════════════════
// Inisialisasi
// ═══════════════════════════════════════════════════
$(document).ready(function() {
    // Set tanggal hari ini
    const today = new Date().toISOString().split('T')[0];
    $('#tanggal_pinjam').val(today);
    $('#tanggal_kembali').val(today);
    updatePreviewBatasKembali();

    // Event listeners
    $('#btn-cari-anggota').click(cariAnggota);
    $('#kode_anggota').keydown(function(e) { if (e.key === 'Enter') cariAnggota(); });
    $('#btn-tambah-peminjaman').click(bukaModalTambah);
    $('#btn-simpan-peminjaman').click(simpanPeminjaman);
    $('#btn-proses-kembali').click(prosesKembalikan);
    $('#tanggal_pinjam, #durasi_pinjam').on('change input', updatePreviewBatasKembali);
    $('#tanggal_kembali').change(hitungKeterlambatan);
});

// ═══════════════════════════════════════════════════
// FITUR 1: Pencarian Anggota
// ═══════════════════════════════════════════════════
function cariAnggota() {
    const kode = $('#kode_anggota').val().trim();
    if (!kode) return;

    // Reset
    $('#info-anggota-error, #card-detail-anggota, #card-peminjaman').hide();
    currentMemberId = null;

    $('#btn-cari-anggota').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Mencari...');

    $.ajax({
        type: 'POST',
        url: BASE_URL + 'peminjaman/getAnggota',
        data: { kode_anggota: kode },
        dataType: 'json',
        success: function(res) {
            if (res.success) {
                const m = res.member;
                currentMemberId = m.id_member;
                $('#hidden-id-member').val(m.id_member);

                // Isi info anggota
                $('#anggota-kode').text(m.code_member || '-');
                $('#anggota-nama').text(m.nama);
                $('#anggota-email').text(m.email || '-');
                $('#anggota-kontak').text(m.kontak || '-');
                $('#anggota-status').html(
                    m.status === 'Aktif'
                        ? '<span class="badge badge-success">Aktif</span>'
                        : '<span class="badge badge-secondary">Nonaktif</span>'
                );

                // Simpan & render peminjaman
                currentPeminjaman = res.peminjaman || [];
                renderTabelPeminjaman();

                // Tampilkan card
                $('#card-detail-anggota').show();
                $('#card-peminjaman').show();
            } else {
                $('#pesan-error-anggota').text(res.message);
                $('#info-anggota-error').show();
            }
        },
        error: function() {
            $('#pesan-error-anggota').text('Terjadi kesalahan koneksi ke server.');
            $('#info-anggota-error').show();
        },
        complete: function() {
            $('#btn-cari-anggota').prop('disabled', false).html('<i class="fas fa-search"></i> Cari');
        }
    });
}




function renderTabelPeminjaman() {
    const tbody = $('#tbody-peminjaman');

    if (!currentPeminjaman || currentPeminjaman.length === 0) {
        tbody.html('<tr><td colspan="10" class="text-center text-muted py-3">Belum ada data peminjaman untuk anggota ini.</td></tr>');
        return;
    }

    let html = '';
    currentPeminjaman.forEach(function(pjm, idx) {
        const isLate = pjm.status === 'dipinjam' && isOverdue(pjm.tanggal_harus_kembali);

        let statusBadge = '';
        if (pjm.status === 'dikembalikan') {
            statusBadge = '<span class="badge badge-success">Dikembalikan</span>';
        } else if (isLate) {
            statusBadge = '<span class="badge badge-danger">Terlambat</span>';
        } else {
            statusBadge = '<span class="badge badge-primary">Dipinjam</span>';
        }

        let dendaText = '';
        if (pjm.denda > 0) {
            dendaText = '<br><small class="text-danger">Denda: Rp ' + formatNumber(pjm.denda) + '</small>';
        }

        let aksiHtml = '';
        if (pjm.status === 'dipinjam') {
            aksiHtml = `<button class="btn btn-info btn-sm" onclick="bukaModalKembali(${pjm.id_peminjaman})">
                            <i class="fas fa-undo"></i> Kembalikan
                        </button>`;
        } else {
            aksiHtml = '<span class="text-muted">—</span>';
        }

        html += `<tr>
            <td>${idx + 1}</td>
            <td><code>${escHtml(pjm.kode_peminjaman || '-')}</code></td>
            <td>${escHtml(pjm.code_book || '-')}</td>
            <td><strong>${escHtml(pjm.title_book || '-')}</strong></td>
            <td>${escHtml(pjm.author_book || '-')}</td>
            <td>${formatTanggal(pjm.tanggal_pinjam)}</td>
            <td>${formatTanggal(pjm.tanggal_harus_kembali)}</td>
            <td class="text-center">${pjm.durasi_pinjam || 3} hari</td>
            <td>${statusBadge}${dendaText}</td>
            <td>${aksiHtml}</td>
        </tr>`;
    });

    tbody.html(html);
}

// ═══════════════════════════════════════════════════
// FITUR 3: Tambah Peminjaman
// ═══════════════════════════════════════════════════
function bukaModalTambah() {
    // Reset form
    $('#select_buku').val('');
    const today = new Date().toISOString().split('T')[0];
    $('#tanggal_pinjam').val(today);
    $('#durasi_pinjam').val(3);
    $('#modal-alert').hide();
    updatePreviewBatasKembali();

    // Load daftar buku via AJAX
    loadDaftarBuku();

    $('#modalTambahPeminjaman').modal('show');
}

function loadDaftarBuku() {
    // Ambil daftar buku langsung dari controller yang sudah ada (formCreate)
    // Karena formCreate mengembalikan HTML, kita buat endpoint baru yang return JSON
    // Sebagai alternatif, kita query semua buku via route yang ada
    // Untuk simplicity, kita embed data buku lewat PHP di awal
    // Tapi karena kita sudah punya AJAX pattern, kita gunakan jQuery get
    $.ajax({
        url: BASE_URL + 'peminjaman/formCreate',
        dataType: 'html',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        success: function(response) {
            // Parse select options dari HTML response
            const temp = $(response);
            const bookOptions = temp.find('select[name="id_buku"] option').clone();
            $('#select_buku').empty().append('<option value="">-- Pilih Buku --</option>').append(bookOptions);
        },
        error: function() {
            $('#select_buku').html('<option value="">Gagal memuat daftar buku</option>');
        }
    });
}

function updatePreviewBatasKembali() {
    const tanggal = $('#tanggal_pinjam').val();
    const durasi = parseInt($('#durasi_pinjam').val()) || 3;

    if (tanggal) {
        const batas = new Date(tanggal);
        batas.setDate(batas.getDate() + durasi);
        $('#preview_batas_kembali').val(
            batas.toLocaleDateString('id-ID', {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
            })
        );
    } else {
        $('#preview_batas_kembali').val('—');
    }
}

function simpanPeminjaman() {
    const id_buku        = $('#select_buku').val();
    const tanggal_pinjam = $('#tanggal_pinjam').val();
    const durasi_pinjam  = parseInt($('#durasi_pinjam').val()) || 3;

    if (!id_buku || !tanggal_pinjam) {
        showModalAlert('modal-alert', 'Buku dan tanggal pinjam wajib diisi.', 'warning');
        return;
    }
    if (!currentMemberId) {
        showModalAlert('modal-alert', 'Anggota belum dipilih.', 'warning');
        return;
    }

    $('#btn-simpan-peminjaman').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

    $.ajax({
        type: 'POST',
        url: BASE_URL + 'peminjaman/store',
        data: {
            id_member: currentMemberId,
            id_buku: id_buku,
            tanggal_pinjam: tanggal_pinjam,
            durasi_pinjam: durasi_pinjam
        },
        dataType: 'json',
        success: function(res) {
            if (res.success) {
                $('#modalTambahPeminjaman').modal('hide');
                currentPeminjaman = res.peminjaman || [];
                renderTabelPeminjaman();
                alert(res.message);
            } else {
                showModalAlert('modal-alert', res.message, 'danger');
            }
        },
        error: function() {
            showModalAlert('modal-alert', 'Terjadi kesalahan server.', 'danger');
        },
        complete: function() {
            $('#btn-simpan-peminjaman').prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Simpan');
        }
    });
}

// ═══════════════════════════════════════════════════
// FITUR 4 & 5: Pengembalian + Denda
// ═══════════════════════════════════════════════════
function bukaModalKembali(idPeminjaman) {
    const pjm = currentPeminjaman.find(p => p.id_peminjaman == idPeminjaman);
    if (!pjm) return;

    $('#hidden-id-peminjaman-kembali').val(idPeminjaman);
    $('#return-kode-pinjam').text(pjm.kode_peminjaman || '-');
    $('#return-judul-buku').text(pjm.title_book || '-');
    $('#return-tgl-pinjam').text(formatTanggal(pjm.tanggal_pinjam));
    $('#return-batas-kembali').text(formatTanggal(pjm.tanggal_harus_kembali));

    const today = new Date().toISOString().split('T')[0];
    $('#tanggal_kembali').val(today);
    $('#denda').val(0);
    $('#modal-kembali-alert').hide();
    $('#info-keterlambatan').hide();

    $('#modalKembalikan').modal('show');

    // Hitung keterlambatan langsung
    hitungKeterlambatan();
}

function hitungKeterlambatan() {
    const idPeminjaman = parseInt($('#hidden-id-peminjaman-kembali').val());
    const tanggal_kembali = $('#tanggal_kembali').val();

    const pjm = currentPeminjaman.find(p => p.id_peminjaman == idPeminjaman);
    if (!pjm || !tanggal_kembali) return;

    const batas = new Date(pjm.tanggal_harus_kembali);
    const kembali = new Date(tanggal_kembali);
    const diffDays = Math.floor((kembali - batas) / (1000 * 60 * 60 * 24));

    if (diffDays > 0) {
        $('#hari-terlambat').text(diffDays);
        $('#saran-denda').text('Rp ' + formatNumber(diffDays * DENDA_PER_HARI));
        $('#denda').val(diffDays * DENDA_PER_HARI);
        $('#info-keterlambatan').show();
    } else {
        $('#info-keterlambatan').hide();
        $('#denda').val(0);
    }
}

function prosesKembalikan() {
    const id_peminjaman = $('#hidden-id-peminjaman-kembali').val();
    const tanggal_kembali = $('#tanggal_kembali').val();
    const denda = parseInt($('#denda').val()) || 0;

    if (!tanggal_kembali) {
        showModalAlert('modal-kembali-alert', 'Tanggal pengembalian wajib diisi.', 'warning');
        return;
    }

    $('#btn-proses-kembali').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Memproses...');

    $.ajax({
        type: 'POST',
        url: BASE_URL + 'peminjaman/kembalikan',
        data: {
            id_peminjaman: id_peminjaman,
            tanggal_dikembalikan: tanggal_kembali,
            denda: denda
        },
        dataType: 'json',
        success: function(res) {
            if (res.success) {
                $('#modalKembalikan').modal('hide');
                currentPeminjaman = res.peminjaman || [];
                renderTabelPeminjaman();
                alert(res.message);
            } else {
                showModalAlert('modal-kembali-alert', res.message, 'danger');
            }
        },
        error: function() {
            showModalAlert('modal-kembali-alert', 'Terjadi kesalahan server.', 'danger');
        },
        complete: function() {
            $('#btn-proses-kembali').prop('disabled', false).html('<i class="fas fa-check mr-1"></i> Proses Pengembalian');
        }
    });
}

// ═══════════════════════════════════════════════════
// Utilitas
// ═══════════════════════════════════════════════════
function formatTanggal(dateStr) {
    if (!dateStr) return '—';
    const d = new Date(dateStr);
    return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
}

function formatNumber(num) {
    return Number(num).toLocaleString('id-ID');
}

function isOverdue(batasKembali) {
    if (!batasKembali) return false;
    const today = new Date();
    today.setHours(0,0,0,0);
    return today > new Date(batasKembali);
}

function showModalAlert(elementId, message, type) {
    const el = $('#' + elementId);
    el.removeClass().addClass('alert alert-' + type);
    el.html('<i class="fas fa-exclamation-circle mr-1"></i>' + message);
    el.show();
}

function escHtml(str) {
    if (!str) return '';
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}
</script>
<?= $this->endSection() ?>
