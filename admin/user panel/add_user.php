<?php
    // koneksi ke database

    include "../../koneksi.php";

    // OOP 
    class add_user{
        public $nama;
        public $nim;
        public $username;
        public $password;
        public $kode_kelas;
        public $level;
        public $sql_TbUser;
        public $sql_TbMhs;
        public $sql_TbDosen;

        public function __construct(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->nama = ($_POST["nama"]);
                $this->nim = ($_POST["nim"]);
                $this->kode_kelas = ($_POST["kode_kelas"]);
                $this->username = ($_POST["username"]);
                $this->password = ($_POST["password"]);
                $this->level = ($_POST["level"]);
            }   
        }

        public function inputSql() {
            $this->sql_TbUser = $sql_user = "insert into user (username,password,level,nama,nim) values
            ('$this->username','$this->password','$this->level','$this->nama','$this->nim')";
            
            $this->sql_TbDosen = $sql_dosen = "insert into dosen (nama,nim) values
            ('$this->nama','$this->nim')";

            $this->sql_TbMhs = $sql_mhs = "insert into mahasiswa (nama,nim,kode_kelas) values
            ('$this->nama','$this->nim','$this->kode_kelas')";

            $db = new koneksi();
            $koneksi = $db->getKoneksi();

            $hasil = mysqli_query($koneksi, $sql_user);

            if ($hasil && $this->level == "Dosen") {
                mysqli_query($koneksi, $sql_dosen);
                echo '<script language="javascript">';
                echo 'alert("User berhasil ditambahkan!")';
                echo '</script>';
                header("Location: ../admin.php");

            } 
            else if ($hasil && $this->level == "Mahasiswa") {
                mysqli_query($koneksi, $sql_mhs);
                echo '<script language="javascript">';
                echo 'alert("User berhasil ditambahkan!")';
                echo '</script>';
                header("Location: ../admin.php");
            }  
            else if ($hasil && $this->level == "Administrator") {
                echo '<script language="javascript">';
                echo 'alert("User berhasil ditambahkan!")';
                echo '</script>';
                header("Location: ../admin.php");
            }
            else {
                echo '<script language="javascript">';
                echo 'alert("User Gagal Ditambahkan!")';
                echo '</script>';
                header("Location: ../admin.php");
            }
        }
    }

    $addUser = new add_user();
    $query = $addUser->inputSql();

    // Procedural
    // //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    // function input($data) {
    //     $data = trim($data);
    //     $data = stripslashes($data);
    //     $data = htmlspecialchars($data);
    //     return $data;
    // }

    // // fungsi untuk mengecek apakah ada kiriman form dari method post
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //     $nama=input($_POST["nama"]);
    //     $nim=input($_POST["nim"]);
    //     $username=input($_POST["username"]);
    //     $password=input($_POST["password"]);
    //     $level=input($_POST["level"]);
        

    //     //Query input data kedalam tabel anggota pada database
    //     $sql="insert into user (username,password,level,nama,nim) values
    //     ('$username','$password','$level','$nama','$nim')";

    //     //Mengeksekusi query diatas
    //     $hasil=mysqli_query($koneksi,$sql);

    //     //pengecekan apakah query berhasil dilakukan atau tidak
    //     if ($hasil) {
    //         echo '<script language="javascript">';
    //         echo 'alert("User berhasil ditambahkan!")';
    //         echo '</script>';
    //         header("Location:admin.php");
    //     }
    //     else {
    //         echo '<script language="javascript">';
    //         echo 'alert("User Gagal Ditambahkan!")';
    //         echo '</script>';
    //     }

    // }
?>

 