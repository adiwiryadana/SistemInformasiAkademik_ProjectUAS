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


// // include untuk koneksi ke database
// include "koneksi.php";

// //  Fungsi untuk mencegah inputan karakter yang tidak sesuai
//  function input($data) {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }

// // cek nilai dari method get 
// if (isset($_GET['nim'])) {
//     $nim=input($_GET["nim"]);
//     $sql="select * from dosen where nim=$nim";
//     $hasil=mysqli_query($koneksi,$sql);
//     $data = mysqli_fetch_assoc($hasil);
// }

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $nim=input($_POST["nim"]);
//     $nama=input($_POST["nama"]);
//     $no_hp=input($_POST["no_hp"]);
//     $alamat=input($_POST["alamat"]);


//      // Query update data pada tabel anggota
    //  $sql="update dosen set
    //  nama='$nama',
    //  no_hp='$no_hp',
    //  alamat='$alamat'
    //  where nim=$nim";

//       //Mengeksekusi query diatas
//     $hasil=mysqli_query($koneksi,$sql);

// }
?>