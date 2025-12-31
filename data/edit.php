<?php
session_start();
if (!isset($_SESSION['login'])) { 
    header("Location: ../auth/login.php"); 
    exit; 
}

include '../config/koneksi.php';

$id = $_GET['id'];
$stmt = $koneksi->prepare("SELECT * FROM produk WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk | Galang Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8f9fa; color: #2d3748; }
        .card { border: none; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .form-label { font-weight: 600; color: #4a5568; }
        .img-preview { width: 120px; height: 120px; object-fit: cover; border-radius: 15px; border: 2px solid #e2e8f0; }
        .btn-update { background-color: #3182ce; border: none; border-radius: 12px; font-weight: 600; padding: 10px; transition: 0.3s; }
        .btn-update:hover { background-color: #2b6cb0; transform: translateY(-2px); }
    </style>
</head>
<body class="py-5">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="mb-4">
                <a href="index.php" class="text-decoration-none text-muted small fw-bold">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                </a>
                <h2 class="fw-bold mt-2">Edit Produk</h2>
            </div>

            <div class="card p-4">
                <form action="update.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $data['id']; ?>">

                    <div class="mb-4 text-center">
                        <label class="d-block form-label mb-3">Foto Produk Saat Ini</label>
                        <?php 
                            $gambar = !empty($data['gambar']) ? $data['gambar'] : 'default.png';
                        ?>
                        <img src="../assets/img/<?= $gambar; ?>" id="preview" class="img-preview mb-2 shadow-sm">
                        <p class="text-muted small">Pratinjau Gambar</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ganti Foto (Opsional)</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*" onchange="previewImage(this)">
                        <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" value="<?= htmlspecialchars($data['nama_produk']); ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" value="<?= $data['harga']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" value="<?= $data['stok']; ?>" required>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" name="update" class="btn btn-update text-white">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk pratinjau gambar sebelum diupload
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>