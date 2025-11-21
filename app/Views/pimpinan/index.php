<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/menu.php'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $judul ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><?= $sub_judul ?></li>
            </ol>

            <!-- CARD STATISTIK -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card border-start-primary shadow-sm h-100">
                        <div class="card-body">
                            <div class="fw-bold text-muted mb-1">Total SPJ</div>
                            <div class="h3 mb-0"><?= $total_spj ?></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card border-start-warning shadow-sm h-100">
                        <div class="card-body">
                            <div class="fw-bold text-muted mb-1">SPJ Menunggu</div>
                            <div class="h3 mb-0"><?= $spj_menunggu ?></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card border-start-success shadow-sm h-100">
                        <div class="card-body">
                            <div class="fw-bold text-muted mb-1">SPJ Diverifikasi</div>
                            <div class="h3 mb-0"><?= $spj_verif ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TABEL SPJ TERBARU -->
            <div class="card mb-4">
                <div class="card-header">
                    Daftar SPJ Terbaru
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama SPJ</th>
                                <th>Staff</th>
                                <th>Status</th>
                                <th>Tanggal Upload</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($spj_terbaru)): ?>
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada SPJ.</td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($spj_terbaru as $row): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= esc($row['nama_spj']) ?></td>
                                        <td><?= esc($row['username']) ?></td>
                                        <td>
                                            <?php if ($row['status'] === 'menunggu'): ?>
                                                <span class="badge bg-warning text-dark">Menunggu</span>
                                            <?php elseif ($row['status'] === 'lengkap'): ?>
                                                <span class="badge bg-success">Lengkap</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Belum Lengkap</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($row['created_at']) ?></td>
                                        <td>
                                            <a href="<?= base_url('writable/uploads/spj/'.$row['file_spj']) ?>"
                                               class="btn btn-sm btn-outline-primary" target="_blank">
                                                Lihat
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <?php include(APPPATH.'Views/layout/footer.php'); ?>
</div>
