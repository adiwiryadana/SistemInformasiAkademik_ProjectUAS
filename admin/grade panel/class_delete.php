<?php

//membuat koneksi ke database
include('../../koneksi.php');

class delNilai{ //menambahkan dan mendeklarasikan class delNilai yang dimana didalamnya terdapat properti dan juga method

    //membuat properti yang dinyatakan sebagai public
    public $kode_mk;
    public $data;
    public $nim;

    //membuat method function __construct() yang dinyatakan sebagai public
    public function __construct()
    {
        if(isset($_GET['kode_mk'])){
            $this->kode_mk = $_GET['kode_mk'];
        }
        if(isset($_GET['nim'])) { 
            $this->nim = $_GET['nim'];
         }
    }

    //membuat method function delete() yang dinyatakan sebagai public
    public function delete(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        $this->data = mysqli_query($koneksi, "DELETE FROM nilai WHERE nim='$this->nim' AND kode_mk = '$this->kode_mk'");

        if($this->data) {
            header("location: class_nilai.php?nim=$this->nim");
        }
    }
}
//membuat objek dari class delNilai
$delObj = new delNilai();
$hasil = $delObj->delete();
?>  
