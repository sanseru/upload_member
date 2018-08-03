<?php
$current = 'upload';
include 'template/header.php';
 //koneksi ke database, username,password  dan namadatabase menyesuaikan 
mysql_connect('localhost', 'root', '');
mysql_select_db('belajar');

//memanggil file excel_reader
require "excel_reader.php";

//jika tombol import ditekan
if(isset($_POST['submit'])){

    $target = basename($_FILES['filepegawaiall']['name']) ;
    move_uploaded_file($_FILES['filepegawaiall']['tmp_name'], $target);
    
    $data = new Spreadsheet_Excel_Reader($_FILES['filepegawaiall']['name'],false);
    
//    menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index=0);
    
//    jika kosongkan data dicentang jalankan kode berikut
    $drop = isset( $_POST["drop"] ) ? $_POST["drop"] : 0 ;
    if($drop == 1){
//             kosongkan tabel pegawai
             $truncate ="TRUNCATE TABLE pegawai";
             mysql_query($truncate);
    };
    
//    import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
    for ($i=2; $i<=$baris; $i++)
    {
//       membaca data (kolom ke-1 sd terakhir)
      $nik           = $data->val($i, 1);
      $no_kartu   = $data->val($i, 2);
      $nama_member  = $data->val($i, 3);
      $tgl_lahir  = $data->val($i, 4);
      $sex  = $data->val($i, 5);
      $sfx  = $data->val($i, 6);
      $start  = $data->val($i, 7);
      $end  = $data->val($i, 8);
      $ip  = $data->val($i, 9);
      $op  = $data->val($i, 10);
      $de  = $data->val($i, 11);
      $eg  = $data->val($i, 12);
      $ma  = $data->val($i, 13);
      $mcu  = $data->val($i, 14);
      $ot  = $data->val($i, 15);
      $department  = $data->val($i, 16);
      $job_position  = $data->val($i, 17);
      $bank  = $data->val($i, 18);
      $cab_bank  = $data->val($i, 19);
      $name_bank = $data->val($i, 20);
      $no_rek  = $data->val($i, 21);
      $email  = $data->val($i, 22);
      $vip  = $data->val($i,23);
      $status  = $data->val($i, 24);
      $keterangan  = $data->val($i, 25);
      $tgl_efective  = $data->val($i, 26);
      $nama_karyawan  = $data->val($i, 27);
      //Mengambil Nama File
      $nama_file=substr($target,0,-4);
  
      $end        = date('Y-m-d',strtotime($end));


//      setelah data dibaca, masukkan ke tabel pegawai sql
      $query = "INSERT INTO `member_uni`(`nik`, `no_kartu`, `nama_member`, `tgl_lahir`, `sex`, `sfx`, `start`, `end`, `ip`, `op`, `de`, `eg`, `ma`, `mcu`, `ot`, `department`, `job_position`, `bank`, `cab_bank`, `name_bank`, `no_rek`, `email`, `vip`, `status`, `nama_karyawan`, `nama_file`, `keterangan`, `tgl_efective`) VALUES
                                        ('$nik','$no_kartu','$nama_member','$tgl_lahir','$sex','$sfx','$start','$end','$ip','$op','$de','$eg','$ma','$mcu','$ot','$department','$job_position','$bank','$cab_bank','$name_bank','$no_rek','$email','$vip','$status','$nama_karyawan','$nama_file','$keterangan','$tgl_efective')";
      $hasil = mysql_query($query);
    }
    

    if(!$hasil){
//          jika import gagal
          die(mysql_error());
      }else{
//          jika impor berhasil

            echo "<div class='alert alert-primary' role='alert'> Berhasil di Upload </div>'";
    }
    
//    hapus file xls yang udah dibaca
    unlink($_FILES['filepegawaiall']['name']);
}
?>   
<main role="main" class="container">
      <div class="jumbotron">
      <form name="myForm" id="myForm" onSubmit="return validateForm()" action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" id="filepegawaiall" name="filepegawaiall" />
    <input type="submit" name="submit" value="Import" /><br/>
    <label><input type="checkbox" name="drop" value="1" /> <u>Kosongkan tabel sql terlebih dahulu.</u> </label>
</form>
      </div>
    </main>
    <script type="text/javascript">
//    validasi form (hanya file .xls yang diijinkan)
    function validateForm()
    {
        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }

        if(!hasExtension('filepegawaiall', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>
 <?php   
include 'template/footer.php'
?>

