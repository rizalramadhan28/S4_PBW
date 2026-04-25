<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
</head>
<body>
    <h2>Tambah Data Buku</h2>
    <a href="index.php">Kembali</a>
    <br><br>
    <form action="proses_tambah.php" method="POST">
        <label>Judul Buku:</label><br>
        <input type="text" name="judul" required><br><br>

        <label>Penulis:</label><br>
        <input type="text" name="penulis" required><br><br>

        <label>Tahun Terbit:</label><br>
        <input type="number" name="tahun_terbit" required><br><br>

        <label>Harga:</label><br>
        <input type="number" step="0.01" name="harga" required><br><br>

        <label>Stok:</label><br>
        <input type="number" name="stok" required><br><br>

        <button type="submit" name="submit">Simpan</button>
    </form>
</body>
</html>