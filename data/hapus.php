<?php
include '../config/koneksi.php';

$id = $_GET['id'];
$stmt = $koneksi->prepare("DELETE FROM produk WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php?pesan=hapus_berhasil");
} else {
    echo "Gagal menghapus data.";
}
?>