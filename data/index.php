<?php
session_start();
// Proteksi Halaman: Cek apakah admin sudah login
if (!isset($_SESSION['login'])) { 
    header("Location: ../auth/login.php"); 
    exit; 
}

include '../config/koneksi.php';

// Fitur Pencarian Produk
$keyword = "";
if (isset($_POST['cari'])) {
    $keyword = mysqli_real_escape_string($koneksi, $_POST['keyword']);
    $query = "SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' ORDER BY id DESC";
} else {
    $query = "SELECT * FROM produk ORDER BY id DESC";
}
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk | Galang Store</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f8f9fa; 
            color: #2d3748; 
        }
        .breadcrumb-item a { 
            text-decoration: none; 
            color: #3182ce; 
            font-weight: 600; 
        }
        .table-container { 
            background: white; 
            border-radius: 20px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.05); 
            overflow: hidden; 
        }
        .table thead { 
            background-color: #f7fafc; 
        }
        .table th { 
            font-size: 0.75rem; 
            text-transform: uppercase; 
            letter-spacing: 0.05em; 
            color: #718096; 
            border: none; 
        }
        .product-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }
        .btn-action { 
            width: 35px; 
            height: 35px; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            border-radius: 10px; 
            transition: 0.3s; 
            text-decoration: none;
        }
        
        @media print {
            .no-print, .btn, form, nav, .breadcrumb { 
                display: none !important; 
            }
            .table-container { 
                box-shadow: none; 
                border: 1px solid #e2e8f0; 
            }
            body { 
                background-color: white; 
            }
            /* Menampilkan gambar saat diprint */
            .product-img {
                border: none;
            }
        }
    </style>
</head>
<body class="py-5">

<div class="container">
    <div class="row align-items-center mb-4 no-print">
        <div class="col-md-6 text-start">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Produk</li>
                </ol>
            </nav>
            <h2 class="fw-bold m-0 text-dark">Daftar Produk</h2>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <button onclick="window.print()" class="btn btn-outline-secondary rounded-pill px-4 me-2">
                <i class="fas fa-print me-2"></i>Cetak
            </button>
            <a href="tambah.php" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fas fa-plus me-2"></i>Tambah Produk
            </a>
        </div>
    </div>

    <div class="row mb-4 no-print">
        <div class="col-md-5">
            <form action="" method="POST" class="input-group">
                <input type="text" name="keyword" class="form-control border-0 shadow-sm" 
                       style="border-radius: 12px 0 0 12px;" placeholder="Cari nama produk..." 
                       value="<?= htmlspecialchars($keyword); ?>">
                <button type="submit" name="cari" class="btn btn-white border-0 shadow-sm px-3" 
                        style="border-radius: 0 12px 12px 0;">
                    <i class="fas fa-search text-primary"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="table-container border">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-start">
                <thead>
                    <tr>
                        <th class="ps-4 py-3 text-center" width="5%">No</th>
                        <th class="py-3 text-center" width="10%">Foto</th> <th class="py-3">Informasi Produk</th>
                        <th class="py-3">Harga</th>
                        <th class="py-3 text-center">Stok</th>
                        <th class="py-3 text-center no-print">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if(mysqli_num_rows($result) > 0) :
                        while($row = mysqli_fetch_assoc($result)) : 
                    ?>
                    <tr>
                        <td class="text-center text-muted small"><?= $no++; ?></td>
                        <td class="text-center">
                            <?php 
                            $gambar = !empty($row['gambar']) ? $row['gambar'] : 'default.png';
                            ?>
                            <img src="../assets/img/<?= $gambar; ?>" class="product-img" alt="produk">
                        </td>
                        <td>
                            <div class="fw-bold text-dark"><?= htmlspecialchars($row['nama_produk']); ?></div>
                            <small class="text-muted small">ID: #PROD-<?= $row['id']; ?></small>
                        </td>
                        <td>
                            <span class="text-primary fw-bold">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></span>
                        </td>
                        <td class="text-center">
                            <?php if($row['stok'] <= 5): ?>
                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2">Hampir Habis (<?= $row['stok']; ?>)</span>
                            <?php else: ?>
                                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2"><?= $row['stok']; ?> Unit</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center no-print">
                            <a href="edit.php?id=<?= $row['id']; ?>" class="btn-action bg-warning bg-opacity-10 text-warning me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="konfirmasiHapus(<?= $row['id']; ?>)" class="btn-action bg-danger bg-opacity-10 text-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php 
                        endwhile; 
                    else : ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted fst-italic">Data produk tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function konfirmasiHapus(id) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data produk akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'hapus.php?id=' + id;
        }
    })
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>