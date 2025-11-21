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
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-header">
                    Verifikasi SPJ
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Staff</dt>
                        <dd class="col-sm-9"><?= esc($spj['username']) ?></dd>

                        <dt class="col-sm-3">Nama SPJ</dt>
                        <dd class="col-sm-9"><?= esc($spj['nama_spj']) ?></dd>

                        <dt class="col-sm-3">File</dt>
                        <dd class="col-sm-9">
                            <a href="<?= base_url('writable/uploads/spj/'.$spj['file_spj']) ?>"
                               target="_blank" class="btn btn-sm btn-outline-primary">
                                Download / Lihat File
                            </a>
                        </dd>

                        <dt class="col-sm-3">Status Saat Ini</dt>
                        <dd class="col-sm-9">
                            <?= esc($spj['status']) ?>
                        </dd>
                    </dl>

                    <hr>

                    <form action="<?= base_url('spj-admin/update/'.$spj['id_spj']); ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label">Ubah Status</label>
                            <select name="status" class="form-control" required>
                                <option value="menunggu"     <?= $spj['status'] === 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
                                <option value="lengkap"      <?= $spj['status'] === 'lengkap' ? 'selected' : '' ?>>Lengkap</option>
                                <option value="belum lengkap"<?= $spj['status'] === 'belum lengkap' ? 'selected' : '' ?>>Belum Lengkap</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url('spj-admin'); ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <?php include(APPPATH.'Views/layout/footer.php'); ?>
</div>
