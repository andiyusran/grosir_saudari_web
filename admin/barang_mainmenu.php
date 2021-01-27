<?php include 'header.php'; ?>

<h3><span class="glyphicon glyphicon-briefcase"></span> Data Barang</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Barang</button>
<br />
<br />

<?php
//error_reporting(0);
$periksa = mysqli_query($konek, "select * from barang where jumlah <=3");
while ($q = mysqli_fetch_array($periksa)) {
	if ($q['jumlah'] <= 3) {
?>
		<script>
			$(document).ready(function() {
				$('#pesan_sedia').css("color", "red");
				$('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></span>");
			});
		</script>
<?php
		echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stock <a style='color:red'>" . $q['nama'] . "</a> yang tersisa sudah kurang dari 3 . silahkan pesan lagi !!</div>";
	}
}
?>
<?php
$per_hal = 10;
$jumlah_record = mysqli_query($konek, "SELECT COUNT(*) FROM barang");
$jum = mysqli_fetch_assoc($jumlah_record) != NULL;
$halaman = ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-12">
	<table class="=col-md-2">
		<tr>
			<td>Jumlah Record</td>
			<td><?php echo $jum; ?></td>
		</tr>
		<tr>
			<td>Jumlah Halaman</td>
			<td><?php echo $halaman; ?></td>
		</tr>
	</table>
	<a style="margin-bottom: 10px;" href="lap_barang.php" target="_blank" class="btn btn-default pull right"><span class="glyphicon glyphicon-print"></span>Cetak</a>
</div>
<form action="cari_act.php" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari Barang di sini..." aria-describedby="basic-addon1" name="cari">
	</div>
</form>
<br />
<table class="table table-hover">
	<tr>
		<th class="col-md-1">ID Barang</th>
		<th class="col-md-3">Nama Barang</th>
		<th class="col-md-1">Harga 1</th>
		<th class="col-md-1">Harga 2</th>
		<th class="col-md-1">Harga 3</th>
		<th class="col-md-1">Jumlah</th>

		<th class="col-md-2">Opsi</th>
	</tr>
	<?php
	if (isset($_GET['cari'])) {
		$cari = mysqli_real_escape_string($konek, $_GET['cari']);
		$brg = mysqli_query($konek, "select * from barang where nama like '$cari' or jenis like 'cari'");
	} else {
		$brg = mysqli_query($konek, "select * from barang limit $start, $per_hal");
	}
	//$id=0;
	while ($b = mysqli_fetch_array($brg)) {
	?>
		<tr>
			<?php echo $aksi = 'delete_barang'; ?>
			<td><?php echo $b['id_barang'] ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td>Rp.<?php echo number_format($b['harga_1']) ?>,-</td>
			<td>Rp.<?php echo number_format($b['harga_2']) ?>,-</td>
			<td>Rp.<?php echo number_format($b['harga_3']) ?>,-</td>
			<td><?php echo $b['jumlah'] ?></td>
			<td>
				<a href="barang_detail.php?id=<?php echo $b['id_barang']; ?>" class="btn btn-info">Detail</a>
				<a href="barang_edit.php?id=<?php echo $b['id_barang']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ?')){ location.href='api_barang.php?id=<?php echo $b['id_barang']; ?>&aksi=<?php echo $aksi; ?>' }" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="4">Total Modal</td>
		<td>
			<?php
			$x = mysqli_query($konek, "select sum(modal) as total from barang");
			$xx = mysqli_fetch_array($x);
			echo "<b> Rp." . number_format($xx['total']) . ",-</b>";
			?>
		</td>
	</tr>
</table>
<ul class="pagination">
	<?php
	for ($x = 1; $x <= $halaman; $x++) {
	?>
		<li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
	<?php
	}
	?>
</ul>

<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Barang</h4>
			</div>
			<div class="modal-body">
				<form action="api_barang.php" method="POST">
					<div class="form-group">
						<input name="aksi" type="hidden" value="insert_barang">
						<label>ID Barang</label>
						<input name="id_barang" type="text" class="form-control" placeholder="ID Barang">
					</div>
					<div class="form-group">
						<label>Nama Barang</label>
						<input name="nama" type="text" class="form-control" placeholder="Nama Barang">
					</div>
					<div class="form-group">
						<label>Jenis</label>
						<input name="jenis" type="text" class="form-control" placeholder="Jenis">
					</div>
					<div class="form-group">
						<label>Harga Modal</label>
						<input name="modal" type="text" class="form-control" placeholder="Harga Modal">
					</div>
					<div class="form-group">
						<label>Harga 1</label>
						<input name="harga1" type="text" class="form-control" placeholder="Harga 1">
					</div>
					<div class="form-group">
						<label>Harga 2</label>
						<input name="harga2" type="text" class="form-control" placeholder="Harga 2">
					</div>
					<div class="form-group">
						<label>Harga 3</label>
						<input name="harga3" type="text" class="form-control" placeholder="Harga 3">
					</div>
					<div class="form-group">
						<label>Jumlah</label>
						<input name="jumlah" type="text" class="form-control" placeholder="Jumlah">
					</div>
					<div>
						<label>Sisa</label>
						<input name="sisa" type="text" class="form-control" placeholder="Sisa">
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="submit" class="btn btn-primary" value="Simpan">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
include 'footer.php';
?>