<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: auth/login.php"); exit; }
include 'config/koneksi.php';

// Ambil statistik produk
$query_produk = mysqli_query($koneksi, "SELECT COUNT(*) as total, SUM(stok) as total_stok FROM produk");
$stats = mysqli_fetch_assoc($query_produk);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Galang Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f0f2f5; color: #1a202c; }
        .navbar { background: #ffffff !important; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .navbar-brand { color: #3182ce !important; font-weight: 800; }
        
        .card-custom { border: none; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: all 0.3s ease; }
        .card-custom:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        
        .api-widget { background: linear-gradient(135deg, #3182ce 0%, #2c5282 100%); color: white; border: none; }
        .weather-icon { font-size: 2.5rem; }
        .icon-box { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fas fa-store me-2"></i>GALANG STORE</a>
        <div class="d-flex align-items-center">
            <div class="me-3 d-none d-md-block">
                <small class="text-muted d-block">Selamat Datang,</small>
                <span class="fw-bold">Administrator</span>
            </div>
            <a href="auth/logout.php" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
        </div>
    </div>
</nav>

<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card card-custom api-widget p-4 h-100">
                <div class="row align-items-center h-100">
                    <div class="col-md-7 border-end border-white border-opacity-25">
                        <h5 class="fw-bold mb-3"><i class="fas fa-quote-left me-2"></i>Inspirasi Hari Ini</h5>
                        <p id="quote-text" class="fst-italic opacity-90">"Memuat kata-kata motivasi..."</p>
                        <small id="quote-author" class="fw-bold text-warning"></small>
                    </div>
                    <div class="col-md-5 ps-md-4 mt-3 mt-md-0 text-center">
                        <div id="weather-icon" class="weather-icon mb-2">☁️</div>
                        <h3 id="weather-temp" class="fw-bold mb-0">--°C</h3>
                        <p id="weather-desc" class="small mb-0 opacity-75 text-uppercase">Memuat Cuaca...</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-custom p-4 bg-white h-100">
                <div class="icon-box bg-primary bg-opacity-10 text-primary">
                    <i class="fas fa-boxes-stacked fa-lg"></i>
                </div>
                <h6 class="text-muted fw-bold small">TOTAL JENIS PRODUK</h6>
                <h2 class="fw-extrabold mb-0"><?php echo $stats['total'] ?? 0; ?> <small class="fs-6 text-muted fw-normal">Item</small></h2>
                <hr class="my-3">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="small text-muted">Total Stok Tersedia:</span>
                    <span class="badge bg-success-subtle text-success rounded-pill"><?php echo $stats['total_stok'] ?? 0; ?> Unit</span>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card card-custom p-4 bg-white shadow-sm">
                <h5 class="fw-bold mb-4">Kendali Cepat</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="data/index.php" class="btn btn-light w-100 p-3 text-start border shadow-sm hover-shadow">
                            <i class="fas fa-list text-primary me-2"></i> Lihat Daftar Produk
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="data/tambah.php" class="btn btn-light w-100 p-3 text-start border shadow-sm">
                            <i class="fas fa-plus-circle text-success me-2"></i> Tambah Produk Baru
                        </a>
                    </div>
                    <div class="col-md-4">
                        <button onclick="window.print()" class="btn btn-light w-100 p-3 text-start border shadow-sm">
                            <i class="fas fa-print text-secondary me-2"></i> Cetak Laporan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // 1. API MOTIVASI (Quotable)
    fetch('https://api.quotable.io/random?tags=technology,business')
        .then(res => res.json())
        .then(data => {
            document.getElementById('quote-text').innerText = `"${data.content}"`;
            document.getElementById('quote-author').innerText = `— ${data.author}`;
        }).catch(() => {
            document.getElementById('quote-text').innerText = "Sukses bukan kunci kebahagiaan. Kebahagiaan adalah kunci kesuksesan.";
        });

    // 2. API CUACA (Open-Meteo - Tanpa API Key)
    // Mengambil data cuaca Jakarta secara default
    fetch('https://api.open-meteo.com/v1/forecast?latitude=-6.2088&longitude=106.8456&current_weather=true')
        .then(res => res.json())
        .then(data => {
            const temp = Math.round(data.current_weather.temperature);
            document.getElementById('weather-temp').innerText = temp + "°C";
            document.getElementById('weather-desc').innerText = "Jakarta, ID";
        });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>