<?php
require_once 'koneksi.php';

// Pesan sesi
session_start();
$pesan = $_SESSION['pesan'] ?? null;
unset($_SESSION['pesan']);

// ---- Parameter pencarian & pagination ----
$cari      = trim($_GET['cari'] ?? '');
$halaman   = max(1, (int)($_GET['halaman'] ?? 1));
$per_halaman = 5;
$offset    = ($halaman - 1) * $per_halaman;

// ---- Hitung total baris ----
if ($cari !== '') {
    $stmtTotal = $pdo->prepare("SELECT COUNT(*) FROM produk WHERE nama_produk LIKE ? OR kategori LIKE ? OR deskripsi LIKE ?");
    $like = "%$cari%";
    $stmtTotal->execute([$like, $like, $like]);
} else {
    $stmtTotal = $pdo->query("SELECT COUNT(*) FROM produk");
}
$total_baris  = (int)$stmtTotal->fetchColumn();
$total_halaman = (int)ceil($total_baris / $per_halaman);

// ---- Ambil data ----
if ($cari !== '') {
    $stmt = $pdo->prepare("SELECT * FROM produk WHERE nama_produk LIKE ? OR kategori LIKE ? OR deskripsi LIKE ? ORDER BY id DESC LIMIT ? OFFSET ?");
    $like = "%$cari%";
    $stmt->execute([$like, $like, $like, $per_halaman, $offset]);
} else {
    $stmt = $pdo->prepare("SELECT * FROM produk ORDER BY id DESC LIMIT ? OFFSET ?");
    $stmt->execute([$per_halaman, $offset]);
}
$produk_list = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background: #f0f4f8; }
        .navbar-brand { font-weight: 700; letter-spacing: 1px; }
        .card-header { background: #0d6efd; color: #fff; }
        .table-hover tbody tr:hover { background: #e8f0fe; }
        .badge-kategori { font-size: .75rem; }
        .search-bar { max-width: 340px; }
        .harga { font-family: 'Courier New', monospace; font-weight: 600; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-primary shadow-sm mb-4">
    <div class="container">
        <span class="navbar-brand"><i class="bi bi-box-seam me-2"></i>Toko Produk</span>
        <span class="text-white-50 small">Tugas Pertemuan 10</span>
    </div>
</nav>

<div class="container pb-5">

    <!-- Alert pesan -->
    <?php if ($pesan): ?>
    <div class="alert alert-<?= $pesan['tipe'] ?> alert-dismissible fade show" role="alert">
        <i class="bi bi-<?= $pesan['tipe'] === 'success' ? 'check-circle' : 'x-circle' ?> me-2"></i>
        <?= htmlspecialchars($pesan['teks']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-header d-flex align-items-center justify-content-between py-3">
            <h5 class="mb-0"><i class="bi bi-table me-2"></i>Daftar Produk</h5>
            <a href="tambah.php" class="btn btn-light btn-sm fw-semibold">
                <i class="bi bi-plus-circle me-1"></i> Tambah Produk
            </a>
        </div>
        <div class="card-body">

            <!-- Form Pencarian -->
            <form method="GET" action="index.php" class="mb-3 d-flex gap-2">
                <input type="text" name="cari" class="form-control search-bar"
                       placeholder="Cari produk, kategori..." value="<?= htmlspecialchars($cari) ?>">
                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
                <?php if ($cari): ?>
                <a href="index.php" class="btn btn-outline-secondary"><i class="bi bi-x-lg"></i> Reset</a>
                <?php endif; ?>
            </form>

            <?php if ($cari): ?>
            <p class="text-muted small">Menampilkan <strong><?= $total_baris ?></strong> hasil untuk "<strong><?= htmlspecialchars($cari) ?></strong>"</p>
            <?php endif; ?>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width:50px">#</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Deskripsi</th>
                            <th style="width:140px" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($produk_list)): ?>
                        <tr><td colspan="7" class="text-center text-muted py-4"><i class="bi bi-inbox fs-3 d-block mb-2"></i>Tidak ada data produk.</td></tr>
                    <?php else: ?>
                        <?php foreach ($produk_list as $i => $p): ?>
                        <tr>
                            <td class="text-muted"><?= $offset + $i + 1 ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars($p['nama_produk']) ?></td>
                            <td><span class="badge bg-info text-dark badge-kategori"><?= htmlspecialchars($p['kategori']) ?></span></td>
                            <td class="harga">Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                            <td>
                                <span class="badge <?= $p['stok'] <= 5 ? 'bg-danger' : 'bg-success' ?>">
                                    <?= $p['stok'] ?> pcs
                                </span>
                            </td>
                            <td class="text-muted small"><?= htmlspecialchars(mb_strimwidth($p['deskripsi'], 0, 60, '…')) ?></td>
                            <td class="text-center">
                                <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="hapus.php?id=<?= $p['id'] ?>&cari=<?= urlencode($cari) ?>&halaman=<?= $halaman ?>"
                                   class="btn btn-danger btn-sm" title="Hapus"
                                   onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    <i class="bi bi-trash3"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if ($total_halaman > 1): ?>
            <nav class="d-flex justify-content-between align-items-center mt-3">
                <span class="text-muted small">
                    Halaman <strong><?= $halaman ?></strong> dari <strong><?= $total_halaman ?></strong>
                    &nbsp;(<?= $total_baris ?> data)
                </span>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item <?= $halaman <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?halaman=<?= $halaman-1 ?>&cari=<?= urlencode($cari) ?>">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                    <?php for ($p = 1; $p <= $total_halaman; $p++): ?>
                    <li class="page-item <?= $p === $halaman ? 'active' : '' ?>">
                        <a class="page-link" href="?halaman=<?= $p ?>&cari=<?= urlencode($cari) ?>"><?= $p ?></a>
                    </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $halaman >= $total_halaman ? 'disabled' : '' ?>">
                        <a class="page-link" href="?halaman=<?= $halaman+1 ?>&cari=<?= urlencode($cari) ?>">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <?php endif; ?>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
