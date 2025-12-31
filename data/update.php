<?php
include '../config/koneksi.php';

$id     = $_POST['id'];
$nama   = $_POST['nama_produk'];
$harga  = $_POST['harga'];
$stok   = $_POST['stok'];

$stmt = $koneksi->prepare("UPDATE produk SET nama_produk=?, harga=?, stok=? WHERE id=?");
$stmt->bind_param("siii", $nama, $harga, $stok, $id);

if ($stmt->execute()) {
    header("Location: index.php?pesan=update_berhasil");
} else {
    echo "Gagal mengupdate data.";
}
?>