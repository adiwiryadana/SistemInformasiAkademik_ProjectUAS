<?php
include('../../koneksi.php');
include('../../cekadmin.php');
$db = new koneksi();
$koneksi = $db->getKoneksi();

class nilai {
    public $nim;

    public function  __construct(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->nim = ($_POST["nim"]);
        } else {
            if(isset($_GET['nim'])){
                $this->nim = $_GET['nim'];
            }
        }
    }
}
$nilaiObj = new nilai();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>SIAK - NILAI</title>
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
    <?php 
    $query = "SELECT nilai.kode_mk, matakuliah.nama_mk, uas, uts, tugas, kuis, rata_rata, nilai_akhir
    FROM nilai inner join matakuliah 
    ON nilai.kode_mk = matakuliah.kode_mk
    WHERE nilai.nim='$nilaiObj->nim'";

    $sql = mysqli_query($koneksi, $query);
    if(mysqli_num_rows($sql) > 0) { 
    ?>

    <!-- List Nilai -->
    <div id="main">
    <section>
    <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">List Nilai - <?php echo $nilaiObj->nim; ?></h5> 
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped text-center align-middle table-hover">
                        <tr class="table-secondary"> 
                            <th rowspan="2" width="50px">No</th>
                            <th rowspan="2">Kode Matakuliah</th>
                            <th rowspan="2">Nama Matakuliah</th>
                            <th colspan="4">Nilai</th>
                            <th rowspan="2">Rata - Rata</th>
                            <th rowspan="2">Nilai Akhir</th>
                            <th colspan="2" rowspan="2">Aksi</th>
                        </tr>
                        <tr class="table-secondary"> 
                            <th>UAS</th>
                            <th>UTS</th>
                            <th>Kuis</th>
                            <th>Tugas</th>
                        </tr>
                        
                        <?php 
                        $no=1;
                        while ($row = mysqli_fetch_array($sql)) { ?>
                        <tr>
                            <td><?php echo $no++?></td>
                            <td><?php echo $row['kode_mk'];?></td>
                            <td><?php echo $row['nama_mk'];?></td>
                            <td><?php echo $row['uas'];?></td>
                            <td><?php echo $row['uts'];?></td>
                            <td><?php echo $row['kuis'];?></td>
                            <td><?php echo $row['tugas'];?></td>
                            <td><?php echo $row['rata_rata'];?></td>
                            <td><?php echo $row['nilai_akhir'];?></td>
                            <td>
                                <a href="edit_nilai.php?kode_mk=<?php echo $row['kode_mk'];?>&nim=<?php echo $nilaiObj->nim;?>"><span class="badge rounded-pill text-bg-success"><i class="bi bi-pencil"></i></span></a>
                            </td>

                            <td>
                            <a href="class_delete.php?kode_mk=<?php echo $row['kode_mk'];?>&nim=<?php echo $nilaiObj->nim;?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"><span class="badge rounded-pill text-bg-danger delete-form"><i class="bi bi-trash"></i></span></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <!-- Insert nilai  -->
    <section id="insert_nilai">
        <div class="container d-flex justify-content-center addusr mt-2">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Insert Nilai - <?php echo $nilaiObj->nim; ?></h5> 
                </div>
                <div class="card-body">
                    <form action="class_addNilai.php" method="post">
                        <div class="mb-1">
                            <label for="kode_mk" class="form-label">Kode Matakuliah</label>
                            <select name="kode_mk" class="form-control" id="kode_mk">
                                <?php
                                    $query = "SELECT matakuliah.kode_mk, nama_mk, jadwal.kode_kelas 
                                        FROM matakuliah INNER JOIN jadwal
                                            ON matakuliah.kode_mk = jadwal.kode_mk
                                            INNER JOIN mahasiswa
                                            ON jadwal.kode_kelas = mahasiswa.kode_kelas
                                            WHERE mahasiswa.nim = '$nilaiObj->nim'
                                    ";
                                    $hasil = mysqli_query($koneksi,$query);
                                ?>
                                <option value="">Pilih Matakuliah</option>
                                <?php while($select=mysqli_fetch_array($hasil)) {?>
                                <option value="<?=$select['kode_mk'] ?>"><?=$select['kode_mk'] ?> - <?=$select['nama_mk'] ?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="uas" class="form-label">UAS</label>
                            <input type="text" name="uas" class="form-control" id="uas" aria-describedby="uas" required>
                        </div>
                        <div class="mt-3">
                            <label for="uts" class="form-label">UTS</label>
                            <input type="text" name="uts" class="form-control" id="uts" aria-describedby="uts" required>
                        </div>
                        <div class="mt-3">
                            <label for="kuis" class="form-label">Kuis</label>
                            <input type="text" name="kuis" class="form-control" id="kuis" aria-describedby="kuis" required>
                        </div>
                        <div class="mt-3">
                            <label for="tugas" class="form-label">Tugas</label>
                            <input type="text" name="tugas" class="form-control" id="tugas" aria-describedby="tugas" required>
                        </div>
                        <input type="hidden" name="nim" value="<?php echo $nilaiObj->nim; ?>" /> 
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