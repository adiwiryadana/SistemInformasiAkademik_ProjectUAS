<?php
// koneksi ke database
include "../koneksi.php";
include('../admin/user panel/class_getNim.php');



//Cek apakah ada kiriman form dari method post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nim=htmlspecialchars($_POST["nim"]);
    $gender = ($_POST["gender"]);
    $phone = ($_POST["phone"]);
    $email = ($_POST["email"]);
    $alamat = ($_POST["alamat"]);
    
    
    //Query update data pada tabel anggota
    $sql = "UPDATE dosen SET 
    gender='$gender', phone='$phone', email='$email', alamat='$alamat' WHERE nim='$Nim'";


    // mengeksekusi query diatas 
    $db = new koneksi();
    $koneksi = $db->getKoneksi();
    //pengecekan apakah query berhasil dilakukan atau tidak
    $hasil =  mysqli_query($koneksi, $sql);

        if($hasil) {
            header("Location:dosen.php");
        } else {
            echo '<script language="javascript">';
            echo 'alert("Gagal Melakukan Update!")';
            echo '</script>';
            header("Location:dosen.php");
        }

}



?>
