<?php
include('../../koneksi.php'); //menyisipkan file koneksi.php kedalam file delete_kelas.php

class delKelas{ //membuat dan mendeklarasikan class delKelas yang dimana didalamnya terdapat properti dan juga method

    public $kode_kelas; //membuat properti $kode_kelas yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $data; //membuat properti $data yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)

    //membuat method __construct() yang dinyatakan sebagai public
    public function __construct()
    {
        if(isset($_GET['kode_kelas'])){
            $this->kode_kelas = $_GET['kode_kelas'];
        }
    }

    //membuat method delete() yang dinyatakan sebagai public
    public function delete(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        $this->data = mysqli_query($koneksi, "DELETE FROM kelas WHERE kode_kelas = '$this->kode_kelas'");

        if($this->data) {
            header("location: class_list.php");
        }
    }
}

//membuat objek dari class delKelas
$delObj = new delKelas();
$hasil = $delObj->delete();
?>
