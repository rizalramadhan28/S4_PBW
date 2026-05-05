<?php
require_once 'koneksi.php';
require_once 'auth.php';

$id      = (int)($_GET['id'] ?? 0);
$cari    = $_GET['cari'] ?? '';
$halaman = (int)($_GET['halaman'] ?? 1);

if ($id > 0) {
    try {
        $cek = $pdo->prepare("SELECT id FROM produk WHERE id = ?");
        $cek->execute([$id]);

        if ($cek->fetch()) {
            $stmt = $pdo->prepare("DELETE FROM produk WHERE id = ?");
            $stmt->execute([$id]);
            $_SESSION['pesan'] = ['tipe' => 'success', 'teks' => 'Produk berhasil dihapus!'];
        } else {
            $_SESSION['pesan'] = ['tipe' => 'warning', 'teks' => 'Produk tidak ditemukan.'];
        }
    } catch (PDOException $e) {
        $_SESSION['pesan'] = ['tipe' => 'danger', 'teks' => 'Gagal menghapus: ' . $e->getMessage()];
    }
} else {
    $_SESSION['pesan'] = ['tipe' => 'danger', 'teks' => 'ID produk tidak valid!'];
}

$redirect = 'index.php?halaman=' . $halaman;
if ($cari !== '') $redirect .= '&cari=' . urlencode($cari);
header('Location: ' . $redirect);
exit;