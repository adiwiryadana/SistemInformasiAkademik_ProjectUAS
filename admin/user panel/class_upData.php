<?php 

//koneksi ke database
include('../../koneksi.php'); //menyisipkan file koneksi.php kedalam file class_upData.php

class update { //membuat dan mendeklarasikan class update yang dimana terdapat properti dan juga method
    
    public $Nim; //membuat properti $Nim yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $tempat_lahir; //membuat properti $tempat_lahir yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $tanggal_lahir; //membuat properti $tanggal_lahir yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $gender; //membuat properti $gender yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $phone; //membuat properti $phone yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $email; //membuat properti $email yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $ayah; //membuat properti $ayah yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $ibu; //membuat properti $ibu yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $prodi; //membuat properti $prodi yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $alamat; //membuat properti $alamat yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $kode_kelas; //membuat properti $kode_kelas yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $username; //membuat properti $username yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $password; //membuat properti $password yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)

    //membuat method __construct()
    function __construct()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->Nim=htmlspecialchars($_POST["nim"]);
            $this->tempat_lahir = ($_POST["tempat_lahir"]);
            $this->username = ($_POST["username"]);
            $this->password = ($_POST["password"]);
            $this->kode_kelas = ($_POST["kode_kelas"]);
            $this->tanggal_lahir = ($_POST["tanggal_lahir"]);
            $this->gender = ($_POST["gender"]);
            $this->phone = ($_POST["phone"]);
            $this->email = ($_POST["email"]);
            $this->ayah = ($_POST["ayah"]);
            $this->ibu = ($_POST["ibu"]);
            $this->prodi = ($_POST["prodi"]);
            $this->alamat = ($_POST["alamat"]);
        }
    }

    //membuat method UpdateMhs()
    function UpdateMhs() {
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        // QUERY UNTUK MENGECEK LEVEL NIM PADA TABEL USER
        $sqlUsr = "SELECT * FROM user WHERE nim='$this->Nim'";
        $cekUsr = mysqli_query($koneksi, $sqlUsr);
        $data = mysqli_fetch_array($cekUsr);

        if($data['level'] == "Mahasiswa") {
            $sql = "UPDATE mahasiswa SET kode_kelas = '$this->kode_kelas',tempat_lahir='$this->tempat_lahir', tanggal_lahir='$this->tanggal_lahir',
            gender='$this->gender', phone='$this->phone', email='$this->email', ayah='$this->ayah',
            ibu='$this->ibu', prodi='$this->prodi', alamat='$this->alamat' WHERE nim='$this->Nim'";

            $hasil =  mysqli_query($koneksi, $sql);

            if($hasil) {
                $sqlusr = "UPDATE user SET username = '$this->username', password = '$this->password' WHERE nim='$this->Nim'";
                $hasil =  mysqli_query($koneksi, $sqlusr);
                header("Location:users_list.php");
            } else {
            echo '<script language="javascript">';
            echo 'alert("Gagal Melakukan Update!")';
            echo '</script>';
            header("Location:users_list.php");
            }
        } else if($data['level'] == "Dosen") {
            $sql = "UPDATE dosen SET gender='$this->gender', phone='$this->phone', email='$this->email',
            alamat='$this->alamat' WHERE nim='$this->Nim'";

            $hasil =  mysqli_query($koneksi, $sql);

            if($hasil) {
                $sqlusr = "UPDATE user SET username = '$this->username', password = '$this->password' WHERE nim='$this->Nim'";
                $hasil =  mysqli_query($koneksi, $sqlusr);
                header("Location:users_list.php");
            } else {
            echo '<script language="javascript">';
            echo 'alert("Gagal Melakukan Update!")';
            echo '</script>';
            header("Location:users_list.php");
            }
        }
        
    }

}

//membuat objek dari class update
$update = new update();
$postUpdate = $update->UpdateMhs();

// Procedural 
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $Nim=htmlspecialchars($_POST["nim"]);
//     $tempat_lahir = ($_POST["tempat_lahir"]);
//     $tanggal_lahir = ($_POST["tanggal_lahir"]);
//     $gender = ($_POST["gender"]);
//     $phone = ($_POST["phone"]);
//     $email = ($_POST["email"]);
//     $ayah = ($_POST["ayah"]);
//     $ibu = ($_POST["ibu"]);
//     $prodi = ($_POST["prodi"]);
//     $alamat = ($_POST["alamat"]);

//     $db = new koneksi();
//     $koneksi = $db->getKoneksi();

//     $sql = "UPDATE mahasiswa SET tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir',
//         gender='$gender', phone='$phone', email='$email', ayah='$ayah',
//         ibu='$ibu', prodi='$prodi', alamat='$alamat' WHERE nim='$Nim'";

//         $hasil =  mysqli_query($koneksi, $sql);

//         if($hasil) {
//             header("Location:users_list.php");
//         } else {
//             echo '<script language="javascript">';
//             echo 'alert("Gagal Melakukan Update!")';
//             echo '</script>';
//             header("Location:users_list.php");
//         }
// }

?>
