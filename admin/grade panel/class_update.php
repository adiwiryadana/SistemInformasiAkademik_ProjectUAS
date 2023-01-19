<?php
include('../../koneksi.php');
include('../../cekadmin.php');
$db = new koneksi();
$koneksi = $db->getKoneksi();

class updateNilai {
    public $kode_mk;
    public $nim;
    public $uas;
    public $uts;
    public $tugas;
    public $kuis;
    public $query;

    public function __construct(){  
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->nim= ($_POST["nim"]);
            $this->kode_mk= ($_POST["kode_mk"]);
            $this->uas= ($_POST["uas"]);
            $this->uts= ($_POST["uts"]);
            $this->tugas= ($_POST["tugas"]);
            $this->kuis= ($_POST["kuis"]);
        }
    }

    public function update(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        $this->query = mysqli_query($koneksi, "UPDATE nilai SET uas='$this->uas', uts='$this->uts', 
        tugas='$this->tugas', kuis='$this->kuis' WHERE kode_mk='$this->kode_mk' AND nim='$this->nim'");

        if($this->query){
            header("Location: class_nilai.php?nim=$this->nim");
        } 
    }
}

$obj = new updateNilai();
$hasil = $obj->update();
?>