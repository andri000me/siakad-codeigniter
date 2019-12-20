<h1 class="text-center">HALAMAN SISWA</h1>
<br>
<div class="row">
	<div class="col-md-8">
		<a href="<?php echo base_url('StaffController/tambah_siswa') ?>" class="btn btn-info">TAMBAH</a>
	</div>
	<div class="col-md-4">
		<form>
			<div class="form-group">
				<input type="text" name="cari" class="form-control" placeholder="masukan nama siswa">	
			</div>
		</form>
	</div>
</div>
<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success">
		<p><?php echo $this->session->flashdata('success') ?></p>
	</div>
<?php endif ?>
<table class="table table-hover">
	<tr>
		<th>NO</th>
		<th>NIM</th>
		<th>NAMA</th>
		<th>ALAMAT</th>
		<th>AKSI</th>
	</tr>
	<?php foreach ($siswa as $s): ?>
		<tr>
			<td><?php echo $no ++ ?></td>
			<td><?php echo $s['nim_siswa'] ?></td>
			<td><?php echo $s['nama_siswa'] ?></td>
			<td><?php echo $s['alamat_siswa'] ?></td>
			<td>
				<a href="<?php echo base_url() ?>StaffController/edit/<?php echo $s['id_siswa'] ?>" class="btn btn-info btn-sm">EDIT</a>
				<a href="" class="btn btn-warning btn-sm">HAPUS</a>
				<a href="" class="btn btn-success btn-sm">SHOW</a>
			</td>
		</tr>
	<?php endforeach ?>
</table>