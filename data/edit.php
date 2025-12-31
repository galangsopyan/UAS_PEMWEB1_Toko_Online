<?php
include '../config/koneksi.php';
$id = $_GET['id'];
$stmt = $koneksi->prepare("SELECT * FROM produk WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h3>Edit Data Produk</h3>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $data['id']; ?>">
            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" value="<?= $data['nama_produk']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" value="<?= $data['harga']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" value="<?= $data['stok']; ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Update Data</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>