<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "DELETE FROM buku WHERE ID = $id";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>