<?php //menyertakan file koneksi.php untuk terkoneksi ke db
include('../../koneksi.php');

//membuat class delMatakuliah dimana terdapat properti dan juga method
class delMatakuliah{

    public $kode_mk; //membuat properti $kodemk yang bersifat public
    public $data; //membuat properti $data yang bersifat public


    public function __construct()
    {
        if(isset($_GET['kode_mk'])){
            $this->kode_mk = $_GET['kode_mk'];
        }
    }
    //membuat unction delete() yang bersifat public untuk melakukan DELETE mata kuliah
    public function delete(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();
        //query untuk melakukan delete 
        $this->data = mysqli_query($koneksi, "DELETE FROM matakuliah WHERE kode_mk = '$this->kode_mk'");

        if($this->data) {
            header("location: matakuliah_list.php");
        }
    }
}

$delObj = new delMatakuliah();
$hasil = $delObj->delete();
?>
