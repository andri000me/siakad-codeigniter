<h1 class="text-center">NILAI SISWA</h1>
<div class="row">
	<div class="col-md-8">
		<a href="<?php echo base_url('SiswaController/cetak_nilai') ?>" class="btn btn-success" target="_BLANK" >CETAK</a>
	</div>
	<div class="col-md-4">
		<form action="<?php echo base_url('SiswaController/cari_nilai') ?>" method="post">
			<div class="form-group">
				<input type="text" name="cari" class="form-control" placeholder="Masukan Nama Pelajaran">
			</div>
		</form>
	</div>
</div>
<table class="table table-hover">
	<tr>
		<th>NO</th>
		<th>PELAJARAN</th>
		<th>JAM AJAR</th>
		<th>DOSEN</th>
		<th>NILAI</th>
	</tr>
	<?php foreach ($nilai as $n): ?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $n['nama_pelajaran'] ?></td>
			<td><?php echo $n['jam_pelajaran'] ?></td>
			<td><?php echo $n['nama_guru'] ?></td>
			<td><?php echo $n['nilai'] ?></td>
		</tr>
	<?php endforeach ?>
</table>