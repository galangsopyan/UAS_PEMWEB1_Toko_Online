<?php
include '../config/koneksi.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    
    // Cek apakah ada file gambar baru yang diunggah
    if ($_FILES['gambar']['name'] != "") {
        $ekstensi = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $nama_baru = time() . "." . $ekstensi;
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/img/" . $nama_baru);
        
        $query = "UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok', gambar='$nama_baru' WHERE id='$id'";
    } else {
        // Jika tidak ada gambar baru, jangan ubah kolom gambar
        $query = "UPDATE produk SET nama_produk='$nama', harga='$harga', stok='$stok' WHERE id='$id'";
    }

    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php?pesan=update_berhasil");
    }
}
?>