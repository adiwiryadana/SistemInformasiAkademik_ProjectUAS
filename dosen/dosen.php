<?php
// koneksi ke database
include('../cekdosen.php');
include ('../koneksi.php');
$db = new koneksi();
//Code ini digunakan untuk mengambil koneksi ke database dan menampilkan data dari tabel dosen.
$koneksi = $db->getKoneksi();
$tampil = $db->tampildsn();
//Code ini digunakan untuk mengambil nilai dari session dengan nama 'nim' dan menyimpan nilai tersebut dalam variabel $NIM.
$NIM=$_SESSION ['nim'] ;
//query untuk menampilkan data dari database
$query="SELECT * from matakuliah where nim='$NIM'";
$sql= mysqli_query($koneksi,$query);
//code ini berfungsi untuk apa
$dt= mysqli_fetch_array($sql);
$kode_mk = $dt['kode_mk'];
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <?php include "../header.php" ?>
    <link rel="stylesheet" href="../style.css">
    <title>SIAK - DOSEN</title>
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
            <a class="nav-link" href="#biodata"><i class="fa-solid fa-user"></i>&nbsp; Biodata</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#jadwal_dosen"><i class="fa-solid fa-calendar-days"></i>&nbsp; Jadwal Dosen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#input_nilai"><i class="fa-solid fa-book"></i>&nbsp; Input Nilai</a>
            </li>
        </ul>
    </div>

    <!-- Profile -->
    <div id="main">
    <section class="jumbotron text-center">
        <img src="../img/profile.png" alt="profile" width="200px" class="rounded-circle img-thumbnail mb-3 mt-0"/>
        <h1 class="display-6"><?php echo $_SESSION['nim'] ?></h1>
        <h1 class="display-5"><?php echo $_SESSION['nama'] ?></h1>
    </section>

    <!-- Main content -->
    <!-- Biodata  -->
    <section id="biodata">
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Biodata</h5> 
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered border border-secondary ">
                    <?php
                            foreach($tampil as $row);
                            ?>
                            
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td>NIP</td>
                                    <td><?php echo $row['nim'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td><?php echo $row['nama'] ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $row['email'] ?></td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td><?php echo $row['phone'] ?></td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td><?php 
                                            if($row['gender']==1) {
                                                echo "Laki - Laki"; 
                                            } else if($row['gender']==0){
                                                echo "Perempuan";
                                            }?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td><?php echo $row['alamat'] ?></td>
                                </tr>
                    </table>
                    <a class="btn btn-success" href="up_dosen.php?nim=<?=$row['nim']?>" role="button">Update Data</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Code ini digunakan untuk mengambil data dari jadwal dosen dan mengecek apakah ada data yang ditemukan atau tidak. -->
    <?php
        $jdw = $db->jdw_dsn();
        if (mysqli_num_rows($db->data)>0) {
    ?>

    <!-- Jadwal dosen -->
    <section id="jadwal_dosen">
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Jadwal Dosen</h5> 
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered border border-secondary">  
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Kode Matakuliah</th>
                                    <th>Matakuliah</th>
                                    <th>Kode Kelas</th>
                                    <th>Hari</th>
                                    <th>Waktu</th>
                                    <th>Ruang</th>

                                </tr>
                                <?php
                                    foreach($jdw as $mpl){;?>
                                <tr>
                                    <td><?php echo $mpl['kode_mk'] ?></td>
                                    <td><?php echo $mpl['nama_mk'] ?></td>
                                    <td><?php echo $mpl['kode_kelas'] ?></td>
                                    <td><?php echo $mpl['hari'] ?></td>
                                    <td><?php echo $mpl['waktu'] ?></td>
                                    <td><?php echo $mpl['ruang'] ?></td>
                                </tr>
                                <?php }?>
                        </table>
                </div>
            </div>
        </div>
    </section>
    <?php }?>
    
    <!-- Insert nilai  -->
    <section id="input_nilai">
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Input Nilai Mahasiswa</h5> 
                </div>
                <div class="card-body">
                    <form action="add_nilai.php" method="post">
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <select name="nim" class="form-control" id="nim">
                                <?php
                                    $query = "SELECT mahasiswa.nim, kelas.kode_kelas
                                    FROM mahasiswa inner join kelas
                                    on mahasiswa.kode_kelas = kelas.kode_kelas
                                    inner join jadwal 
                                    on jadwal.kode_kelas = kelas.kode_kelas
                                    inner join matakuliah 
                                    on matakuliah.kode_mk = jadwal.kode_mk
                                    where matakuliah.nim = '$NIM' 
                                    order by kelas.kode_kelas";
                                    $hasil = mysqli_query($koneksi,$query);
                                ?>
                                <option value="">Pilih NIM</option>
                                <?php while($select=mysqli_fetch_array($hasil)) {?>
                                <option value="<?=$select['nim'] ?>"><?=$select['nim'] ?> - <?=$select['kode_kelas'] ?></option>
                                <?php }?>
                            </select>
                        </div>

                        <div class="mt-3">
                            <label for="kode_mk" class="form-label">Kode Matakuliah</label>
                            <select name="kode_mk" class="form-control" id="kode_mk" required>
                                <?php
                                    $sql = "SELECT * FROM matakuliah where nim='$NIM'";
                                    $data = mysqli_query($koneksi,$sql);
                                ?>
                                <option value="">Pilih Kode Matakuliah</option>
                                <?php while($pilih=mysqli_fetch_array($data)) {?>
                                <option value="<?=$pilih['kode_mk'] ?>"><?=$pilih['kode_mk'] ." - ". $pilih['nama_mk']?></option>
                                <?php }?>
                            </select>
                        </div>
                
                        <div class="form-outline mt-3">
                            <label class="form-label" for="tugas">Tugas</label>
                            <input name="tugas" type="text" id="tugas" class="form-control" 
                            placeholder="masukan nilai tugas"/>
                        </div>

                        <div class="form-outline mt-3">
                            <label class="form-label" for="kuis">Kuis</label>
                            <input name="kuis" type="text" id="kuis" class="form-control" 
                            placeholder="masukan nilai kuis"/>
                        </div>

                        <div class="form-outline mt-3">
                            <label class="form-label" for="uts">UTS</label>
                            <input name="uts" type="text" id="uts" class="form-control" 
                            placeholder="masukan nilai uts"/>
                        </div>

                        <div class="form-outline mt-3">
                            <label class="form-label" for="uas">UAS</label>
                            <input name="uas" type="text" id="uas" class="form-control" 
                            placeholder="masukan nilai uas"/>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mt-3" value="simpan">Submit</button>
                        <button type="reset" name="reset" class="btn btn-secondary mt-3">Reset</button>
                        <a href="detail_nilai.php?kode_mk=<?=$dt['kode_mk']?>" class="btn btn-success mt-3" role="button">Detail Nilai</a>
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
