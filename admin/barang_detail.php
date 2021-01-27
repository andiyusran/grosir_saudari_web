<?php
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span> Detail Barang</h3>
<a class="btn" href="barang_mainmenu.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>

<?php
$brg = mysqli_real_escape_string($konek, $_GET['id']);

$det = mysqli_query($konek, "select * from barang where id_barang='$brg'") or die(mysqli_error($konek));
while ($d = mysqli_fetch_array($det)) {
?>
    <table class="table">
        <tr>
            <td>Nama</td>
            <td><?php echo $d['nama'] ?></td>
        </tr>
        <tr>
            <td>Jenis</td>
            <td><?php echo $d['jenis'] ?></td>
        </tr>
        <tr>
            <td>Modal</td>
            <td><?php echo number_format($d['modal']) ?>,-</td>
        </tr>
        <tr>
            <td>Harga 1</td>
            <td><?php echo number_format($d['harga_1']) ?>,-</td>
        </tr>
        <tr>
            <td>Harga 2</td>
            <td><?php echo number_format($d['harga_2']) ?>,-</td>
        </tr>
        <tr>
            <td>Harga 3</td>
            <td><?php echo number_format($d['harga_3']) ?>,-</td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td><?php echo $d['jumlah'] ?></td>
        </tr>
        <tr>
            <td>Sisa</td>
            <td><?php echo $d['sisa'] ?></td>
        </tr>
    </table>
<?php
}
?>