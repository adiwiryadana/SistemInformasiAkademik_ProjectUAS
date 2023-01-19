<?php
include('../../koneksi.php');

class addNilai {
    public $nim;
    public $kode_mk;
    public $uas;
    public $uts;
    public $kuis;
    public $tugas;
    public $query;
    public $hasil;


    public function  __construct(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->nim = ($_POST["nim"]);
            $this->kode_mk = ($_POST["kode_mk"]);
            $this->uas = ($_POST["uas"]);
            $this->uts = ($_POST["uts"]);
            $this->kuis = ($_POST["kuis"]);
            $this->tugas = ($_POST["tugas"]);
        }
    }

    public function add(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        $this->query = "INSERT INTO nilai (nim,kode_mk,uas,uts,tugas,kuis) VALUES ('$this->nim', '$this->kode_mk', $this->uas, $this->uts, $this->kuis, $this->tugas)";
        $this->hasil = mysqli_query($koneksi, $this->query);
        if($this->hasil){
            header("Location: class_nilai.php?nim=$this->nim");
        }
    }
}

$addObj = new addNilai();
$add = $addObj->add();

?>