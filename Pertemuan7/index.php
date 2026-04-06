<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['nama'])) {
        $nama = htmlspecialchars($_POST['nama']);
        $umur = (int)$_POST['umur'];
        $punyaKtp = (bool)$_POST['ktp'];

        echo "<h3>Hasil Validasi untuk: $nama</h3>";

        if ($umur >= 17 && $punyaKtp) {
            echo "<p style='color: green;'>Status: <strong>Boleh memilih</strong></p>";
        } else {
            echo "<p style='color: red;'>Status: <strong>Tidak boleh memilih</strong></p>";
            echo "<em>Syarat: Minimal usia 17 tahun dan sudah memiliki KTP.</em>";
        }
    } else {
        echo "Nama tidak boleh kosong!";
    }
}
?>