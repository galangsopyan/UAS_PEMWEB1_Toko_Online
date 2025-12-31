<?php
session_start();
include '../config/koneksi.php';

// Masukkan library SweetAlert2 melalui CDN
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
echo '<style>body { font-family: "Inter", sans-serif; }</style>';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['login'] = true;
        header("Location: ../dashboard.php");
        exit();
    } else {
        // Tampilan Notifikasi Gagal yang Profesional
        echo "<script>
            setTimeout(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Akses Ditolak',
                    text: 'Username atau password tidak sesuai!',
                    confirmButtonColor: '#3182ce'
                }).then(() => { window.location='login.php'; });
            }, 100);
        </script>";
    }
}
?>