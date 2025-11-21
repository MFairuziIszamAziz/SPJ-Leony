<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/menu.php'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mt-4">
            <h1 class="mt-4"><?= $judul ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><?= $sub_judul ?></li>
            </ol>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('spj/store') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label">Nama SPJ</label>
                            <input type="text" name="nama_spj" class="form-control"
                                   value="<?= old('nama_spj') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">File SPJ (.doc / .docx)</label>
                            <input type="file" name="file_spj" class="form-control"
                                   accept=".doc,.docx" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Upload</button>
                        <a href="<?= base_url('spj/list') ?>" class="btn btn-secondary">Lihat Status</a>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php include(APPPATH.'Views/layout/footer.php'); ?>
