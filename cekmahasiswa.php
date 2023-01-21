<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['username'])){
    die("Anda belum login");
	
}

//cek level user mahasiswa
if($_SESSION['level']!="Mahasiswa"){
    die("Anda bukan Mahasiswa");
}
?>
