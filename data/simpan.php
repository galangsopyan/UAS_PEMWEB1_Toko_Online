<?php
include '../config/koneksi.php';

$nama  = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok  = $_POST['stok'];

$stmt = $koneksi->prepare("INSERT INTO produk (nama_produk, harga, stok) VALUES (?, ?, ?)");
$stmt->bind_param("sii", $nama, $harga, $stok);
$stmt->execute();

header("Location: index.php");
?>