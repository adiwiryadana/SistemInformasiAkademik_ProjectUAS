<?php
//menyertakan file koneksi.php untuk terhubung ke db
include('../../koneksi.php');

//membuat class untuk menambah mata kuliah
class addMatakuliah {
    //deklarasi variable public
    public $kode_mk;
    public $nama_mk;
    public $sks;
    public $nim;
    public $query;
    
    //membuat function_construct bersifat public
    public function __construct(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->kode_mk = ($_POST["kode_mk"]);
            $this->nama_mk= ($_POST["nama_mk"]);
            $this->sks= ($_POST["sks"]);
            $this->nim= ($_POST["nim"]);
        }
    }
    //membuat function add() untuk menambahkan matakuliah
    public function add(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();
    //query untuk menambahkan data matakuliah
        $this->query = $hasil= mysqli_query($koneksi, "INSERT INTO matakuliah (kode_mk, nama_mk, sks, nim) VALUES ('$this->kode_mk', '$this->nama_mk', '$this->sks', '$this->nim')");

        if($hasil){
            header("Location:../admin.php");
        } 

    }
}

$delObj = new addMatakuliah();
$hasil = $delObj->add();
?>
