<?php
include("../../koneksi.php");  //menyisipkan file koneksi.php ke dalam class_list.php
include('../../cekadmin.php'); //menyisipkan file cek_admin.php ke dalam class_list.php


class tampil{   //membuat dan mendeklarasikan class bernama tampil yang dimana didalam kelas ini akan terdapat properti dan juga method
    
    //membuat property $data yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $query; 
    
    //membuat property $data yang dinyatakan sebagai public (seluruh kode program di luar class bisa mengaksesnya)
    public $data;
    
    //membuat method tampil_list () yang dinyatakan sebagai public
    public function tampil_list(){ 
        $db = new koneksi(); 
        $koneksi = $db->getKoneksi(); 
        $this->query = mysqli_query($koneksi, "SELECT * FROM kelas"); 
    }
}

//membuat objek dari class tampil
$dataObj = new tampil();
$row = $dataObj->tampil_list();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>SIAK - LIST KELAS</title>
    <?php include "../../header.php" ?> //menyisipkan file header.php ke dalam class_list.php
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
    <!-- Create jadwal  -->
    <div id="main">
    <section>
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 50rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">List Kelas</h5> 
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped text-center align-middle table-hover">
                        <tr class="table-secondary">
                            <th width="50px">No</th>
                            <th>Kode Kelas</th>
                            <th>Kapasitas</th>
                            <th>Aksi</th>
                        </tr>

                        <?php 
                        $no=1;
                        while($data = mysqli_fetch_array($dataObj->query)) { ?>
                        <tr>
                            <td><?php echo $no++?></td>
                            <td><?php echo $data['kode_kelas']?></td>
                            <td><?php echo $data['kapasitas']?></td>
                            <td>
                                <a href="delete_kelas.php?kode_kelas=<?php echo $data['kode_kelas'];?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"><span class="badge rounded-pill text-bg-danger delete-form"><i class="bi bi-trash"></a></i></span></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
    </div>
    
    <!-- Footer -->
    <?php include "../../footer.php" ?> //menyisipkan file footer.php ke dalam class_list.php
    
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
