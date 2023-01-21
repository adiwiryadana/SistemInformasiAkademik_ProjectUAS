<?php

    include('../../cekadmin.php'); //menyisipkan file cekadmin.php ke dalam detail_dosen.php
    include('../../koneksi.php'); //menyisipkan file koneksi.php ke dalam detail_dosen.php (koneksi ke database)
    include('class_getNim.php'); //menyisipkan file class_getNim.php ke dalam detail_dosen.php

    $db = new koneksi();
    $koneksi = $db->getKoneksi();

    $getNim = new getNim();
    $nim = $getNim->getNim();

    $query = mysqli_query($koneksi, "SELECT dosen.nim, dosen.nama, alamat, gender, phone, email, user.username, password
    FROM dosen inner join user
    ON dosen.nim = user.nim
    WHERE dosen.nim='$nim'");
    $data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>SIAK - BIODATA DOSEN</title>
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

    <!-- Profile  -->
    <div id="main">
    <section class="jumbotron text-center">
        <img src="../../img/profile.png" alt="profile" width="200px" class="rounded-circle img-thumbnail mb-3" />
        <h1 class="display-5"><?php echo $data['nama'] ?></h1>
    </section>

    <!-- Main content -->
    <!-- User Information -->
    <section>
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">User Information</h5> 
                </div>
                <div class="card-body" >
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td style="width:20rem;">NIM/NIP</td>
                            <td><?php echo $data['nim'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td><?php echo $data['nama'] ?></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><?php echo $data['username'] ?></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><?php echo $data['password'] ?></td>
                        </tr>
                        <tr>
                            <td>Gender</th>
                            <td><?php 
                                    if($data['gender']==1) {
                                        echo "Laki - Laki"; 
                                    } else if($data['gender']==0){
                                        echo "Perempuan";
                                    }?>
                            </td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td><?php echo $data['phone'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $data['email'] ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><?php echo $data['alamat'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Update Data -->
        <div class="container d-flex justify-content-center addusr">
            <div class="card" style="width: 70rem;">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-1 mt-1">Edit User Information</h5> 
                </div>
                <div class="card-body">
                    <form action="class_upData.php" method="post">
                        <div class="mb-2">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" aria-describedby="username" value="<?php echo $data['username'] ?>">
                        </div>
                        <div class="mt-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" name="password" class="form-control" id="password" aria-describedby="password" value="<?php echo $data['password'] ?>">
                        </div>
                        <div class="mt-3">
                            <label for="phone" class="form-label">Telepon</label>
                            <input type="text" name="phone" class="form-control" id="phone" aria-describedby="phone" value="<?php echo $data['phone'] ?>">
                        </div>
                        <div class="mt-3">
                            <label for="gender" class="form-label">Gender</label> <br>
                            <input type="radio" name="gender" value ="1" <?php if ($data['gender'] =='1'){ echo "CHECKED"; }?> required/> Laki - Laki
                            &nbsp;&nbsp;&nbsp;
                            <input type="radio" name="gender" value ="0" <?php if ($data['gender'] =='0'){ echo "CHECKED"; }?> required/> Perempuan
                        </div>
                        <div class="mt-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="email" value="<?php echo $data['email'] ?>">
                        </div>
                        <div class="mt-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="alamat" aria-describedby="alamat" value="<?php echo $data['alamat'] ?>">
                        </div>
                        <input type="hidden" name="nim" value="<?php echo $data['nim']; ?>" /> 
                        <button type="submit" class="btn btn-primary mt-3" value="simpan">Submit</button>
                        <button type="reset" class="btn btn-secondary mt-3">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    </div>

    <!-- Footer -->
    <?php include "../../footer.php"?>

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
