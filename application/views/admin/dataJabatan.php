<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <!-- Content Row -->
    <a class="btn btn-sm btn-success mb-3" href="<?= base_url('admin/dataJabatan/tambahData')?>"><i class="fas fa-plus">Tambah Data</i></a>

    <?= $this->session->flashdata('pesan')?>

    <table class="table table-bordered table-hover mt-2">
        <thead>
            <tr>
            <th class="text-center" scope="col">No</th>
            <th class="text-center" scope="col">Nama Jabatan</th>
            <th class="text-center" scope="col">Gaji</th>
            <th class="text-center" scope="col">Tj. Transport</th>
            <th class="text-center" scope="col">Uang Makan</th>
            <th class="text-center" scope="col">Total</th>
            <th class="text-center" scope="col">Action</th>
        </tr>    
        </thead>
        <tbody>
           <?php $no=1; foreach ($jabatan as $j) : ?>
            <tr>
                <td scope="row"><?= $no++ ?></td>
                <td><?= $j->nama_jabatan ?></td>
                <td>Rp. <?= number_format($j->gaji_pokok,0,',','.') ?></td>
                <td>Rp. <?= number_format($j->tj_transport,0,',','.') ?></td>
                <td>Rp. <?= number_format($j->uang_makan,0,',','.') ?></td>
                <td>Rp. <?= number_format($j->uang_makan + $j->tj_transport + $j->gaji_pokok,0,',','.') ?></td>
                <td>
                    <center>
                        <a class="btn btn-sm btn-primary" href="<?= base_url('admin/dataJabatan/updateData/'. $j->id_jabatan)?>"><i class="fas fa-edit"></i></a>
                        <a onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger" href="<?= base_url('admin/dataJabatan/deleteData/'. $j->id_jabatan)?>?>"><i class="fas fa-trash"></i></a>
                    </center>
                </td>
            </tr>

        <?php endforeach; ?> 
        </tbody>
        
    </table>

    <!-- Content Row -->

</div>


