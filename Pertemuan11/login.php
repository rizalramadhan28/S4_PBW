<?php
session_start();

// Jika sudah login, langsung ke index
if (isset($_SESSION['login_Un51k4'])) {
    header('Location: index.php');
    exit;
}

$pesan = '';
if (isset($_GET['message'])) {
    $pesan = htmlspecialchars($_GET['message']);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Toko Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .login-header {
            background: #0d6efd;
            border-radius: 16px 16px 0 0;
            padding: 2rem;
            text-align: center;
            color: #fff;
        }
        .login-header i { font-size: 2.5rem; margin-bottom: .5rem; }
        .login-body { padding: 2rem; }
        .form-control:focus { box-shadow: 0 0 0 3px rgba(13,110,253,.25); }
        .btn-login { border-radius: 8px; padding: .65rem; font-weight: 600; letter-spacing: .5px; }
        .hint { font-size: .8rem; color: #888; text-align: center; margin-top: 1rem; }
    </style>
</head>
<body>

<div class="login-card card">
    <div class="login-header">
        <i class="bi bi-box-seam d-block"></i>
        <h4 class="mb-0 fw-bold">Toko Produk</h4>
        <small class="opacity-75">Masuk untuk melanjutkan</small>
    </div>
    <div class="login-body">

        <?php if ($pesan): ?>
        <div class="alert alert-warning py-2">
            <i class="bi bi-exclamation-circle me-1"></i><?= $pesan ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="proses_login.php" novalidate>
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Pengguna</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="username" class="form-control"
                           placeholder="Masukkan username..." required autofocus>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Kata Sandi</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control"
                           placeholder="Masukkan password..." required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Login
            </button>
        </form>

        <p class="hint">
            <i class="bi bi-info-circle me-1"></i>
            Default: <code>admin</code> / <code>admin123</code>
        </p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>