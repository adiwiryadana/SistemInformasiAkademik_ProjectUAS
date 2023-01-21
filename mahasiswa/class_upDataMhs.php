<?php 
//menyertakan file koneksi.php dan class_getNim.php
include('../koneksi.php');
include('../admin/user panel/class_getNim.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nim=htmlspecialchars($_POST["nim"]);
    $tempat_lahir = ($_POST["tempat_lahir"]);
    $tanggal_lahir = ($_POST["tanggal_lahir"]);
    $gender = ($_POST["gender"]);
    $phone = ($_POST["phone"]);
    $email = ($_POST["email"]);
    $ayah = ($_POST["ayah"]);
    $ibu = ($_POST["ibu"]);
    $prodi = ($_POST["prodi"]);
    $alamat = ($_POST["alamat"]);

    $db = new koneksi();
    $koneksi = $db->getKoneksi();
    //query untuk melakukan update pada data mahasiswa
    $sql = "UPDATE mahasiswa SET tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir',
        gender='$gender', phone='$phone', email='$email', ayah='$ayah',
        ibu='$ibu', prodi='$prodi', alamat='$alamat' WHERE nim='$Nim'";

        $hasil =  mysqli_query($koneksi, $sql);

        if($hasil) {
            header("Location:mahasiswa.php"); //jika berhasil, maka akan kembali ke halaman mahasiswa.php
        } else {
            echo '<script language="javascript">';
            echo 'alert("Gagal Melakukan Update!")';
            echo '</script>';
            header("Location:mahasiswa.php");
        }
}

?>
