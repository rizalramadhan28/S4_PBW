<!DOCTYPE html>
<html lang="id">
<head>
    <title>Latihan Nilai</title>
</head>
<body>

<h2>Input Nilai Mahasiswa</h2>

<form method="post" action="">
    Nama: <input type="text" name="nama"><br><br>
    Nilai: <input type="number" name="nilai"><br><br>
    <input type="submit" value="Proses">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nilai = $_POST['nilai'];

    echo "<h3>Hasil:</h3>";
    echo "Nama : $nama <br>";
    echo "Nilai : $nilai <br>";

    // menentukan predikat
    if ($nilai >= 85) {
        $predikat = "A";
    } elseif ($nilai >= 75) {
        $predikat = "B";
    } elseif ($nilai >= 65) {
        $predikat = "C";
    } elseif ($nilai >= 50) {
        $predikat = "D";
    } else {
        $predikat = "E";
    }

    // menentukan status
    if ($nilai >= 65) {
        $status = "Lulus";
    } else {
        $status = "Tidak Lulus";
    }

    echo "Predikat : $predikat <br>";
    echo "Status : $status";
}
?>

</body>
</html>