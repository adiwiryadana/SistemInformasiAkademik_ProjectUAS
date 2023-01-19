<?php

$error=''; 

include "koneksi.php";

$db = new koneksi();
$koneksi = $db->getKoneksi();

if(isset($_POST['submit']))
{				
	$username	= $_POST['username'];
	$password	= $_POST['password'];
	// $level		= $_POST['level'];
					
	$query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
	if(mysqli_num_rows($query) == 0)
	{
		$error = "<br><font color='red'>Username or Password is Invalid!</font>"; 
	}
	else
	{
		$row = mysqli_fetch_assoc($query);
		$_SESSION['username']=$row['username'];
		$_SESSION['level'] = $row['level'];
		$_SESSION['nama'] = $row['nama'];
		$_SESSION['nim'] = $row['nim'];
		
		if($row['level'] == "Administrator")
		{
			
			header("Location: admin/admin.php");
		}
		else if($row['level'] =="Dosen")
		{
			header("Location: dosen/dosen.php");
		}
		else if($row['level'] == "Mahasiswa")
		{
			
			header("Location: mahasiswa/mahasiswa.php");
		}
		else
		{
			$error = "Failed Login";
		}
	}
}

			
?>