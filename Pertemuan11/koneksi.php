<?php

$host     = 'localhost';
$dbname   = 'toko_produk';
$username = 'root';
$password = '';          // Sesuaikan dengan password MySQL Anda

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die('<div class="alert alert-danger m-4"><strong>Koneksi Gagal!</strong> ' . htmlspecialchars($e->getMessage()) . '</div>');
}