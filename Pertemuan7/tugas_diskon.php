<!DOCTYPE html>
<html lang="id">
<head>
    <title>Diskon UKT</title>
</head>
<body>

<h2>Form Pembayaran UKT</h2>

<form method="post">
    NPM: <input type="text" name="npm"><br><br>
    Nama: <input type="text" name="nama"><br><br>
    Prodi: <input type="text" name="prodi"><br><br>
    Semester: <input type="number" name="semester"><br><br>
    Biaya UKT: <input type="number" name="ukt"><br><br>
    <input type="submit" value="Hitung">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $semester = $_POST['semester'];
    $ukt = $_POST['ukt'];

    // logika diskon
    if ($ukt >= 5000000 && $semester > 8) {
        $diskon = 0.15;
    } elseif ($ukt >= 5000000) {
        $diskon = 0.10;
    } else {
        $diskon = 0;
    }

    $potongan = $ukt * $diskon;
    $bayar = $ukt - $potongan;

    echo "<h3>Hasil:</h3>";
    echo "NPM : $npm <br>";
    echo "Nama : $nama <br>";
    echo "Prodi : $prodi <br>";
    echo "Semester : $semester <br>";
    echo "Biaya UKT : Rp. " . number_format($ukt,0,",",".") . "<br>";
    echo "Diskon : " . ($diskon*100) . "% <br>";
    echo "Yang harus dibayar : Rp. " . number_format($bayar,0,",",".");
}
?>

</body>
</html>