<?php

session_start();
if($_SESSION){
	if($_SESSION['level']=="Administrator")
	{
		header("Location: admin/admin.php");
	}
	if($_SESSION['level']=="Dosen")
	{
		header("Location: dosen/dosen.php");
	}
	if($_SESSION['level']=="Mahasiswa")
	{
		header("Location: mahasiswa/mahasiswa.php");
	}
}
include('login.php');  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"    
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="style.css">
        <title>SIAK</title>
    </head>

    <body style="background-color: hsl(0, 0%, 96%);">
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-8">
              <div class="card" style="border-radius: 0; border-color: white;">
                <div class="row">
                  <div class="col-md-5 align-items-center">
                    <img src="img/SIAK.png" alt="" width="280px" style="margin-left: 3rem; margin-top: 2rem;"/>
                  </div>
                  <div class="col-md-6 col-lg-7 align-items-center">
                    <div class="card-body p-4 p-lg-5">
                      <form role="form" method="post">
                        <div class="form-outline mb-3">
                            <label class="form-label" for="username">Username</label>
                            <input name="username" type="text" id="username" class="form-control form-control-lg"/>
                        </div>
                        <div class="form-outline mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input name="password" type="password" id="password" autocomplete="current-password" 
                            class="form-control form-control-lg"/>
                            <div style="position:relative;">
                            <span class="eye d-flex" onclick="showPassword()" style="right:5%; position:absolute; transform: translateY(-200%);">
                                <i id="hide1" class="fa-solid fa-eye"></i>
                                <i id="hide2" class="fa-solid fa-eye-slash"></i>
                            </span>
                            </div>
                        </div>
                        <div class="text-center text-lg-start mt-2 pt-2">
                            <button name="submit" type="submit" class="btn btn-dark text-center">Login</button>
                        </div>
                        <?php echo $error; ?>
                      </form>
                    </div>
                  </div>
                </div>
                <p class="card-text text-center mt-2 mb-4"><small class="text-muted">INERSYSUNIVERSITY &#169;<?php 
                    echo date("Y");?> All rights reserved.</small></p>
              </div>
            </div>
          </div>
        </div>
        <script>
          function showPassword() {
            var x = document.getElementById("password");
            var y = document.getElementById("hide1");
            var z = document.getElementById("hide2");

            if(x.type === 'password') {
                x.type = "text";
                y.style.display = "block";
                z.style.display = "none";
            }
            else{
                x.type = "password";
                y.style.display = "none";
                z.style.display = "block";
            }
          }
        </script>
      </section>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>