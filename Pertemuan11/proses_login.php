<?php
session_start();

// Kredensial hardcoded (bisa diganti dengan query database)
$valid_username = 'admin';
$valid_password = 'admin123';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === $valid_username && $password === $valid_password) {
        // Login berhasil — simpan sesi
        $_SESSION['login_Un51k4'] = true;
        $_SESSION['username']     = $username;
        header('Location: index.php');
        exit;
    } else {
        // Login gagal — redirect ke login dengan pesan
        header('Location: login.php?message=Username+atau+password+salah!');
        exit;
    }
} else {
    header('Location: login.php');
    exit;
}