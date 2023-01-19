<?php 
include('../../koneksi.php');
include('class_getNim.php');

class delete {

    function delete(){
        $db = new koneksi();
        $koneksi = $db->getKoneksi();

        $getNim = new getNim();
        $Nim = $getNim->getNim();
        
        $sqlUser = "SELECT * FROM user where nim='$Nim'";

        $cek = mysqli_query($koneksi,$sqlUser);
        $data = mysqli_fetch_assoc($cek);
        if($data['level'] == "Mahasiswa") 
        {
            $sql_mhs = "DELETE FROM mahasiswa WHERE nim='$Nim' ";
            $hasil = mysqli_query($koneksi,$sql_mhs);

            if ($hasil) {
                $sql_Usr = "DELETE FROM user WHERE nim='$Nim' ";
                $delete = mysqli_query($koneksi,$sql_Usr);

                echo "<script>
                        alert('Data Berhasil Dihapus!');
                    </script>";
                    header("Location:users_list.php");
            }

        } else if($data['level'] == "Dosen"){
            $sql_dosen = "DELETE FROM dosen WHERE nim='$Nim' ";
            $hasil = mysqli_query($koneksi,$sql_dosen);

            if ($hasil) {
                $sql_Usr = "DELETE FROM user WHERE nim='$Nim' ";
                $delete = mysqli_query($koneksi,$sql_Usr);
                echo "<script>
                        alert('Data Berhasil Dihapus!');
                    </script>";
                    header("Location:users_list.php");
                }
        }

    }
}

$del = new delete();
$delete = $del->delete();


    // $db = new koneksi();
    // $koneksi = $db->getKoneksi();

    // $getNim = new getNim();
    // $Nim = $getNim->getNim();
        
    // $sqlUser = "SELECT * FROM user where nim='$Nim'";

    // $cek = mysqli_query($koneksi,$sqlUser);
    // $data = mysqli_fetch_assoc($cek);


    // if($data['level'] == "Mahasiswa") 
    //     {
    //         $sql_mhs = "DELETE FROM mahasiswa WHERE nim='$Nim' ";
    //         $hasil = mysqli_query($koneksi,$sql_mhs);

    //         if ($hasil) {
    //             $sql_Usr = "DELETE FROM user WHERE nim='$Nim' ";
    //             $delete = mysqli_query($koneksi,$sql_Usr);

    //             echo "<script>
    //                     alert('Data Berhasil Dihapus!');
    //                 </script>";
    //                 header("Location:admin/users_list.php");
    //             }
    //             else {
    //             echo "<script>
    //                     alert('Data Gagal Dihapus!');
    //                 </script>";
    //                 header("Location:admin/wa.php");
    //             }

    //     } else if($data['level'] == "Dosen"){
    //         $sql_dosen = "DELETE FROM dosen WHERE nim='$Nim' ";
    //         $hasil = mysqli_query($koneksi,$sql_dosen);

    //         if ($hasil) {
    //             $sql_Usr = "DELETE FROM user WHERE nim='$Nim' ";
    //             $delete = mysqli_query($koneksi,$sql_Usr);
    //             echo "<script>
    //                     alert('Data Berhasil Dihapus!');
    //                 </script>";
    //                 header("Location:admin/users_list.php");
    //             }
    //             else {
    //             echo "<script>
    //                     alert('Data Gagal Dihapus!');
    //                 </script>";
    //                 header("Location:admin/wa.php");
    //             }
    //     }
            
            
                
            
?>