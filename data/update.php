<?php
session_start();
// Pastikan koneksi disertakan dengan benar
include '../config/koneksi.php';

if (isset($_POST['id'])) {
    $id          = $_POST['id'];
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];
    
    if ($_FILES['gambar']['name'] != "") {
        // Buat nama file berdasarkan nama produk terbaru
        $clean_name = strtolower(preg_replace("/[^a-zA-Z0-9]/", "_", $nama_produk));
        $ekstensi   = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $nama_baru  = $clean_name . "_" . time() . "." . $ekstensi;
        
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/img/" . $nama_baru);
        
        $query = "UPDATE produk SET nama_produk='$nama_produk', harga='$harga', stok='$stok', gambar='$nama_baru' WHERE id='$id'";
    } else {
        $query = "UPDATE produk SET nama_produk='$nama_produk', harga='$harga', stok='$stok' WHERE id='$id'";
    }

    mysqli_query($koneksi, $query);
    header("Location: index.php");
}
?>