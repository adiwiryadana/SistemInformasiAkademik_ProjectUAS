<?php
include('../../koneksi.php');

class delMatakuliah{

    public $kode_mk;
    public $data;


    public function __construct()
    {
        if(isset($_GET['kode_mk'])){
            $this->kode_mk = $_GET['kode_mk'];
        }
    }

    public function delete(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        $this->data = mysqli_query($koneksi, "DELETE FROM matakuliah WHERE kode_mk = '$this->kode_mk'");

        if($this->data) {
            header("location: matakuliah_list.php");
        }
    }
}

$delObj = new delMatakuliah();
$hasil = $delObj->delete();
?>