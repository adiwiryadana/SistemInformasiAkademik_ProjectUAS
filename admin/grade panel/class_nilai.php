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

<html>
    <head>
        <title>SIAK - NILAI</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="../../style.css">
    </head>

    <body>
        <!-- Navbar  -->
        <nav class="navbar navbar-expand-lg navbar-dark shadow-lg sticky-top bg-dark mb-5">
            <div class="container">
                <a class="navbar-brand" href="../admin.php">SISTEM INFORMASI AKADEMIK</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="navbar-brand fs-6">
                            <?php 
                            date_default_timezone_set('Asia/Kuala_Lumpur');
                            echo "Welcome " . $_SESSION['username'];
                            echo date(' |  H:i:s');
                        ?>
                    </li>
                    <li class="navbar-brand fs-6">
                        <a href="../../logout.php"><img src="../../img/logout.png" alt="logout" width="20px" class="logout"> Logout</a>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- list nilai  -->
        <?php 
        $query = "SELECT nilai.kode_mk, matakuliah.nama_mk, uas, uts, tugas, kuis
        FROM nilai inner join matakuliah 
        ON nilai.kode_mk = matakuliah.kode_mk
        WHERE nilai.nim='$nilaiObj->nim'";

        $sql = mysqli_query($koneksi, $query);
        if(mysqli_num_rows($sql) > 0) { 
        ?>
        <section>
        <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">LIST NILAI - <?php echo $nilaiObj->nim; ?></h5> 
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped text-center align-middle table-hover">
                            <tr class="table-secondary"> 
                                <th rowspan="2" width="50px">NO.</th>
                                <th rowspan="2">KODE MATAKULIAH</th>
                                <th rowspan="2">NAMA MATAKULIAH</th>
                                <th colspan="4">NILAI</th>
                                <th colspan="2" rowspan="2">AKSI</th>
                            </tr>
                            <tr class="table-secondary"> 
                                <th>UAS</th>
                                <th>UTS</th>
                                <th>KUIS</th>
                                <th>TUGAS</th>
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
                                <td>
                                    <a href="edit_nilai.php?kode_mk=<?php echo $row['kode_mk'];?>&nim=<?php echo $nilaiObj->nim;?>"><img src="../../img/update.png" alt="update" class="detail"></a>
                                </td>

                                <td>
                                <a href="class_delete.php?kode_mk=<?php echo $row['kode_mk'];?>&nim=<?php echo $nilaiObj->nim;?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"><img src="../../img/delete.png" alt="delete" class="detail"></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>


        <!-- insert nilai  -->
        <section>
            <div class="container d-flex justify-content-center addusr">
                <div class="card" style="width: 70rem;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-2">INSERT NILAI - <?php echo $nilaiObj->nim; ?></h5> 
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
                            <div class="mb-1">
                                <label for="uas" class="form-label">UAS</label>
                                <input type="text" name="uas" class="form-control" id="uas" aria-describedby="uas" required>
                            </div>
                            <div class="mb-1">
                                <label for="uts" class="form-label">UTS</label>
                                <input type="text" name="uts" class="form-control" id="uts" aria-describedby="uts" required>
                            </div>
                            <div class="mb-1">
                                <label for="kuis" class="form-label">KUIS</label>
                                <input type="text" name="kuis" class="form-control" id="kuis" aria-describedby="kuis" required>
                            </div>
                            <div class="mb-3">
                                <label for="tugas" class="form-label">TUGAS</label>
                                <input type="text" name="tugas" class="form-control" id="tugas" aria-describedby="tugas" required>
                            </div>
                            <input type="hidden" name="nim" value="<?php echo $nilaiObj->nim; ?>" /> 
                            <button type="submit" class="btn btn-primary" value="simpan">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </form>
                    </div>
                </div>  
            </div>
        </section>
    </body>
</html>