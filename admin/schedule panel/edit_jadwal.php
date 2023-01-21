<?php
// koneksi ke database
include('../../koneksi.php');
include('../../cekadmin.php');
$db = new koneksi();
$koneksi = $db->getKoneksi();
//Code ini digunakan untuk menangkap nilai dari parameter 'kode_kelas' yang diterima melalui metode GET dari sebuah permintaan HTTP. Jika parameter 'kode_kelas' diterima, maka nilainya akan disimpan dalam variabel $kode_kelas. Jika tidak diterima, maka variabel $kode_kelas akan tidak diinisialisasi atau kosong.
if(isset($_GET['kode_kelas'])){
    $kode_kelas = $_GET['kode_kelas'];
}
//Code ini digunakan untuk menangkap nilai dari parameter 'kode_mk' yang diterima melalui metode GET dari sebuah permintaan HTTP. Jika parameter 'kode_mk' diterima, maka nilainya akan disimpan dalam variabel $kode_mk. Jika tidak diterima, maka variabel $kode_mk akan tidak diinisialisasi atau kosong. 
if(isset($_GET['kode_mk'])){
    $kode_mk = $_GET['kode_mk'];
}
//query untuk menampilkan data dari database
$sql = mysqli_query($koneksi, "SELECT matakuliah.nama_mk, jadwal.hari, ruang, waktu FROM matakuliah INNER JOIN jadwal ON matakuliah.kode_mk = jadwal.kode_mk WHERE matakuliah.kode_mk = '$kode_mk' AND jadwal.kode_kelas = '$kode_kelas'");
$data = mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SIAK - Update Jadwal</title>
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
    <!-- Update Jadwal  -->
    <div id="main">
    <section>
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Edit Jadwal Kelas <?PHP echo $kode_kelas?></h5> 
                </div>
                <div class="card-body">
                    <form action="class_editJadwal.php" method="post">
                        <div class="mt-1">
                            <label for="ruang" class="form-label">Ruang</label>
                            <input type="text" name="ruang" class="form-control" id="ruang" aria-describedby="ruang" required value="<?php echo $data['ruang']?>">
                        </div>
                        <div class="mt-3">
                            <label for="hari" class="form-label">Hari</label>
                            <input type="text" name="hari" class="form-control" id="hari" aria-describedby="hari" required value="<?php echo $data['hari']?>">
                        </div>
                        <div class="mt-3">
                            <label for="waktu" class="form-label">Waktu</label>
                            <input type="text" name="waktu" class="form-control" id="waktu" aria-describedby="waktu" required value="<?php echo $data['waktu']?>">
                        </div>
                        <input type="hidden" name="kode_kelas" value="<?php echo $kode_kelas; ?>" />
                        <input type="hidden" name="kode_mk" value="<?php echo $kode_mk; ?>" />
                        <button type="submit" class="btn btn-primary mt-3" value="simpan">Simpan</button>
                        <a href="jadwal.php?kode_kelas=<?php echo $kode_kelas;?>" class="btn btn-danger mt-3" role="button">Batal</a>
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
