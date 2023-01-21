<?php
//menyertakan file cekmahasiswa.php dan koneksi.php 
include ('../cekmahasiswa.php');
include ('../koneksi.php');

$db = new koneksi();
$tampil = $db->tampilmhs(); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>SIAK - MAHASISWA</title>
    <?php include "../header.php" ?> //menyertakan file header.php
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
                    
                 //script untuk menampilkan waktu
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
            <a class="nav-link" href="#user_information"><i class="fa-solid fa-user"></i>&nbsp; User Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#jadwal"><i class="fa-solid fa-calendar-days"></i>&nbsp; Jadwal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#nilai"><i class="fa-solid fa-book"></i>&nbsp; Nilai</a>
            </li>
        </ul>
    </div>

    <!-- Profile  -->
    <div id="main">
    <section class="jumbotron text-center">
        <img src="../img/profile.png" alt="profile" width="200px" class="rounded-circle img-thumbnail mb-3" />
        <p class="display-6"><?php echo $_SESSION['nim']?></p>
        <h1 class="display-5"><?php echo $_SESSION['nama'] ?></h1>
    </section>

    <!-- Main content -->
    <!-- Biodata -->
    <section id="user_information">
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">User Information</h5> 
                </div>
                <div class="card-body table-responsive" >
                    <table class="table table-bordered table-striped">
                       
                    //menampilkan (READ) data mahasiswa pada database mahasiswa
                    <?php
                    foreach($tampil as $row) {;
                    ?>
                        <tr>
                            <td>NIM</td>
                            <td><?php echo $row['nim'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td><?php echo $row['nama'] ?></td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td><?php echo $row['kode_kelas'] ?></td>
                        </tr>
                        <tr>
                            <td>Tempat Lahir</td>
                            <td><?php echo $row['tempat_lahir'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</th>
                            <td><?php echo $row['tanggal_lahir'] ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</th>
                            <td><?php if($row['gender']==1) {
                                        echo "Laki - Laki"; 
                                    } else if($row['gender']==0){
                                        echo "Perempuan";
                                    }?></td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td><?php echo $row['phone'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $row['email'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Ayah</td>
                            <td><?php echo $row['ayah'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Ibu</th>
                            <td><?php echo $row['ibu'] ?></td>
                        </tr>
                        <tr>
                            <td>Prodi</td>
                            <td><?php if($row['prodi']=='SK') {
                                        echo "SISTEM KOMPUTER"; 
                                    } else if($row['prodi']=='SI'){
                                        echo "SISTEM INFORMASI";
                                    }else if($row['prodi']=='TI'){
                                        echo "TEKNOLOGI INFORMASI";
                                    }else if($row['prodi']=='BD'){
                                        echo "BISNIS DIGITAL";
                                    }else if($row['prodi']=='MK'){
                                        echo "MANAJEMEN INFORMATIKA";
                                    }
                                    ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><?php echo $row['alamat'] ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <a href="user_mhs.php?nim=<?=$_SESSION['nim']?>" class="btn btn-success" role="button">Edit Biodata</a>
                </div>
            </div>
        </div>
    </section>


//script php untuk menampilkan jadwal mahasiswa
    <?php 
        $db = new koneksi();
        $koneksi = $db->getKoneksi();
        $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$_SESSION[nim]'");
        $data = mysqli_fetch_array($query);

            $no = 1;
            //queary untuk meakukan READ jadwal mahasiswa dengan melakukan JOIN pada beberapa table
            $query = 
                "SELECT matakuliah.kode_mk, nama_mk, jadwal.hari, waktu, ruang, dosen.nama
                FROM 
                    matakuliah inner join jadwal
                    ON matakuliah.kode_mk = jadwal.kode_mk
                    inner join dosen
                    ON dosen.nim = matakuliah.nim
                WHERE jadwal.kode_kelas = '$data[kode_kelas]'
            ";
            $hasil = mysqli_query($koneksi, $query);
            
            if (mysqli_num_rows($hasil) > 0){
    ?>
    <!-- Jadwal -->
    <section id="jadwal">                    
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Jadwal</h5> 
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped text-center align-middle ">
                        <tr>
                            <th>No</th>
                            <th>Kode Matakuliah</th>
                            <th>Matakuliah</th>
                            <th>Hari</th>
                            <th>Ruang</th>
                            <th width="120px">Waktu</th>
                            <th>Dosen</th>
                        </tr>

                        <?php
                            while ($row = mysqli_fetch_array($hasil)) {
                        ?>
                        <tr>
                            //menampilkan jadwal ke dalam table 
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['kode_mk']; ?></td>
                            <td><?php echo $row['nama_mk']; ?></td>
                            <td><?php echo $row['hari']; ?></td>
                            <td><?php echo $row['ruang']; ?></td>
                            <td><?php echo $row['waktu']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                        </tr>
                        <?php } ?>
                    </table> 
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <?php 
        $db = new koneksi();
        $koneksi = $db->getKoneksi();
        $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$_SESSION[nim]'");
        $data = mysqli_fetch_array($query);
        $no = 1;
        $query = 
            "SELECT nilai.kode_mk, matakuliah.nama_mk, uas, uts, tugas, kuis
            FROM nilai inner join matakuliah 
            ON nilai.kode_mk = matakuliah.kode_mk
            WHERE nilai.nim='$_SESSION[nim]'";
        $sql = mysqli_query($koneksi, $query);    
        $no=1;
        if (mysqli_num_rows($sql) > 0){
    ?>
    <!-- Nilai -->
    <section id="nilai">
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Nilai</h5> 
                </div>
                <div class="card-body table-responsive"> 
                    <table class="table table-bordered table-striped text-center align-middle ">
                        <tr>
                            <th>No</th>
                            <th>Kode Matakuliah</th>
                            <th>Matakuliah</th>
                            <th>UAS</th>
                            <th>UTS</th>
                            <th>Kuis</th>
                            <th>Tugas</th>
                        </tr>

                        <?php
                        while ($row = mysqli_fetch_array($sql)) {
                        ?>
                        <tr>
                        <td><?php echo $no++?></td>
                            <td><?php echo $row['kode_mk'];?></td>
                            <td><?php echo $row['nama_mk'];?></td>
                            <td><?php echo $row['uas'];?></td>
                            <td><?php echo $row['uts'];?></td>
                            <td><?php echo $row['kuis'];?></td>
                            <td><?php echo $row['tugas'];?></td>
                        </tr>
                        <?php } ?>
                    </table> 
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
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
