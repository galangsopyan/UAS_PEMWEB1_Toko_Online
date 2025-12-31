<?php
$host = "localhost";
$user = "root"; // Ini HARUS root, jangan diganti admin
$pass = "";     // Kosongkan
$db   = "uas_pemweb1";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>