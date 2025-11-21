<?php include(APPPATH . 'Views/layout/header.php'); ?>
<?php include(APPPATH . 'Views/layout/menu.php'); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $judul ?? 'Data User'; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><?= $sub_judul ?? ''; ?></li>
            </ol>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Daftar User</span>
                    <a href="<?= base_url('/user/create'); ?>" class="btn btn-primary btn-sm">
                        + Tambah User
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th style="width:5%">#</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th style="width:18%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (! empty($users)): ?>
                            <?php $no = 1; foreach ($users as $u): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= esc($u['username']); ?></td>
                                    <td><?= esc($u['role']); ?></td>
                                    <td>
                                        <a href="<?= base_url('/user/edit/' . $u['id_user']); ?>"
                                           class="btn btn-warning btn-sm">Edit</a>

                                        <form action="<?= base_url('/user/delete/' . $u['id_user']); ?>"
                                              method="post"
                                              style="display:inline-block"
                                              onsubmit="return confirm('Hapus user ini?');">
                                            <?= csrf_field(); ?>
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4">Belum ada data user.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <?php include(APPPATH . 'Views/layout/footer.php'); ?>
</div>
