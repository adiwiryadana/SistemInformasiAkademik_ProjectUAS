<?php
include('../cekdosen.php');
include ('../koneksi.php');
$db = new koneksi();
$koneksi = $db->getKoneksi();

if(isset($_GET['kode_mk'])){
    $kode_mk = $_GET['kode_mk']; 
}

?>


<!DOCTYPE html>
<html lang="en">
    
<head>
    <title>SIAK - List Nilai</title>
    <?php include "../header.php" ?>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <!-- Navbar  -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark py-1">
        <div class="container-fluid">
        <button class="openbtn" onclick="openNav()">&#9776; </button> 
            <a class="navbar-brand" href="dosen.php">&nbsp; Inersys University</a>
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
    <?php include "../modal.php" ?>

    <!-- Sidebar -->
    <div id="mySidebar" class="sidebar bg-dark">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <ul class="sidenav flex-column" style="padding-left: 0rem;" >
            <h1 class="navigation text-white mb-4 mt-1">Navigation</h1>
            <li class="nav-item">
            <a class="nav-link" href="dosen.php#biodata"><i class="fa-solid fa-user"></i>&nbsp; Biodata</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dosen.php#jadwal_dosen"><i class="fa-solid fa-calendar-days"></i>&nbsp; Jadwal Dosen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dosen.php#input_nilai"><i class="fa-solid fa-book"></i>&nbsp; Input Nilai</a>
            </li>
        </ul>
    </div>
    
    <!-- Profile  -->
    <div id="main">
    <section class="jumbotron text-center">
        <img src="../img/profile.png" alt="profile" width="200px" class="rounded-circle img-thumbnail mb-3" />
        <h1 class="display-6"><?php echo $_SESSION['nim'] ?></h1>
        <h1 class="display-5"><?php echo $_SESSION['nama'] ?></h1>
    </section>

    <!-- Daftar Nilai -->
    <section id="">
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Daftar Nilai <?php echo $kode_mk;?></h5> 
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Kode Kelas</th>
                            <th>UTS</th>
                            <th>UAS</th>
                            <th>Kuis</th>
                            <th>Tugas</th>
                            <th colspan="2">Aksi</th>
                        </th>

                        <?php 
                            $data=mysqli_query($koneksi, "SELECT mahasiswa.nim, mahasiswa.nama, kelas.kode_kelas, nilai.uas, uts, tugas, kuis FROM nilai inner join mahasiswa on mahasiswa.nim = nilai.nim 
                            inner join kelas on mahasiswa.kode_kelas = kelas.kode_kelas
                            where kode_mk='$kode_mk' order by kelas.kode_kelas");

                            $no = 1;
                            while($row = mysqli_fetch_array($data)){
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['nim'] ?></td>
                                <td><?php echo $row['nama'] ?></td>
                                <td><?php echo $row['kode_kelas'] ?></td>
                                <td><?php echo $row['uts'] ?></td>
                                <td><?php echo $row['uas'] ?></td>
                                <td><?php echo $row['kuis'] ?></td>
                                <td><?php echo $row['tugas'] ?></td>
                                <td>
                                    <a href="up_nilai.php?nim=<?php echo $row['nim'];?>&kode_mk=<?php echo $kode_mk;?>"><span class="badge rounded-pill text-bg-success"><i class="bi bi-pencil"></i></span></a>
                                </td>

                                <td>
                                    <a href="del_nilai.php?nim=<?php echo $row['nim']; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"><span class="badge rounded-pill text-bg-danger delete-form"><i class="bi bi-trash"></i></span></a>
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
    <?php include "../footer.php" ?>

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