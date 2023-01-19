<?php
include('../../koneksi.php');

$db = new koneksi();
$koneksi = $db->getKoneksi();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_kelas = ($_POST["kode_kelas"]);
    $kode_mk = ($_POST["kode_mk"]);
    $ruang = ($_POST["ruang"]);
    $hari = ($_POST["hari"]);
    $waktu = ($_POST["waktu"]);
}

$query = "UPDATE jadwal SET ruang='$ruang', hari='$hari', waktu='$waktu' WHERE kode_kelas='$kode_kelas' AND kode_mk = '$kode_mk'";
$hasil = mysqli_query($koneksi, $query);

if($hasil) {
    header("location: jadwal.php?kode_kelas=$kode_kelas");
} 
?>