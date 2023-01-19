<?php
// koneksi ke database
include "../koneksi.php";
include('../admin/user panel/class_getNim.php');



//Cek apakah ada kiriman form dari method post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nim=htmlspecialchars($_POST["nim"]);
    $kuis = ($_POST["kuis"]);
    $kode_mk = ($_POST["kode_mk"]);
    $tugas = ($_POST["tugas"]);
    $uts = ($_POST["uts"]);
    $uas = ($_POST["uas"]);
    
    
    //Query update data pada tabel anggota
    $sql = "UPDATE nilai SET 
    kuis='$kuis', tugas='$tugas', uts='$uts', uas='$uas' WHERE nim='$Nim'";


    // mengeksekusi query diatas 
    $db = new koneksi();
    $koneksi = $db->getKoneksi();
    //pengecekan apakah query berhasil dilakukan atau tidak
    $hasil =  mysqli_query($koneksi, $sql);

        if($hasil) {
            header("Location: detail_nilai.php?kode_mk=$kode_mk");
        } else {
            echo '<script language="javascript">';
            echo 'alert("Gagal Melakukan Update!")';
            echo '</script>';
            header("Location: detail_nilai.php?kode_mk=$kode_mk");
        }

}
?>