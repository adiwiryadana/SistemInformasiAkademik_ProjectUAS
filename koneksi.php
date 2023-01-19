<?php

class koneksi {

	private $host = "localhost";
	private $user = "root";
	private $pass = "";
	private $dbname = "siak";
	private $db_connection = null;
	public $data;
	
	public function getKoneksi() {
		$this->db_connection = new mysqli($this->host, $this->user, $this->pass, $this->dbname);	
		if ($this->db_connection->connect_errno) {
			echo "Failed to connect to Database: (" . $this->db_connection->connect_errno . ") " . $this->db_connection->connect_error;
		} else {
			return $this->db_connection; 
		}
	}

	public function addUser(){
		$db = new koneksi();
		$koneksi = $db->getKoneksi();

		$data=mysqli_query($koneksi, "SELECT user.nim, user.nama, username, password, level, mahasiswa.kode_kelas FROM user left join mahasiswa on user.nim = mahasiswa.nim left join dosen on dosen.nim = user.nim
		where level='dosen' or level='mahasiswa' 
		order by mahasiswa.kode_kelas");
		while($row=mysqli_fetch_array($data)){
			$hasil[]=$row;
		}
		return $hasil;
	}
	
	public function tampilmhs(){
		$db = new koneksi();
		$koneksi = $db->getKoneksi();

		$data=mysqli_query($koneksi, "SELECT * FROM mahasiswa where nim='$_SESSION[nim]'");
		while($row=mysqli_fetch_array($data)){
			$hasil[]=$row;
		}
		return $hasil;
	}

	public function tampildsn(){
		$db = new koneksi();
		$koneksi = $db->getKoneksi();

		$data=mysqli_query($koneksi, "SELECT * FROM dosen where nim='$_SESSION[nim]'");
		while($row=mysqli_fetch_array($data)){
			$hasil[]=$row;
		}
		return $hasil;
	}

	public function jdw_dsn(){
		$db = new koneksi();
		$koneksi = $db->getKoneksi();

		$this->data=mysqli_query($koneksi, "SELECT matakuliah.kode_mk, nama_mk, jadwal.kode_kelas, hari, waktu, ruang
		FROM 
		matakuliah inner join jadwal
		ON matakuliah.kode_mk = jadwal.kode_mk
		WHERE matakuliah.nim ='$_SESSION[nim]'");
		if (mysqli_num_rows($this->data)>0) {
			while($row=mysqli_fetch_array($this->data)){
				$hasil[]=$row;
			}
			return $hasil;
		}

	}

}

?>


                
