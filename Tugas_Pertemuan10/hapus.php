<?php
require_once 'koneksi.php';
session_start();

$id      = (int)($_GET['id'] ?? 0);
$cari    = $_GET['cari'] ?? '';
$halaman = (int)($_GET['halaman'] ?? 1);

if ($id > 0) {
    try {
        // Cek dulu apakah data ada
        $cek = $pdo->prepare("SELECT id FROM produk WHERE id = ?");
        $cek->execute([$id]);

        if ($cek->fetch()) {
            // Prepared Statement — DELETE
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

// Redirect kembali ke halaman yang sama
$redirect = 'index.php?halaman=' . $halaman;
if ($cari !== '') $redirect .= '&cari=' . urlencode($cari);
header('Location: ' . $redirect);
exit;
