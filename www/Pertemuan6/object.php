<?php
class Mahasiswa {
    public $nama;

    public function sapa() {
        return "Halo, saya " . $this->nama;
    }
}

$mhs = new Mahasiswa();
$mhs->nama = "Jeni";

echo $mhs->sapa();
?>