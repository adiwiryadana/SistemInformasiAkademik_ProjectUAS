<?php
include('../../koneksi.php');

class addMatakuliah {
    public $kode_mk;
    public $nama_mk;
    public $sks;
    public $nim;
    public $query;

    public function __construct(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->kode_mk = ($_POST["kode_mk"]);
            $this->nama_mk= ($_POST["nama_mk"]);
            $this->sks= ($_POST["sks"]);
            $this->nim= ($_POST["nim"]);
        }
    }

    public function add(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        $this->query = $hasil= mysqli_query($koneksi, "INSERT INTO matakuliah (kode_mk, nama_mk, sks, nim) VALUES ('$this->kode_mk', '$this->nama_mk', '$this->sks', '$this->nim')");

        if($hasil){
            header("Location:../admin.php");
        } 

    }
}

$delObj = new addMatakuliah();
$hasil = $delObj->add();
?>