<?php
include 'koneksi.php';
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=member_export.xls");
$tpl= ($_GET['tpl']);

?>
<h3>DATA UNILEVER</h3>
    
<table border="1" cellpadding="5">
  <tr>
    <th>No</th>
    <th>NIS</th>
    <th>Nama</th>
    <th>Jenis Kelamin</th>
  </tr>
  <?php
  // Load file koneksi.php
  include 'koneksi.php';

  // Buat query untuk menampilkan semua data siswa
    $sql = mysqli_query($conn, "SELECT * FROM pegawai where tempat_lahir = '$tpl'");
    if (!$sql) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
  $no = 1; // Untuk penomoran tabel, di awal set dengan 1
  while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
    echo "<tr>";
    echo "<td>".$no."</td>";
    echo "<td>".$data['nama']."</td>";
    echo "<td>".$data['tempat_lahir']."</td>";
    echo "<td>".$data['tanggal_lahir']."</td>";
    echo "</tr>";
    
    $no++; // Tambah 1 setiap kali looping
  }
  ?>
</table>