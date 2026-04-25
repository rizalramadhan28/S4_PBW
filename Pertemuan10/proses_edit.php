<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun_terbit'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $query = "UPDATE buku SET 
                Judul = '$judul', 
                Penulis = '$penulis', 
                Tahun_Terbit = '$tahun', 
                Harga = '$harga', 
                stok = '$stok' 
              WHERE ID = $id";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diubah!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>