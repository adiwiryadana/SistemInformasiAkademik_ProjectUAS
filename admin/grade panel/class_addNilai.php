<?php

//koneksi ke database
include('../../koneksi.php'); //menyisipkan file koneksi.php ke dalam class_addNilai pada grade panel

class addNilai { //membuat dan mendeklarasikan class addNilai yang dimana didalamnya terdapat properti dan juga method
    
    //membuat properti yang dinyatakan sebagai public
    public $nim;
    public $kode_mk;
    public $uas;
    public $uts;
    public $kuis;
    public $tugas;
    public $query;
    public $hasil;
    public $rata_rata;
    public $nilai_akhir;

    //membuat method function __construct() yang dinyatakan sebagai public
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
    
    //membuat method function add() yang dinyatakan sebagai public
    public function add(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();
        
        $this->rata_rata = ($this->uas + $this->uts + $this->kuis + $this->tugas) / 4;
        
        if ($this->rata_rata >= 88) {
            $this->nilai_akhir = 'A';
        } else if ($this->rata_rata >= 80) {
            $this->nilai_akhir = 'B';
        } else if ($this->rata_rata >= 60) {
            $this->nilai_akhir = 'C';
        } else if ($this->rata_rata < 60) {
            $this->nilai_akhir = 'D';
        }
        $this->query = "INSERT INTO nilai (nim,kode_mk,uas,uts,tugas,kuis,rata_rata,nilai_akhir) VALUES ('$this->nim', '$this->kode_mk', $this->uas, $this->uts, $this->tugas, $this->kuis, $this->rata_rata, '$this->nilai_akhir')";
        $this->hasil = mysqli_query($koneksi, $this->query);
        if($this->hasil){
            header("Location: class_nilai.php?nim=$this->nim");
        }
    }
}

//membuat objek dari class addNilai
$addObj = new addNilai();
$add = $addObj->add();

?>
