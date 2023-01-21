<?php
include('../../koneksi.php'); //menyisipkan file koneksi.php kedalam class_tambahKelas.php

//membuat dan mendeklarasikan class addClass yang dimana didalamnya terdapat property dan method
class addClass {
    public $kode_kelas; //membuat property $kode_kelas yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $kapasitas; //membuat property $kapasitas yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $query; //membuat property $query yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)

    //membuat method __construct() yang dinyatakan sebagai public
    public function __construct(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->kode_kelas = ($_POST["kode_kelas"]);
            $this->kapasitas = ($_POST["kapasitas"]);
        }
    }

    //membuat method add() yang dinyatakan sebagai public
    public function add(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();
        $this->query = $hasil= mysqli_query($koneksi, "INSERT INTO kelas (kode_kelas,kapasitas) VALUES ('$this->kode_kelas', '$this->kapasitas')");

        if($hasil){
            header("Location:../admin.php");
        } 

    }
}

//membuat objek dari clas addClass
$addObj = new addClass();
$hasil = $addObj->add();
?>
