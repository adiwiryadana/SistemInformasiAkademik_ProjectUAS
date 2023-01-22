<?php
    // koneksi ke database

    include "../../koneksi.php"; //menyisipkan file koneksi.php ke dalam file add_user.php

    // OOP 
    class add_user{ //membuat dan mendeklarasikan class add_user yang dimana didalamnya terdapat properti dan juga method
        public $nama; //membuat properti $nama yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
        public $nim; //membuat properti $nim yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
        public $username; //membuat properti $username yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
        public $password; //membuat properti $password yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
        public $kode_kelas; //membuat properti $kode_kelas yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
        public $level; //membuat properti $level yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
        public $sql_TbUser; //membuat properti $sql_TbUser yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
        public $sql_TbMhs; //membuat properti $sql_TbMhs yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
        public $sql_TbDosen; //membuat properti $TbDosen yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
        public $prodi; //membuat properti $prodi yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)

        //membuat method __construct() yang dinyatakan sebagai public
        public function __construct(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->nama = ($_POST["nama"]);
                $this->nim = ($_POST["nim"]);
                $this->kode_kelas = ($_POST["kode_kelas"]);
                $this->username = ($_POST["username"]);
                $this->password = ($_POST["password"]);
                $this->level = ($_POST["level"]);
                $this->prodi = ($_POST["prodi"]);
            }   
        }

        //membuat method inputSql() yang dinyatakan sebagai public
        public function inputSql() {
            $this->sql_TbUser = $sql_user = "insert into user (username,password,level,nama,nim) values
            ('$this->username','$this->password','$this->level','$this->nama','$this->nim')";
            
            $this->sql_TbDosen = $sql_dosen = "insert into dosen (nama,nim,gender) values
            ('$this->nama','$this->nim', $this->gender)";

            $this->sql_TbMhs = $sql_mhs = "insert into mahasiswa (nama,nim,kode_kelas,gender,prodi) values
            ('$this->nama','$this->nim','$this->kode_kelas', $this->gender, '$this->prodi')";

            $db = new koneksi();
            $koneksi = $db->getKoneksi();

            $hasil = mysqli_query($koneksi, $sql_user);
            
            //pengecekan apakah query berhasil dilakukan atau tidak
            //perintah jika user (dosen) berhasil ditambahkan
            if ($hasil && $this->level == "Dosen") {
                mysqli_query($koneksi, $sql_dosen);
                echo '<script language="javascript">';
                echo 'alert("User berhasil ditambahkan!")';
                echo '</script>';
                header("Location: ../admin.php");

            }
            
            //query user (mahasiswa) 
            else if ($hasil && $this->level == "Mahasiswa") {
                mysqli_query($koneksi, $sql_mhs);
                echo '<script language="javascript">';
                echo 'alert("User berhasil ditambahkan!")';
                echo '</script>';
                header("Location: ../admin.php");
            }  
            //query user (admin)
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

    //membuat objek dari class add_user
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

 
