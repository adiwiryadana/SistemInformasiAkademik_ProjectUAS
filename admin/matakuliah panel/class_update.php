<?php
include('../../cekadmin.php');
include('../../koneksi.php');
$db = new koneksi();
$koneksi = $db->getKoneksi();

class updateMk {
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

    public function update(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        $this->query = $hasil= mysqli_query($koneksi, "UPDATE matakuliah SET nama_mk='$this->nama_mk', sks='$this->sks', nim='$this->nim' WHERE kode_mk='$this->kode_mk'");

        if($hasil){
            header("Location: matakuliah_list.php");
        } 
    }
}

$obj = new updateMk();
$hasil = $obj->update();
?>