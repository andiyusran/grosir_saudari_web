<?php
include 'config.php';

if (isset($_POST)) {
    if ($_POST['aksi'] == "insert_barang") {
        $id = $_POST['id_barang'];
        $nama = $_POST['nama'];
        $jenis = $_POST['jenis'];
        $modal = $_POST['modal'];
        $harga1 = $_POST['harga1'];
        $harga2 = $_POST['harga2'];
        $harga3 = $_POST['harga3'];
        $jumlah = $_POST['jumlah'];
        $sisa = $_POST['sisa'];


        mysqli_query($konek, "insert into barang values('$id', '$nama', '$jenis', '$modal', '$harga1', '$harga2', '$harga3', '$jumlah', '$sisa')");
        header("location:barang_mainmenu.php");
    }

    if ($_POST['aksi'] == 'edit_barang') {
        $id = $_POST['id_barang'];
        $nama = $_POST['nama'];
        $jenis = $_POST['jenis'];
        $modal = $_POST['modal'];
        $harga1 = $_POST['harga1'];
        $harga2 = $_POST['harga2'];
        $harga3 = $_POST['harga3'];
        $jumlah = $_POST['jumlah'];
        $sisa = $_POST['sisa'];

        mysqli_query($konek, "update barang set nama='$nama', jenis='$jenis', modal='$modal', harga_1='$harga1', harga_2='$harga2', harga_3='$harga3', jumlah='$jumlah', sisa='$sisa' where id_barang='$id'");
        header("location:barang_mainmenu.php");
    }

    if ($_GET['aksi'] == 'delete_barang') {
        $id = $_GET['id'];
        mysqli_query($konek, "delete from barang where id_barang='$id'");
        header("location:barang_mainmenu.php");
    }
}
