<?php 

class getNim { //membuat dan mendeklarasikan class getNim yang dimana didalamnya terdapat properti dan juga method
    
    //membuat properti $nim yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $nim;

    //membuat method getNim () yang dinyatakan sebagai public
    public function getNim()
    {
        if(isset($_GET['nim'])){
            $this->nim = $nim = $_GET['nim'];
        }
        else {
            die ("Error. Tidak Ada Nim Yang Dipilih");    
        }
        
        return $nim;
    }
}
?>
