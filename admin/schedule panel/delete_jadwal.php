<?php
include('../../koneksi.php');

$db = new koneksi();
$koneksi = $db->getKoneksi();

if(isset($_GET['kode_mk'])){
    $kode_mk = $_GET['kode_mk'];
}

if(isset($_GET['kode_kelas'])){
    $kode_kelas = $_GET['kode_kelas'];
}

$hasil = mysqli_query($koneksi, "DELETE FROM jadwal WHERE kode_mk='$kode_mk'");
if($hasil){
    
header("location: jadwal.php?kode_kelas=$kode_kelas");
}
?>