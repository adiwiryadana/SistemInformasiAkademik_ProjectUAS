<?php
// koneksi ke database
include('../../koneksi.php');
$db = new koneksi();
$koneksi = $db->getKoneksi();
//Code ini digunakan untuk menangkap nilai dari parameter 'kode_mk' yang diterima melalui metode GET dari sebuah permintaan HTTP. Jika parameter 'kode_mk' diterima, maka nilainya akan disimpan dalam variabel $kode_mk. Jika tidak diterima, maka variabel $kode_mk akan tidak diinisialisasi atau kosong.
if(isset($_GET['kode_mk'])){
    $kode_mk = $_GET['kode_mk'];
}
//Code ini digunakan untuk menangkap nilai dari parameter 'kode_kelas' yang diterima melalui metode GET dari sebuah permintaan HTTP. Jika parameter 'kode_kelas' diterima, maka nilainya akan disimpan dalam variabel $kode_kelas. Jika tidak diterima, maka variabel $kode_kelas akan tidak diinisialisasi atau kosong. 
if(isset($_GET['kode_kelas'])){
    $kode_kelas = $_GET['kode_kelas'];
}
//query delete untuk menghapus data dari tabel jadwal pada database
$hasil = mysqli_query($koneksi, "DELETE FROM jadwal WHERE kode_mk='$kode_mk'");
if($hasil){
    
header("location: jadwal.php?kode_kelas=$kode_kelas");
}
?>
