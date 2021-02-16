<!-- Begin Page Content -->
<div class="container-fluid mb-5">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
	</div>

	<!-- Content Row -->
	<?= $this->session->flashdata('pesan') ?>

	<a href="<?= base_url('admin/dataPegawai/tambahData') ?>" class="btn btn-sm btn-success mb-3"><i class="fas fa-plus">Tambah Data</i></a>

	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th class="text-center" scope="col">No</th>
				<th class="text-center" scope="col">NIK</th>
				<th class="text-center" scope="col">Nama Pegawai</th>
				<th class="text-center" scope="col">Jenis Kelamin</th>
				<th class="text-center" scope="col">Jabatan</th>
				<th class="text-center" scope="col">Status</th>
				<th class="text-center" scope="col">Tgl Masuk</th>
				<th class="text-center" scope="col">Photo</th>
				<th class="text-center" scope="col">Hak Akses</th>
				<th class="text-center" scope="col">Action</th>
			</tr>
		</thead>

		<?php $no = 1;
		foreach ($pegawai as $p) : ?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $p['nik']; ?></td>
				<td><?= $p['nama_pegawai']; ?></td>
				<td><?= $p['jenis_kelamin']; ?></td>
				<td><?= $p['jabatan']; ?></td>
				<td><?= $p['tanggal_masuk']; ?></td>
				<td><?= $p['status']; ?></td>
				<td><img src="<?= base_url() . 'assets/photo/' . $p['photo'] ?>" width="75px"></td>
				<?php if ($p['hak_akses'] == '1') { ?>
					<td>Admin</td>
				<?php } else { ?>
					<td>Pegawai</td>
				<?php } ?>
				<td>
					<center>
						<a href="<?= base_url(); ?>admin/dataPegawai/updateData/<?= $p['id_pegawai']; ?>" class="badge badge-success">edit</a>
						<br>
						<a onclick="return confirm('Are you sure?')" href="<?= base_url(); ?>admin/dataPegawai/deleteData/<?= $p['id_pegawai']; ?>" class="badge badge-danger">delete</a>
					</center>
				</td>
			</tr>

		<?php endforeach; ?>
	</table>

	<!-- Content Row -->

</div>