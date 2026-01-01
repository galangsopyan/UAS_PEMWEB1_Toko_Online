<?php
// Deteksi lokasi server
$is_localhost = ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_ADDR'] == '127.0.0.1');

if ($is_localhost) {
    // PENGATURAN UNTUK LAPTOP (LOCALHOST)
    $host = "127.0.0.1:3307";
    $user = "root";
    $pass = "";
    $db   = "Uas_Pemweb1";
} else {
    // PENGATURAN UNTUK INFINITYFREE (ONLINE)
    $host = "sql204.infinityfree.com"; // Ganti dengan Hostname Anda
    $user = "if0_40797001";           // Ganti dengan Username Anda
    $pass = "lkw6Raa0SATALk";       // Ganti dengan Password FTP dari Account Details
    $db   = "if0_40797001_db_uas";    // Ganti dengan Nama Database Lengkap
}

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>