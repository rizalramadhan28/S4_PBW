<?php
// Konstanta pajak
define("PAJAK", 0.1);

// Array harga barang
$barang = [
    "Buku" => 10000,
    "Pulpen" => 5000,
    "Penghapus" => 3000
];

// Proses jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaBarang = $_POST["barang"];
    $jumlah = $_POST["jumlah"];

    $harga = $barang[$namaBarang];
    $total = $harga * $jumlah;
    $pajak = $total * PAJAK;
    $totalBayar = $total + $pajak;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Toko Sederhana</title>
</head>
<body>

<h2>Program Toko</h2>

<form method="post">
    Pilih Barang:
    <select name="barang">
        <option value="Buku">Buku</option>
        <option value="Pulpen">Pulpen</option>
        <option value="Penghapus">Penghapus</option>
    </select>
    <br><br>

    Jumlah:
    <input type="number" name="jumlah" min="1" required>
    <br><br>

    <input type="submit" value="Hitung">
</form>

<hr>

<?php
if (isset($totalBayar)) {
    echo "Barang: " . $namaBarang . "<br>";
    echo "Harga Satuan: Rp " . number_format($harga) . "<br>";
    echo "Jumlah: " . $jumlah . "<br>";
    echo "Total: Rp " . number_format($total) . "<br>";
    echo "Pajak (10%): Rp " . number_format($pajak) . "<br>";
    echo "<b>Total Bayar: Rp " . number_format($totalBayar) . "</b>";
}
?>

</body>
</html>