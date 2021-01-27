<?php
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span> Edit Barang</h3>
<a class="btn" href="barang_mainmenu.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
<?php
$id_brg = mysqli_real_escape_string($konek, $_GET['id']);
$det = mysqli_query($konek, "select * from barang where id_barang='$id_brg'") or die(mysqli_error($konek));
while ($d = mysqli_fetch_array($det)) {
?>
    <form action="api_barang.php" method="post">
        <table class="table"></table>
        <tr>
            <input name="aksi" type="hidden" value="edit_barang">
            <td></td>
            <td><input type="hidden" name="id_barang" value="<?php echo $d['id_barang'] ?>"></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" class="form-control" value="<?php echo $d['nama'] ?>"></td>
        </tr>
        <tr>
            <td>Jenis</td>
            <td><input type="text" name="jenis" class="form-control" value="<?php echo $d['jenis'] ?>"></td>
        </tr>
        <tr>
            <td>Harga Modal</td>
            <td><input type="text" name="modal" class="form-control" value="<?php echo $d['modal'] ?>"></td>
        </tr>
        <tr>
            <td>Harga 1</td>
            <td><input type="text" name="harga1" class="form-control" value="<?php echo $d['harga_1'] ?>"></td>
        </tr>
        <tr>
            <td>Harga 2</td>
            <td><input type="text" name="harga2" class="form-control" value="<?php echo $d['harga_2'] ?>"></td>
        </tr>
        <tr>
            <td>Harga 3</td>
            <td><input type="text" name="harga3" class="form-control" value="<?php echo $d['harga_3'] ?>"></td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td><input type="text" name="jumlah" class="form-control" value="<?php echo $d['jumlah'] ?>"></td>
        </tr>
        <tr>
            <td>Sisa</td>
            <td><input type="text" name="sisa" class="form-control" value="<?php echo $d['sisa'] ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-info" value="Simpan"></td>
        </tr>
    </form>
<?php
}
?>