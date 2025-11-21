<?php include('layout/header.php'); ?>
<?php include('layout/menu.php'); ?>

<?php if (isset($css_files)): ?>
    <?php foreach ($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?= $file; ?>" />
    <?php endforeach; ?>
<?php endif; ?>

<!-- Custom styling buat Grocery CRUD -->
<style>
    /* Wrapper */
    .gc-container, .flexigrid {
        font-size: 0.9rem;
    }

    /* Biar tabelnya full lebar card */
    .gc-container table,
    .flexigrid .bDiv table {
        width: 100% !important;
    }

    /* Header card ala Bootstrap */
    .gc-title {
        font-weight: 600;
        margin-bottom: .75rem;
    }

    /* Tombol Add/Edit/Delete biar mirip btn Bootstrap */
    .gc-container a,
    .flexigrid .pDiv a,
    .flexigrid .pButton {
        font-size: 0.8rem;
    }

    .gc-container a.btn,
    .gc-container button.btn {
        padding: .25rem .6rem;
        border-radius: .25rem;
    }

    /* kalau ada tombol hijau/merah dsb dari GC, biasanya pakai inline style.
       Ini cuma bantu sedikit merapikan margin */
    .gc-container .btn,
    .gc-container input[type="button"],
    .gc-container input[type="submit"] {
        margin: 0 .1rem;
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger m-3">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $judul ?? 'Data'; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">
                    <?= session()->get('username') ?: 'username' ?>
                </li>
            </ol>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <span class="gc-title"><?= $sub_judul ?? $judul ?? 'Data'; ?></span>
                        </div>
                        <div class="card-body">
                            <?php // INI OUTPUT GROCERY CRUD ?>
                            <?= $output; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <?php if (isset($js_files)): ?>
        <?php foreach ($js_files as $file): ?>
            <script src="<?= $file; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php include('layout/footer.php'); ?>
</div>
