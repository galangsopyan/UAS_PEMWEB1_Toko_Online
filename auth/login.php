<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Galang Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #3182ce 0%, #2c5282 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            padding: 2.5rem;
        }
        .login-header h2 {
            font-weight: 800;
            color: #2d3748;
            letter-spacing: -1px;
        }
        .form-label {
            font-weight: 600;
            color: #4a5568;
            font-size: 0.9rem;
        }
        .input-group-text {
            background-color: #f7fafc;
            border-right: none;
            color: #a0aec0;
            border-radius: 12px 0 0 12px;
        }
        .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
            padding: 0.75rem 1rem;
            background-color: #f7fafc;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
            background-color: #fff;
        }
        .btn-primary {
            background: #3182ce;
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            font-weight: 700;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background: #2b6cb0;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(49, 130, 206, 0.4);
        }
        .brand-icon {
            width: 60px;
            height: 60px;
            background: #ebf8ff;
            color: #3182ce;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 1.5rem;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="login-card">
        <div class="login-header text-center mb-4">
            <div class="brand-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <h2>Selamat Datang</h2>
            <p class="text-muted">Silakan masuk ke akun admin Anda</p>
        </div>

        <form action="login_proses.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit" name="login" class="btn btn-primary w-100 mb-3">
                MASUK SEKARANG
            </button>
            
            <div class="text-center">
                <small class="text-muted">Galang Store &copy; 2024</small>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>