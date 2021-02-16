<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="card" style="width: 50%;">
        <div class="card-body">

            <form action="<?= base_url('admin/potonganGaji/tambahDataAksi') ?>" method="POST">
                <div class="form-group">
                    <label for="">Jenis Potongan</label>
                    <input type="text" name="potongan" class="form-control">
                    <?= form_error('potongan') ?>
                </div>
                <div class="form-group">
                    <label for="">Jumlah Potongan</label>
                    <input type="number" name="jml_potongan" class="form-control">
                    <?= form_error('jml_potongan') ?>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

</div>