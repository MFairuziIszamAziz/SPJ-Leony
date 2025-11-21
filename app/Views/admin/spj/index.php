<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/menu.php'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mt-4">
            <h1 class="mt-4"><?= $judul ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><?= $sub_judul ?></li>
            </ol>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-header">
                    Daftar SPJ
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Staff</th>
                                <th>Nama SPJ</th>
                                <th>Status</th>
                                <th>Diupload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($spj)): ?>
                            <tr><td colspan="6" class="text-center">Belum ada SPJ.</td></tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($spj as $row): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= esc($row['username']) ?></td>
                                    <td><?= esc($row['nama_spj']) ?></td>
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
                                            Lihat File
                                        </a>
                                        <a href="<?= base_url('spj-admin/edit/'.$row['id_spj']) ?>"
                                           class="btn btn-sm btn-warning">
                                            Verifikasi
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
