<?php
session_start();
// Pastikan hanya admin yang sudah login bisa mengakses halaman ini
if (!isset($_SESSION['login'])) { 
    header("Location: ../auth/login.php"); 
    exit; 
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk | Galang Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f4f7f6; 
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .card { 
            border: none; 
            border-radius: 16px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .form-label { 
            font-weight: 500; 
            color: #4a5568;
            margin-bottom: 0.5rem;
        }
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }
        .form-control:focus {
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
        }
        .btn-primary {
            padding: 0.75rem;
            border-radius: 10px;
            font-weight: 600;
            background-color: #3182ce;
            border: none;
        }
        .btn-primary:hover {
            background-color: #2b6cb0;
        }
        .btn-link {
            text-decoration: none;
            color: #718096;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <h3 class="fw-bold">Tambah Produk Baru</h3>
                <p class="text-muted">Lengkapi formulir di bawah untuk menambah stok.</p>
            </div>
            
            <div class="card p-4">
                <form action="simpan.php" method="POST">
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" class="form-control" placeholder="Contoh: Jam Tangan" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga (Rupiah)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">Rp</span>
                            <input type="number" name="harga" id="harga" class="form-control border-start-0" placeholder="0" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="stok" class="form-label">Jumlah Stok</label>
                        <input type="number" name="stok" id="stok" class="form-control" placeholder="0" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan Produk</button>
                        <a href="index.php" class="btn btn-link">Batal dan Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>