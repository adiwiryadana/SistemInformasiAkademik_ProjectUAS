<?php 

class getNim {
    public $nim;

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