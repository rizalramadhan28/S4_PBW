<?php
include 'koneksi.php';
$id = $_GET['id'];
$query = "SELECT * FROM buku WHERE ID = $id";
$result = mysqli_query($conn, $query);
$buku = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
</head>
<body>
    <h2>Edit Data Buku</h2>
    <a href="index.php">Kembali</a>
    <br><br>
    <form action="proses_edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $buku['ID']; ?>">

        <label>Judul Buku:</label><br>
        <input type="text" name="judul" value="<?php echo $buku['Judul']; ?>" required><br><br>

        <label>Penulis:</label><br>
        <input type="text" name="penulis" value="<?php echo $buku['Penulis']; ?>" required><br><br>

        <label>Tahun Terbit:</label><br>
        <input type="number" name="tahun_terbit" value="<?php echo $buku['Tahun_Terbit']; ?>" required><br><br>

        <label>Harga:</label><br>
        <input type="number" step="0.01" name="harga" value="<?php echo $buku['Harga']; ?>" required><br><br>

        <label>Stok:</label><br>
        <input type="number" name="stok" value="<?php echo $buku['Stok']; ?>" required><br><br>

        <button type="submit" name="submit">Update</button>
    </form>
</body>
</html>