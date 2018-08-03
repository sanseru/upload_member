
<?php
 
// $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
// if ($id <> '') {
// //    jalankan perintah hapus data
//    mysql_query("DELETE FROM tabel WHERE id='$id'");
//     echo 'data dengan id = '.$id.' berhasil dihapus';
// }


$host="localhost";
$user="root";
$pass="";
$database="belajar";
$koneksi=new mysqli($host,$user,$pass,$database);
if (mysqli_connect_errno()) {
   trigger_error('Koneksi ke database gagal: '  . mysqli_connect_error(), E_USER_ERROR); 
}
$modal_id=$_GET['id'];
$modal=mysqli_query($koneksi,"Delete FROM member_uni WHERE nama_file='$modal_id'");
header('location:index.php');
?>