<?php
include('../../koneksi.php');

class delKelas{

    public $kode_kelas;
    public $data;

    public function __construct()
    {
        if(isset($_GET['kode_kelas'])){
            $this->kode_kelas = $_GET['kode_kelas'];
        }
    }

    public function delete(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        $this->data = mysqli_query($koneksi, "DELETE FROM kelas WHERE kode_kelas = '$this->kode_kelas'");

        if($this->data) {
            header("location: class_list.php");
        }
    }
}

$delObj = new delKelas();
$hasil = $delObj->delete();
?>