<?php
include('../../koneksi.php');

class addClass {
    public $kode_kelas;
    public $kapasitas;
    public $query;

    public function __construct(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->kode_kelas = ($_POST["kode_kelas"]);
            $this->kapasitas = ($_POST["kapasitas"]);
        }
    }

    public function add(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();
        $this->query = $hasil= mysqli_query($koneksi, "INSERT INTO kelas (kode_kelas,kapasitas) VALUES ('$this->kode_kelas', '$this->kapasitas')");

        if($hasil){
            header("Location:../admin.php");
        } 

    }
}

$addObj = new addClass();
$hasil = $addObj->add();
?>