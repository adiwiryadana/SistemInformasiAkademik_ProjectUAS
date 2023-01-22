<?php
include('../../koneksi.php');
include('../../cekadmin.php');
$db = new koneksi();
$koneksi = $db->getKoneksi();

class updateNilai {
    public $kode_mk;
    public $nim;
    public $uas;
    public $uts;
    public $tugas;
    public $kuis;
    public $query;
    public $rata_rata;
    public $nilai_akhir;

    public function __construct(){  
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->nim= ($_POST["nim"]);
            $this->kode_mk= ($_POST["kode_mk"]);
            $this->uas= ($_POST["uas"]);
            $this->uts= ($_POST["uts"]);
            $this->tugas= ($_POST["tugas"]);
            $this->kuis= ($_POST["kuis"]);
        }
    }
    
    public function update(){
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
        
        $this->query = mysqli_query($koneksi, "UPDATE nilai SET uas='$this->uas', uts='$this->uts', 
        tugas='$this->tugas', kuis='$this->kuis', rata_rata='$this->rata_rata' , nilai_akhir='$this->nilai_akhir' WHERE kode_mk='$this->kode_mk' AND nim='$this->nim'");

        if($this->query){
            header("Location: class_nilai.php?nim=$this->nim");
        } 
    }
}

$obj = new updateNilai();
$hasil = $obj->update();
?>
