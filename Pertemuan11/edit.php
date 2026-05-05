<?php
require_once 'koneksi.php';
require_once 'auth.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM produk WHERE id = ?");
$stmt->execute([$id]);
$produk = $stmt->fetch();

if (!$produk) {
    $_SESSION['pesan'] = ['tipe' => 'danger', 'teks' => 'Produk tidak ditemukan!'];
    header('Location: index.php');
    exit;
}

$errors = [];
$input  = $produk;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input['nama_produk'] = trim($_POST['nama_produk'] ?? '');
    $input['kategori']    = trim($_POST['kategori'] ?? '');
    $input['harga']       = trim($_POST['harga'] ?? '');
    $input['stok']        = trim($_POST['stok'] ?? '');
    $input['deskripsi']   = trim($_POST['deskripsi'] ?? '');

    if ($input['nama_produk'] === '') $errors[] = 'Nama produk wajib diisi.';
    if ($input['kategori'] === '')    $errors[] = 'Kategori wajib diisi.';
    if (!is_numeric($input['harga']) || $input['harga'] < 0) $errors[] = 'Harga harus berupa angka positif.';
    if (!ctype_digit((string)$input['stok']) || $input['stok'] < 0) $errors[] = 'Stok harus berupa angka bulat positif.';

    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE produk SET nama_produk=?, kategori=?, harga=?, stok=?, deskripsi=? WHERE id=?");
        try {
            $stmt->execute([
                $input['nama_produk'],
                $input['kategori'],
                (float)$input['harga'],
                (int)$input['stok'],
                $input['deskripsi'],
                $id,
            ]);
            $_SESSION['pesan'] = ['tipe' => 'success', 'teks' => 'Produk berhasil diperbarui!'];
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            $errors[] = 'Gagal memperbarui data: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-warning shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand text-dark" href="index.php"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
        <span class="text-dark fw-semibold">Edit Produk</span>
    </div>
</nav>

<div class="container" style="max-width:640px">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark py-3">
            <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Produk — ID #<?= $id ?></h5>
        </div>
        <div class="card-body">

            <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <strong><i class="bi bi-exclamation-triangle me-1"></i> Gagal memperbarui:</strong>
                <ul class="mb-0 mt-1">
                    <?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <form method="POST" action="edit.php?id=<?= $id ?>" novalidate>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" name="nama_produk" class="form-control"
                           value="<?= htmlspecialchars($input['nama_produk']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="kategori" class="form-control"
                           value="<?= htmlspecialchars($input['kategori']) ?>" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="harga" class="form-control" min="0" step="0.01"
                               value="<?= htmlspecialchars($input['harga']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                        <input type="number" name="stok" class="form-control" min="0"
                               value="<?= htmlspecialchars($input['stok']) ?>" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($input['deskripsi']) ?></textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save me-1"></i> Perbarui Produk
                    </button>
                    <a href="index.php" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>