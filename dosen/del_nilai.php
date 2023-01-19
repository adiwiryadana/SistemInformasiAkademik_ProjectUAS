<?php 
include('../koneksi.php');
include('../admin/user panel/class_getNim.php');

class delete {
function delete(){
$db = new koneksi();
$koneksi = $db->getKoneksi();
$getNim = new getNim();
$nim = $getNim->getNim();

$sql="DELETE FROM nilai WHERE nim='$nim' ";
$hasil=mysqli_query($koneksi,$sql);
if ($hasil) {
    // echo '<script language="javascript">';
    // echo 'alert("nilai berhasil ditambahkan!")';
    // echo '</script>';
    header("Location:dosen.php");
}
else {
    // echo '<script language="javascript">';
    // echo 'alert("nilai Gagal Ditambahkan!")';
    // echo '</script>';
    header("Location:dosen.php");
}
}
}
$del = new delete();
$delete = $del->delete();


?>