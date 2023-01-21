<?php
// koneksi ke database
include('../../koneksi.php');
$db = new koneksi();
$koneksi = $db->getKoneksi();

//Cek apakah ada kiriman form dari method post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_kelas = ($_POST["kode_kelas"]);
    $kode_mk = ($_POST["kode_mk"]);
    $ruang = ($_POST["ruang"]);
    $hari = ($_POST["hari"]);
    $waktu = ($_POST["waktu"]);
}

//query update pada tabel jadwal untuk mengupdate data jadwal pada database
$query = "UPDATE jadwal SET ruang='$ruang', hari='$hari', waktu='$waktu' WHERE kode_kelas='$kode_kelas' AND kode_mk = '$kode_mk'";
$hasil = mysqli_query($koneksi, $query);

//mengecek hasil query apakah berjalan atau tidak
if($hasil) {
    header("location: jadwal.php?kode_kelas=$kode_kelas");
} 
?>
