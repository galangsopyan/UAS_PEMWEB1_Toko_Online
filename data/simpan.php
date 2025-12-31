<?php
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];
    
    // 1. Ambil informasi file
    $filename  = $_FILES['gambar']['name'];
    $tmp_name  = $_FILES['gambar']['tmp_name'];
    
    if ($filename != "") {
        // 2. Bersihkan nama produk (Ganti spasi jadi underscore, ubah ke huruf kecil)
        $clean_name = strtolower(str_replace(' ', '_', $nama_produk));
        
        // 3. Ambil ekstensi asli (jpg, png, dll)
        $ekstensi = pathinfo($filename, PATHINFO_EXTENSION);
        
        // 4. Gabungkan: nama_produk_timestamp.ekstensi (Timestamp tetap perlu agar file tidak duplikat)
        $nama_file_baru = $clean_name . "_" . time() . "." . $ekstensi;
        $folder         = "../assets/img/" . $nama_file_baru;
        
        move_uploaded_file($tmp_name, $folder);
    } else {
        $nama_file_baru = "default.png";
    }

    $query = "INSERT INTO produk (nama_produk, harga, stok, gambar) VALUES ('$nama_produk', '$harga', '$stok', '$nama_file_baru')";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php?pesan=berhasil");
    }
}
?>