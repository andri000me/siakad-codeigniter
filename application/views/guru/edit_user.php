<h1 class="text-center">UBAH USER</h1>
<br>
<form action="<?php echo base_url('GuruController/do_edit_user') ?>" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Guru</label>
		<input required="" value="<?php echo $guru['nama_guru'] ?>" type="text" name="nama" class="form-control">
	</div>
	<div class="form-group">
		<label>Alamat Guru</label>
		<input required="" value="<?php echo $guru['alamat_guru'] ?>" type="text" name="alamat" class="form-control">
	</div>
	<div class="form-group">
		<label>Foto Guru</label>
		<img style="width: 100px" src="<?php echo base_url() ?>asset/image/<?php echo $guru['foto_guru'] ?>"><br>
		<input type="file" name="foto" class="form-control">
	</div>
	<input type="submit" name="foto" class="btn btn-info">
</form>