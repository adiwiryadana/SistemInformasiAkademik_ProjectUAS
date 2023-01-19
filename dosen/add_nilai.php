<?php
 // koneksi ke database
 include('../admin/user panel/class_getNim.php');
 include "../koneksi.php";

 //Fungsi untuk mencegah inputan karakter yang tidak sesuai
 function input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
 }

 // fungsi untuk mengecek apakah ada kiriman form dari method post
 if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nim=input($_POST["nim"]);
    $kode_mk=input($_POST["kode_mk"]);
    $kuis=input($_POST["kuis"]);
    $tugas=input($_POST["tugas"]);
    $uts=input($_POST["uts"]);
    $uas=input($_POST["uas"]);
     

     //Query input data kedalam tabel anggota pada database
     $sql="insert into nilai (nim,kode_mk,kuis,tugas,uts,uas) values
     ('$nim','$kode_mk','$kuis','$tugas','$uts','$uas')";

     //Mengeksekusi query diatas
     $db = new koneksi();
    $koneksi = $db->getKoneksi();
     $hasil=mysqli_query($koneksi,$sql);

    //  pengecekan apakah query berhasil dilakukan atau tidak
     if ($hasil) {
        // echo '<script language="javascript">';
        // echo 'alert("nilai berhasil ditambahkan!")';
        // echo '</script>';
        header("Location:dosen.php");
    }
    else {
        // echo '<script language="javascript">';
        // echo 'alert("nilai Gagal Ditambahkan!")';
        // echo '</script>';
        header("Location:dosen.php");
    }

 }

?>