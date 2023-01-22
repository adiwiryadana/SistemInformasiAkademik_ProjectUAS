<?php

include('../../cekadmin.php'); //menyisipkan file cekadmin.php ke dalam class_update.php
//membuat koneksi ke database dengan menyertakan koneksi.php
include('../../koneksi.php');

$db = new koneksi();
$koneksi = $db->getKoneksi();

class updateMk { //membuat dan mendeklarasikan class updateMk yang dimana didalamnya terdapat properti dan juga method
    
    //membuat properti yang dinyatakan sebagai public
    public $kode_mk;
    public $nama_mk;
    public $sks;
    public $nim;
    public $query;

    //membuat method function __construct() yang dinyatakan sebagai public
    public function __construct(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->kode_mk = ($_POST["kode_mk"]);
            $this->nama_mk= ($_POST["nama_mk"]);
            $this->sks= ($_POST["sks"]);
            $this->nim= ($_POST["nim"]);
        }
    }

    //membuat method function update() yang dinyatakan sebagai public
    public function update(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        $this->query = $hasil= mysqli_query($koneksi, "UPDATE matakuliah SET nama_mk='$this->nama_mk', sks='$this->sks', nim='$this->nim' WHERE kode_mk='$this->kode_mk'");

        if($hasil){
            header("Location: matakuliah_list.php");
        } 
    }
}

//membuat objek dari class updateMk
$obj = new updateMk();
$hasil = $obj->update();
?>
