<?php
//menyertakan file cekmahasiswa.php, koneksi.php, class_getNim.php
include ('../cekmahasiswa.php');
include ('../koneksi.php');
include('../admin/user panel/class_getNim.php');

$db = new koneksi();
$koneksi = $db->getKoneksi();


$getNim = new getNim();
$nim = $getNim->getNim();
$db = new koneksi();
$tampil = $db->tampilmhs();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>SIAK - Update Biodata</title>
    <?php include "../header.php" ?>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <!-- Navbar  -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark py-1">
        <div class="container-fluid">
            <button class="openbtn" onclick="openNav()">&#9776; </button> 
            <a class="navbar-brand" href="mahasiswa.php">&nbsp; Inersys University</a>
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
            <a class="nav-link" href="..#user_information"><i class="fa-solid fa-user"></i>&nbsp; User Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="..#jadwal"><i class="fa-solid fa-calendar-days"></i>&nbsp; Jadwal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="..#nilai"><i class="fa-solid fa-book"></i>&nbsp; Nilai</a>
            </li>
        </ul>
    </div>

    <!-- Profile  -->
    <div id="main">
    <section class="jumbotron text-center">
        <img src="../img/profile.png" alt="profile" width="200px" class="rounded-circle img-thumbnail mb-3" />
        <h1 class="display-5"><?php echo $_SESSION['nama'] ?></h1>
    </section>

    <!-- Main content -->
    <!-- Update Biodata -->
    <section id="user_information">
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-2">Edit Biodata</h5> 
                </div>
                <div class="card-body">
                    <form action="class_upDataMhs.php" method="post" enctype="multipart/form-data">
                        <?php //form untuk melakukan update data diri
                        foreach($tampil as $row);
                        ?>
                        <div class="mb-2">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" aria-describedby="tempat_lahir" value="<?php echo $row['tempat_lahir'] ?>">
                        </div>
                        <div class="mt-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" aria-describedby="tanggal_lahir" value="<?php echo $row['tanggal_lahir'] ?>">
                        </div>
                        <div class="mt-3">
                            <label for="gender" class="form-label">Gender</label> <br>
                            <input type="radio" name="gender" value ="1" <?php if ($row['gender'] =='1'){ echo "CHECKED"; }?> required/> Laki - Laki
                            &nbsp;&nbsp;&nbsp;
                            <input type="radio" name="gender" value ="0" <?php if ($row['gender'] =='0'){ echo "CHECKED"; }?> required/> Perempuan
                        </div>
                        <div class="mt-3">
                            <label for="phone" class="form-label">Telepon</label>
                            <input type="text" name="phone" class="form-control" id="phone" aria-describedby="phone" value="<?php echo $row['phone'] ?>">
                        </div>
                        <div class="mt-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="email" value="<?php echo $row['email'] ?>">
                        </div>
                        <div class="mt-3">
                            <label for="ayah" class="form-label">Nama Ayah</label>
                            <input type="text" name="ayah" class="form-control" id="ayah" aria-describedby="ayah" value="<?php echo $row['ayah'] ?>">
                        </div>
                        <div class="mt-3">
                            <label for="ibu" class="form-label">Nama Ibu</label>
                            <input type="text" name="ibu" class="form-control" id="ibu" aria-describedby="ibu" value="<?php echo $row['ibu'] ?>">
                        </div>
                        </div>
                        <div class="mt-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="alamat" aria-describedby="alamat" value="<?php echo $row['alamat'] ?>">
                        </div>
                        <input type="hidden" name="nim" value="<?php echo $row['nim']; ?>" /> 
                        <button type="submit" class="btn btn-primary mt-3" value="simpan">Submit</button>
                        <button type="reset" class="btn btn-secondary mt-3">Reset</button>
                    </form>
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
