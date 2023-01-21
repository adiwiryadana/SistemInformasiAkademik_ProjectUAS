<?php 
// koneksi ke database
include('../koneksi.php');
include('../admin/user panel/class_getNim.php');

//fungsi untuk delete
class delete {
function delete(){
$db = new koneksi();
$koneksi = $db->getKoneksi();
$getNim = new getNim();
$nim = $getNim->getNim();

//query delete pada tabel nilai
$sql="DELETE FROM nilai WHERE nim='$nim' ";

// mengeksekusi query diatas dan mengecek apakah query berhasil dilakukan
$hasil=mysqli_query($koneksi,$sql);
if ($hasil) {
    header("Location:dosen.php");
}
else {
    header("Location:dosen.php");
}
}
}
$del = new delete();
$delete = $del->delete();


?>
