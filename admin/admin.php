<?php
include('../cekadmin.php');  
include('../koneksi.php');  
$db = new koneksi();
$koneksi = $db->getKoneksi();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>SIAK - ADMIN</title>
    <?php include "../header.php" ?>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <!-- Navbar  -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark py-1">
        <div class="container-fluid">
        <button class="openbtn" onclick="openNav()">&#9776; </button> 
            <a class="navbar-brand" href="admin.php">&nbsp; Inersys University</a>
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

    <!-- Sidebar  -->
    <div id="mySidebar" class="sidebar bg-dark">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <ul class="sidenav flex-column" style="padding-left: 0rem;" >
            <h1 class="navigation text-white mb-4 mt-1">Navigation</h1>
            <li class="nav-item">
            <a class="nav-link" href="#user_panel"><i class="fa-solid fa-user"></i>&nbsp; User Panel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#class_panel"><i class="fa-solid fa-building-columns"></i>&nbsp; Class Panel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#matakuliah_panel"><i class="fa-solid fa-calendar-days"></i>&nbsp; Matakuliah Panel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#schedule_panel"><i class="fa-solid fa-calendar-days"></i>&nbsp; Schedule Panel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#grade_panel"><i class="fa-solid fa-book"></i>&nbsp; Grade Panel</a>
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
    <!-- User panel  -->
    <section id="user_panel">
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">User Panel</h5> 
                </div>
                <div class="card-body">
                    <h5 class="card-title mb-2">Add User</h5> 
                    <form action="user panel/add_user.php" method="post">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" aria-describedby="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" name="nim" class="form-control" id="nim" aria-describedby="nim" required>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label> <br>
                            <input type="radio" name="gender" value ="1" required/> Laki - Laki
                            &nbsp;&nbsp;&nbsp;
                            <input type="radio" name="gender" value ="0" required/> Perempuan
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" aria-describedby="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select name="level" class="form-control" required>
                                <option value="">Pilih Level User</option>
                                <option value="Dosen">Dosen</option>
                                <option value="Mahasiswa">Mahasiswa</option>
                            </select>
                        </div>
                        <hr>
                        <span style="color:red;">* hanya untuk level mahasiswa!</span> <br>
                        <div class="mb-3 mt-3">
                            <label for="kode_kelas" class="form-label">Kode Kelas</label>
                            <select name="kode_kelas" class="form-control" id="kode_kelas">
                                <?php
                                    $query = "SELECT * FROM kelas";
                                    $hasil = mysqli_query($koneksi,$query);
                                ?>
                                <option value="">Pilih Kode Kelas</option>
                                <?php while($select=mysqli_fetch_array($hasil)) {?>
                                <option value="<?=$select['kode_kelas'] ?>"><?=$select['kode_kelas'] ?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="prodi" class="form-label">Prodi</label>
                            <select name="prodi" class="form-control" id="prodi">
                            <option value="">Pilih Prodi</option>
                            <option value="Sistem Komputer">S1-Sistem Komputer</option>
                            <option value="Sistem Informasi">S1-Sistem Informasi</option>
                            <option value="Teknologi Informasi">S1-Teknologi Informasi</option>
                            <option value="Bisnis Digital">S1-Bisnis Digital</option>
                            <option value="Manajemen Informatika">D3-Manajemen Informatika</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3" value="simpan">Submit</button>
                        <button type="reset" class="btn btn-secondary mt-3">Reset</button>
                        <a href="user panel/users_list.php" class="btn btn-success mt-3" role="button">User List</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Class panel  -->
    <section id="class_panel">
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Class Panel</h5> 
                </div>
                <div class="card-body">
                <h5 class="card-title mb-2">Add Class</h5> 
                <form action="class panel/class_tambahKelas.php" method="post">
                    <div class="mt-3">
                        <label for="kode_kelas" class="form-label">Kode Kelas</label>
                        <input type="text" name="kode_kelas" class="form-control" id="kode_kelas" aria-describedby="kode_kelas" required>
                    </div>
                    <div class="mt-3 mb-3">
                        <label for="kapasitas" class="form-label">Kapasitas</label>
                        <input type="text" name="kapasitas" class="form-control" id="kapasitas" aria-describedby="kapasitas" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" value="simpan">Submit</button>
                    <button type="reset" class="btn btn-secondary mt-3">Reset</button>
                    <a href="class panel/class_list.php" class="btn btn-success mt-3" role="button">Class List</a>
                </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Matakuliah panel  -->
    <section id="matakuliah_panel">
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Matakuliah Panel</h5> 
                </div>
                <div class="card-body">
                <h5 class="card-title mb-2">Add Matakuliah</h5> 
                <form action="matakuliah panel/class_tambah.php" method="post">
                    <div class="mt-3">
                        <label for="kode_mk" class="form-label">Kode Matakuliah</label>
                        <input type="text" name="kode_mk" class="form-control" id="kode_mk" aria-describedby="kode_mk" required>
                    </div>
                    <div class="mt-3">
                        <label for="nama_mk" class="form-label">Nama Matakuliah</label>
                        <input type="text" name="nama_mk" class="form-control" id="nama_mk" aria-describedby="nama_mk" required>
                    </div>
                    <div class="mt-3">
                        <label for="sks" class="form-label">SKS</label>
                        <input type="text" name="sks" class="form-control" id="sks" aria-describedby="sks" required>
                    </div>
                    <div class="mt-3 mb-3">
                        <label for="nim" class="form-label">Dosen</label>
                        <select name="nim" class="form-control" id="nim" required>
                            <?php
                                $sql = "SELECT * FROM dosen";
                                $data = mysqli_query($koneksi,$sql);
                            ?>
                            <option value="">Pilih Dosen</option>
                            <?php while($pilih=mysqli_fetch_array($data)) {?>
                            <option value="<?=$pilih['nim'] ?>"><?=$pilih['nim'] ." - ". $pilih['nama']?></option>
                            <?php }?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" value="simpan">Submit</button>
                    <button type="reset" class="btn btn-secondary mt-3">Reset</button>
                    <a href="matakuliah panel/matakuliah_list.php" class="btn btn-success mt-3" role="button">Matakuliah List</a>
                </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Schedule panel  -->
    <section id="schedule_panel">
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Schedule Panel</h5> 
                </div>
                <div class="card-body">
                    <h5>Create Schedule</h5>
                    <form action="schedule panel/jadwal.php" method="post">
                        <div class="mt-3">
                            <label for="nim" class="form-label">Kode Kelas</label>
                            <select name="kode_kelas" class="form-control" id="kode_kelas" required>
                                <?php
                                    $query = "SELECT * FROM kelas";
                                    $hasil = mysqli_query($koneksi,$query);
                                ?>
                                <option value="">Pilih Kode Kelas</option>
                                <?php while($select=mysqli_fetch_array($hasil)) {?>
                                <option value="<?=$select['kode_kelas'] ?>"><?=$select['kode_kelas'] ?></option>
                                <?php }?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3" value="create">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Grade panel  -->
    <section id="grade_panel">
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Grade Panel</h5> 
                </div>
                <div class="card-body">
                    <h5 class="card-title mb-2" style="font-weight: bold;">Add Nilai</h5>
                    <form action="grade panel/class_nilai.php" method="post">
                        <div class="mt-3">
                                <label for="nim" class="form-label">NIM</label>
                                <select name="nim" class="form-control" id="nim">
                                    <?php
                                        $query = "SELECT * FROM mahasiswa order by kode_kelas";
                                        $hasil = mysqli_query($koneksi,$query);
                                    ?>
                                    <option value="">Pilih NIM</option>
                                    <?php while($select=mysqli_fetch_array($hasil)) {?>
                                    <option value="<?=$select['nim'] ?>"><?=$select['nim'] ?> - <?=$select['kode_kelas'] ?></option>
                                    <?php }?>
                                </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3" value="simpan">Submit</button>
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
