<?php
session_start();
// Pastikan koneksi disertakan dengan benar
include '../config/koneksi.php';

if (isset($_POST['id'])) {
    // Ambil data dari form dengan aman
    $id          = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $harga       = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $stok        = mysqli_real_escape_string($koneksi, $_POST['stok']);
    
    // Logika Pemrosesan Gambar
    if ($_FILES['gambar']['name'] != "") {
        // 1. Buat nama file dinamis: nama_barang_waktu.ekstensi
        $clean_name = strtolower(str_replace(' ', '_', $nama_produk));
        $ekstensi   = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $nama_baru  = $clean_name . "_" . time() . "." . $ekstensi;
        
        // 2. Tentukan lokasi folder
        $target_folder = "../assets/img/" . $nama_baru;
        
        // 3. Upload file ke folder
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_folder)) {
            // Update database termasuk kolom gambar baru
            $query = "UPDATE produk SET 
                        nama_produk = '$nama_produk', 
                        harga = '$harga', 
                        stok = '$stok', 
                        gambar = '$nama_baru' 
                      WHERE id = '$id'";
        }
    } else {
        // Jika tidak ada gambar baru, update data teks saja
        $query = "UPDATE produk SET 
                    nama_produk = '$nama_produk', 
                    harga = '$harga', 
                    stok = '$stok' 
                  WHERE id = '$id'";
    }

    // Eksekusi Query
    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php?pesan=update_berhasil");
        exit();
    } else {
        echo "Error Database: " . mysqli_error($koneksi);
    }
} else {
    // Jika diakses langsung tanpa klik tombol update
    header("Location: index.php");
    exit();
}
?>