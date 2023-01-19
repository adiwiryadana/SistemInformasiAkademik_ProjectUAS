<?php

include('../../cekadmin.php');
include('../../koneksi.php');
$db = new koneksi();
$koneksi = $db->getKoneksi();

class Nilai {
    public $kode_nilai;
    public $nim;
    public $kode_mk;
    public $uas;
    public $uts;
    public $tugas;
    public $kuis;
    public $sql;
    public $query;
    public $data;

    public function __construct()
    {
        if(isset($_GET['kode_mk'])){
            $this->kode_mk = $_GET['kode_mk'];
        }
        if(isset($_GET['nim'])) { 
            $this->nim = $_GET['nim'];
        }
    }   

    public function read() {
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        $this->sql = mysqli_query($koneksi, "SELECT * FROM nilai WHERE kode_mk='$this->kode_mk' AND nim='$this->nim'");
        $this->data = mysqli_fetch_array($this->sql);
    }
}

$updateObj = new Nilai();
$hasil = $updateObj->read();
?>

<html>
    <head>
        <title>SIAK - UPDATE NILAI</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../../style.css">
    </head>

    <body>
        <!-- Navbar  -->
        <nav class="navbar navbar-expand-lg navbar-dark shadow-lg sticky-top bg-dark mb-5">
            <div class="container">
                <a class="navbar-brand" href="admin.php">SISTEM INFORMASI AKADEMIK</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="navbar-brand fs-6">
                            <?php 
                            date_default_timezone_set('Asia/Kuala_Lumpur');
                            echo "Welcome " . $_SESSION['username'];
                            echo date(' |  H:i:s');
                        ?>
                    </li>
                    <li class="navbar-brand fs-6">
                        <a href="../../logout.php"><img src="../../img/logout.png" alt="logout" width="20px" class="logout"> Logout</a>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- create jadwal  -->
        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">UPDATE NILAI <?php echo " (" . $updateObj->kode_mk . ") - ".$updateObj->nim; ?> </h5> 
                    </div>
                    <div class="card-body">
                        <form action="class_update.php" method="post">
                            <div class="mb-1">
                                <label for="uas" class="form-label">UAS</label>
                                <input type="text" name="uas" class="form-control" id="uas" aria-describedby="uas" required value="<?php echo $updateObj->data['uas']?>">
                            </div>
                            <div class="mb-1">
                                <label for="uts" class="form-label">UTS</label>
                                <input type="text" name="uts" class="form-control" id="uts" aria-describedby="uts" required value="<?php echo $updateObj->data['uts']?>">
                            </div>
                            <div class="mb-1">
                                <label for="kuis" class="form-label">KUIS</label>
                                <input type="text" name="kuis" class="form-control" id="kuis" aria-describedby="kuis" required value="<?php echo $updateObj->data['kuis']?>">
                            </div>
                            <div class="mb-1">
                                <label for="tugas" class="form-label">TUGAS</label>
                                <input type="text" name="tugas" class="form-control" id="tugas" aria-describedby="tugas" required value="<?php echo $updateObj->data['tugas']?>">
                            </div>
                            <input type="hidden" name="nim" value="<?php echo $updateObj->nim; ?>" /> 
                            <input type="hidden" name="kode_mk" value="<?php echo $updateObj->kode_mk; ?>" /> 
                            <button type="submit" class="btn btn-primary" value="simpan">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </form>
                    </div>
                </div>  
            </div>
        </section>
    </body>
</html>