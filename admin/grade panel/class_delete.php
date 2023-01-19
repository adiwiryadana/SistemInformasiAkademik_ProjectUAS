<?php
include('../../koneksi.php');

class delNilai{

    public $kode_mk;
    public $data;
    public $nim;


    public function __construct()
    {
        if(isset($_GET['kode_mk'])){
            $this->kode_mk = $_GET['kode_mk'];
        }
        if(isset($_GET['nim'])) { 
            $this->nim = $_GET['nim'];
         }
    }

    public function delete(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        $this->data = mysqli_query($koneksi, "DELETE FROM nilai WHERE nim='$this->nim' AND kode_mk = '$this->kode_mk'");

        if($this->data) {
            header("location: class_nilai.php?nim=$this->nim");
        }
    }
}

$delObj = new delNilai();
$hasil = $delObj->delete();
?>  