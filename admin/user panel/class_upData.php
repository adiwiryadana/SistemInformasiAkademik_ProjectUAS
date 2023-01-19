<?php 
include('../../koneksi.php');

class update {

    public $Nim;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $gender;
    public $phone;
    public $email;
    public $ayah;
    public $ibu;
    public $prodi;
    public $alamat;
    public $kode_kelas;
    public $username;
    public $password;

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