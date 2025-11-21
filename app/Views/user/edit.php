<?php include(APPPATH . 'Views/layout/header.php'); ?>
<?php include(APPPATH . 'Views/layout/menu.php'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $judul ?? 'Edit User'; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><?= $sub_judul ?? ''; ?></li>
            </ol>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-header">
                    Form Edit User
                </div>
                <div class="card-body">
                    <form action="<?= base_url('/user/update/' . $user['id_user']); ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control"
                                   value="<?= old('username', $user['username']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Password Baru (kosongkan kalau tidak ganti)
                            </label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <?php $role = old('role', $user['role']); ?>
                            <select name="role" class="form-control" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="staff"       <?= $role === 'staff' ? 'selected' : ''; ?>>Staff</option>
                                <option value="verifikator" <?= $role === 'verifikator' ? 'selected' : ''; ?>>Verifikator</option>
                                <option value="pimpinan"    <?= $role === 'pimpinan' ? 'selected' : ''; ?>>Pimpinan</option>
                                <option value="admin"       <?= $role === 'admin' ? 'selected' : ''; ?>>Admin</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url('/user'); ?>" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <?php include(APPPATH . 'Views/layout/footer.php'); ?>
</div>
