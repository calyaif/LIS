<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?= base_url('/') ?>" class="brand-link">
        <span class="brand-text font-weight-light ml-3">Library Information System</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">

                <li class="nav-item">
                    <a href="<?= base_url('/dashboard') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('/list/books') ?>" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Master Buku</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('/list/members') ?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Master Member</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('/list/peminjaman') ?>" class="nav-link">
                        <i class="nav-icon fas fa-book-reader"></i>
                        <p>Data Peminjaman</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/list/pengembalian') ?>" class="nav-link">
                        <i class="nav-icon fas fa-undo"></i>
                        <p>Data Pengembalian</p>
                    </a>
                </li>
                                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('/laporan/buku') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Data Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/laporan/member') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Data Member</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/laporan/label-buku') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cetak Label Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/laporan/label-member') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cetak Kartu Member</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>