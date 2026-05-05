<?php
// auth.php — Sertakan file ini di awal setiap halaman yang membutuhkan login
// Penggunaan: require_once 'auth.php';
 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
 
if (!isset($_SESSION['login_Un51k4'])) {
    header('Location: login.php?message=Silakan+login+terlebih+dahulu.');
    exit;
}