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

$query = "INSERT INTO jadwal (kode_mk,kode_kelas,ruang,hari,waktu) VALUES ('$kode_mk', '$kode_kelas', '$ruang', '$hari', '$waktu')";
$hasil = mysqli_query($koneksi, $query);

if($hasil) {
    header("Location: jadwal.php?kode_kelas=$kode_kelas");
} else {
echo '<script language="javascript">';
echo 'alert("Gagal Membuat Jadwal!")';
echo '</script>';
header("Location: jadwal.php?kode_kelas=$kode_kelas");
}
?>