<?php

include('../../cekadmin.php'); //menyisipkan file cekadmin.php ke dalam file edit_nilai.php
//koneksi ke database
include('../../koneksi.php');

$db = new koneksi();
$koneksi = $db->getKoneksi();

class Nilai { //membuat dan mendeklarasikan class Nilai yang dimana didalamnya terdapat properti dan juga method
    
    //membuat properti yang dinyatakan sebagai public
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

    //membuat method __construct() yang dinyatakan sebagai public
    public function __construct()
    {
        if(isset($_GET['kode_mk'])){
            $this->kode_mk = $_GET['kode_mk'];
        }
        if(isset($_GET['nim'])) { 
            $this->nim = $_GET['nim'];
        }
    }   

    //membuat method read() yang dinyatakan sebagai public
    public function read() {
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        $this->sql = mysqli_query($koneksi, "SELECT * FROM nilai WHERE kode_mk='$this->kode_mk' AND nim='$this->nim'");
        $this->data = mysqli_fetch_array($this->sql);
    }
}

//membuat objek dari class Nilai
$updateObj = new Nilai();
$hasil = $updateObj->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SIAK - UPDATE NILAI</title>
    <?php include "../../header.php" ?>
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <!-- Navbar  -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark py-1">
        <div class="container-fluid">
        <button class="openbtn" onclick="openNav()">&#9776; </button> 
            <a class="navbar-brand" href="../admin.php">&nbsp; Inersys University</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="navbar-brand fs-6">
                        <?php 
                        echo "Welcome, " . $_SESSION['username'];
                    ?>
                    &nbsp; &nbsp;|
                </li>
                <div id="DisplayClock" class="clock text-white" onload="showTime()"></div>
                <script>
                    function showTime(){
                    var date = new Date();
                    var h = date.getHours();
                    var m = date.getMinutes();
                    var s = date.getSeconds();
                    var session = "";

                    h = (h<10) ? "0" + h : h;
                    m = (m<10) ? "0" + m : m;
                    s = (s<10) ? "0" + s : s;

                    var time = h + ":" + m + ":" + s + " " + session;

                    document.getElementById("DisplayClock").innerText = time;
                    document.getElementById("DisplayClock").textContent = time;

                    setTimeout(showTime, 1000);
                }

                showTime();
                </script>
                <div class="profile mt-1">
                    <i class="bi bi-power text-white mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    </i>
                </div>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo "Profil " . $_SESSION['username'] ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="../../img/profile.png" alt="" class="img-fluid mb-3" width="100">
                    <p><b><?php echo strtoupper($_SESSION['nama']);?></b></p>
                    <span class="badge rounded-pill bg-danger mt-0" style="font-size: 16px;">
                        <a href="../../logout.php" style="color: white; font-size: 13px;"><i class="fa-sharp fa-solid fa-power-off"></i>&nbsp; Logout</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div id="mySidebar" class="sidebar bg-dark">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <ul class="sidenav flex-column" style="padding-left: 0rem;" >
            <h1 class="navigation text-white mb-4 mt-1">Navigation</h1>
            <li class="nav-item">
            <a class="nav-link" href="../admin.php#user_panel"><i class="fa-solid fa-user"></i>&nbsp; User Panel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../admin.php#class_panel"><i class="fa-solid fa-building-columns"></i>&nbsp; Class Panel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../admin.php#matakuliah_panel"><i class="fa-solid fa-calendar-days"></i>&nbsp; Matakuliah Panel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../admin.php#schedule_panel"><i class="fa-solid fa-calendar-days"></i>&nbsp; Schedule Panel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../admin.php#grade_panel"><i class="fa-solid fa-book"></i>&nbsp; Grade Panel</a>
            </li>
        </ul>
    </div>

    <!-- Main content -->
    <!-- Update Nilai  -->
    <div id="main">
    <section>
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Update Nilai <?php echo " (" . $updateObj->kode_mk . ") - ".$updateObj->nim; ?> </h5> 
                </div>
                <div class="card-body">
                    <form action="class_update.php" method="post">
                        <div class="mb-1">
                            <label for="uas" class="form-label">UAS</label>
                            <input type="text" name="uas" class="form-control" id="uas" aria-describedby="uas" required value="<?php echo $updateObj->data['uas']?>">
                        </div>
                        <div class="mt-3">
                            <label for="uts" class="form-label">UTS</label>
                            <input type="text" name="uts" class="form-control" id="uts" aria-describedby="uts" required value="<?php echo $updateObj->data['uts']?>">
                        </div>
                        <div class="mt-3">
                            <label for="kuis" class="form-label">Kuis</label>
                            <input type="text" name="kuis" class="form-control" id="kuis" aria-describedby="kuis" required value="<?php echo $updateObj->data['kuis']?>">
                        </div>
                        <div class="mt-3">
                            <label for="tugas" class="form-label">Tugas</label>
                            <input type="text" name="tugas" class="form-control" id="tugas" aria-describedby="tugas" required value="<?php echo $updateObj->data['tugas']?>">
                        </div>
                        <input type="hidden" name="nim" value="<?php echo $updateObj->nim; ?>" /> 
                        <input type="hidden" name="kode_mk" value="<?php echo $updateObj->kode_mk; ?>" /> 
                        <button type="submit" class="btn btn-primary mt-3" value="simpan">Submit</button>
                        <button type="reset" class="btn btn-secondary mt-3">Reset</button>
                    </form>
                </div>
            </div>  
        </div>
    </section>
    </div>

    <!-- Footer -->
    <?php include "../../footer.php" ?>

    <!-- JS -->
    <script>
        function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
