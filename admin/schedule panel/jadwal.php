<?php 
// koneksi ke database
include('../../koneksi.php');
include('../../cekadmin.php');
$db = new koneksi();
$koneksi = $db->getKoneksi();
//Code ini digunakan untuk memeriksa apakah metode yang digunakan dalam permintaan (request) adalah metode POST, jika ya, maka akan mengambil nilai dari input form dengan name "kode_kelas" dan menyimpan nilai tersebut dalam variabel $kode_kelas.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_kelas = ($_POST["kode_kelas"]);
}
//Code ini digunakan untuk memeriksa apakah ada nilai yang diterima dari parameter $_GET dengan nama "kode_kelas". Jika ada, maka nilai tersebut disimpan dalam variabel $kode_kelas.
if(isset($_GET['kode_kelas'])){
    $kode_kelas = $_GET['kode_kelas'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SIAK - Jadwal</title>
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
    //query untuk menampilkan data dari 2 tabel di database 
    <?php 
        $no = 1;
        $query = 
            "SELECT matakuliah.kode_mk, nama_mk, jadwal.hari, waktu, ruang, dosen.nama
            FROM 
                matakuliah inner join jadwal
                ON matakuliah.kode_mk = jadwal.kode_mk
                inner join dosen
                ON dosen.nim = matakuliah.nim
            WHERE jadwal.kode_kelas = '$kode_kelas'
        ";
        $hasil = mysqli_query($koneksi, $query);
        
        if(mysqli_num_rows($hasil) > 0) { 
    ?>
    <!-- Jadwal kelas -->
    <div id="main">
    <section>
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Jadwal Kelas <?php echo $kode_kelas?></h5> 
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped text-center align-middle table-hover">
                        <tr class="table-secondary">
                            <th>No</th>
                            <th>Kode Matakuliah</th>
                            <th>Matakuliah</th>
                            <th>Hari</th>
                            <th>Ruang</th>
                            <th width="120px">Waktu</th>
                            <th>Dosen</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                        //Code ini digunakan untuk mengambil baris per baris dari hasil query yang dikembalikan oleh fungsi mysqli_query() dan menyimpannya dalam bentuk array. Setiap baris dari hasil query dapat diakses melalui array yang dikembalikan oleh mysqli_fetch_array().
                        <?php 
                            while ($row = mysqli_fetch_array($hasil)) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['kode_mk']; ?></td>
                            <td><?php echo $row['nama_mk']; ?></td>
                            <td><?php echo $row['hari']; ?></td>
                            <td><?php echo $row['ruang']; ?></td>
                            <td><?php echo $row['waktu']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td>
                                <a href="edit_jadwal.php?kode_kelas=<?php echo $kode_kelas;?>&kode_mk=<?php echo $row['kode_mk'];?>"><span class="badge rounded-pill text-bg-success"><i class="bi bi-pencil"></i></span></a>
                            </td>
                            <td>
                                <a href="delete_jadwal.php?kode_mk=<?php echo $row['kode_mk']; ?>&kode_kelas=<?php echo $kode_kelas;?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"><span class="badge rounded-pill text-bg-danger delete-form"><i class="bi bi-trash"></i></span></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table> 
                </div>
            </div>
        </div>
    </section>
    <?php } ?>


    <!-- Create jadwal  -->
    <section>
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Create Jadwal Kelas <?php echo $kode_kelas; ?></h5> 
                </div>
                <div class="card-body">
                    <form action="class_jadwal.php" method="post">
                        <div class="mb-1">
                            <label for="kode_mk" class="form-label">Kode Matakuliah</label>
                            <select name="kode_mk" class="form-control" id="kode_mk">
                                //query untuk menampilkan data pada tabel matakuliah dari database
                                <?php
                                    $query = "SELECT * FROM matakuliah";
                                    $hasil = mysqli_query($koneksi,$query);
                                ?>
                                <option value="">- Kode Matakuliah -</option>
                                <?php while($select=mysqli_fetch_array($hasil)) {?>
                                <option value="<?=$select['kode_mk'] ?>"><?=$select['kode_mk'] ?> - <?=$select['nama_mk'] ?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="hari" class="form-label">Hari</label>
                            <input type="text" name="hari" class="form-control" id="hari" aria-describedby="hari" required>
                        </div>
                        <div class="mt-3">
                            <label for="hari" class="form-label">Ruang</label>
                            <input type="text" name="ruang" class="form-control" id="ruang" aria-describedby="ruang" required>
                        </div>
                        <div class="mt-3">
                            <label for="waktu" class="form-label">Waktu</label>
                            <input type="text" name="waktu" class="form-control" id="waktu" aria-describedby="waktu" required>
                        </div>
                        <input type="hidden" name="kode_kelas" value="<?php echo $kode_kelas; ?>" />
                        <button type="submit" class="btn btn-primary mt-3 mb-2" value="simpan">Create</button>
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
