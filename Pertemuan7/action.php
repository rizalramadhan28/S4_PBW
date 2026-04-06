<!DOCTYPE html>
<html lang="id">
<head>
    <title>Praktikum 7</title>
</head>
<body>
    <h2>Form Cek Syarat Memilih</h2>
    <form action="index.php" method="POST">
        <label>Nama:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Umur:</label><br>
        <input type="number" name="umur" required><br><br>

        <label>Apakah sudah memiliki KTP?</label><br>
        <select name="ktp">
            <option value="1">Sudah</option>
            <option value="0">Belum</option>
        </select><br><br>

        <button type="submit">Cek Status</button>
    </form>
</body>
</html>