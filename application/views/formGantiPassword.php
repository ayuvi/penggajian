<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="card" style="width: 40%;">
        <div class="card-body">
            <form action="<?= base_url('gantiPassword/gantiPasswordAksi'); ?>" method="POST">
                <div class="form-group">
                    <label for="">New Password</label>
                    <input type="password" name="newPassword" class="form-control">
                    <?= form_error('newPassword', '<div class="text-small text-danger"></div>') ?>
                </div>
                <div class="form-group">
                    <label for="">Repeat Password</label>
                    <input type="password" name="repeatPassword" class="form-control">
                    <?= form_error('repeatPassword', '<div class="text-small text-danger"></div>') ?>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>

    <!-- Content Row -->

    <!-- Content Row -->

</div>