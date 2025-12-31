<?php
include '../config/koneksi.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    
    // Di dalam logika upload gambar pada update.php
if ($_FILES['gambar']['name'] != "") {
    $clean_name = str_replace(' ', '_', strtolower($nama_produk));
    $ekstensi   = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    $nama_baru  = $clean_name . "_" . time() . "." . $ekstensi;
    
    move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/img/" . $nama_baru);
    
    // Update query termasuk kolom gambar
    $query = "UPDATE produk SET nama_produk='$nama_produk', harga='$harga', stok='$stok', gambar='$nama_baru' WHERE id='$id'";
}

    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php?pesan=update_berhasil");
    }
}
?>