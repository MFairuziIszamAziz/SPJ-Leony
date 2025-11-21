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
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url('spj/create') ?>" class="btn btn-primary mb-3">
                        + Upload SPJ
                    </a>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama SPJ</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($spj)): ?>
                                <tr><td colspan="4" class="text-center">Belum ada SPJ.</td></tr>
                            <?php else: ?>
                                <?php foreach ($spj as $row): ?>
                                    <tr>
                                        <td><?= esc($row['nama_spj']) ?></td>
                                        <td>
                                            <a href="<?= base_url('writable/uploads/spj/'.$row['file_spj']) ?>"
                                               target="_blank">Download</a>
                                        </td>
                                        <td><?= esc($row['status']) ?></td>
                                        <td><?= esc($row['created_at']) ?></td>
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
