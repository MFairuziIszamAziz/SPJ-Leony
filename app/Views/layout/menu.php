    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
    <div class="sb-sidenav-menu-heading"></div>

    <?php $role = session()->get('role'); ?>

    <?php if ($role === 'staff'): ?>

        <!-- DASHBOARD STAFF -->
        <a class="nav-link" href="<?= base_url('/'); ?>">
            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
            Dashboard
        </a>

        <!-- INPUT SPJ (STAFF) -->
        <a class="nav-link" href="<?= base_url('/spj/create'); ?>">
            <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
            Input SPJ
        </a>

        <!-- STATUS SPJ (STAFF) -->
        <a class="nav-link" href="<?= base_url('/spj/list'); ?>">
            <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
            Status SPJ
        </a>

        <!-- PENGATURAN AKUN (STAFF) -->
        <a class="nav-link" href="<?= base_url('/setting'); ?>">
            <div class="sb-nav-link-icon"><i class="fas fa-gears"></i></div>
            Pengaturan Akun
        </a>

    <?php endif; ?>


    <?php if (in_array($role, ['admin', 'verifikator'])): ?>

        <!-- DASHBOARD ADMIN / VERIFIKATOR -->
        <a class="nav-link" href="<?= base_url('/nzr_admin/admin_home'); ?>">
            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
            Dashboard Admin
        </a>

        <!-- VERIFIKASI SPJ -->
    <a class="nav-link" href="<?= base_url('/spj-admin'); ?>">
        <div class="sb-nav-link-icon"><i class="fas fa-briefcase"></i></div>
        Verifikasi SPJ
    </a>

    <?php endif; ?>


<?php if (in_array($role, ['pimpinan'])): ?>

    <!-- DASHBOARD PIMPINAN -->
    <a class="nav-link" href="<?= base_url('/pimpinan'); ?>">
        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
        Dashboard
    </a>

    <!-- LIST SEMUA SPJ -->
    <a class="nav-link" href="<?= base_url('/pimpinan'); ?>#list">
        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
        Daftar SPJ
    </a>

<?php endif; ?>

</div>

                </div>

                <div class="sb-sidenav-footer">
                    <div class="small">Masuk Sebagai:</div>
                    <?= session()->get('role') ? session()->get('role') : 'role' ?>
                </div>

            </nav>
        </div>