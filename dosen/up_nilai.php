<?php
// koneksi ke database
include('../cekdosen.php');
include ('../koneksi.php');
$db = new koneksi();
$koneksi = $db->getKoneksi();
// $tampil = $db->nilai();

//Code ini digunakan untuk memeriksa apakah ada nilai yang diterima dari parameter $_GET dengan nama "kode_mk". Jika ada, maka nilai tersebut disimpan dalam variabel $kode_mk.
if(isset($_GET['kode_mk'])){
    $kode_mk = $_GET['kode_mk']; 
}
//Code ini digunakan untuk memeriksa apakah ada nilai yang diterima dari parameter $_GET dengan nama "nim". Jika ada, maka nilai tersebut disimpan dalam variabel $nim.
if(isset($_GET['nim'])){
    $nim = $_GET['nim']; 
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SIAK - Update Nilai</title>
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

    <!-- Main content -->
    <section>
        <div class="container d-flex justify-content-center dosen mb-5">
            <div class="card" style="width: 70rem; margin-top: 2rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Edit Nilai - <?php echo $nim ?> </h5> 
                </div>
                <div class="card-body">
                    <form action="class_up_nilai.php" method="post">
                    <!--query untuk menampilkan data tabel nilai dari database--> 
                    <?php 
                            $data=mysqli_query($koneksi, "SELECT * FROM nilai where kode_mk='$kode_mk' AND nim='$nim'");
                            $row = mysqli_fetch_array($data)
                        ?>

                        <div class="mb-2">
                            <label for="kuis" class="form-label">Kuis</label>
                            <input type="text" name="kuis" class="form-control" id="kuis" aria-describedby="kuis" value="<?php echo $row['kuis'] ?>">
                        </div>
                        <div class="mt-3">
                            <label for="tugas" class="form-label">Tugas</label>
                            <input type="tugas" name="tugas" class="form-control" id="tugas" aria-describedby="tugas" value="<?php echo $row['tugas'] ?>">
                        
                        <div class="mt-3">
                            <label for="uts" class="form-label">UTS</label>
                            <input type="text" name="uts" class="form-control" id="uts" aria-describedby="alamat" value="<?php echo $row['uts'] ?>">
                        </div>

                        <div class="mt-3">
                            <label for="uas" class="form-label">UAS</label>
                            <input type="text" name="uas" class="form-control" id="uas" aria-describedby="uas" value="<?php echo $row['uas'] ?>">
                        </div>
                        <input type="hidden" name="nim" value="<?php echo $row['nim']; ?>" /> 
                        <input type="hidden" name="kode_mk" value="<?php echo $kode_mk; ?>" /> 
                        <button type="submit" class="btn btn-primary mt-3" value="simpan">Submit</button>
                        <button type="reset" class="btn btn-secondary mt-3">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

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
