<?php
//memasukkan koneksi database
require_once("koneksi.php");

//jika berhasil/ada post['id'], jika tidak ada ya tidak dijalankan
if($_POST['id']){
	//membuat variabel id berisi post['id']
	$id = $_POST['id'];
	//query standart select where id
	$view = $conn->query("SELECT * FROM member_uni WHERE id_member='$id'");
	//jika ada datanya
	if($view->num_rows){
		//fetch data ke dalam veriabel $row_view
        $row_view = $view->fetch_assoc();
        $benefit = $row_view['ip'] . ' ' . $row_view['op'] . ' ' .$row_view['de'] . ' ' . $row_view['eg'] . ' ' . $row_view['ma'] . ' ' . $row_view['mcu'] . ' ' . $row_view['ot'];
        //menampilkan data dengan table

        if($row_view['sfx'] == 'A'){
            echo $sufix = 'KARYAWAN';
        }elseif($row_view['sfx'] == 'B'){
            echo $sufix = 'PASANGAN';
        }else{
            echo $sufix = 'ANAK';
        };

		echo '
		<p>Berikut ini adalah detail dari data Member Unilver <b>'.$row_view['nama_member'].'</b></p>
		<table class="table table-bordered">
			<tr>
				<th>Nama</th>
                <td>'.$row_view['nama_member'].' <font color="red"> <b>[' .$sufix .' ]</b></font></td>
                <th>NIK</th>
                <td>'.$row_view['nik'].'</td>
                <th>Job Position</th>
				<td>'.$row_view['department'].'</td>
			</tr>
			<tr>
				<th>Tanggal Lahir</th>
                <td>'.$row_view['tgl_lahir'].'</td>
                <th>Jenis Kelamin</th>
                <td>'.$row_view['sex'].'</td>
                <th>Status</th>
				<td>'.($row_view['status']== 'A' ? 'Aktif' : 'Tidak Aktif').'</td>
			</tr>
			<tr>
				<th>Benefit</th>
                <td>'.$benefit.'</td>
                <th>Nama Karyawan</th>
                <td>'.$row_view['nama_karyawan'].'</td>
                <th>Email</th>
				<td>'.$row_view['email'].'</td>
            </tr>
            <tr>
            <th>Bank</th>
            <td>'.$row_view['bank'].'</td>
            <th>No Rekening</th>
            <td>'.$row_view['no_rek'].'</td>
            <th>A. Nama</th>
            <td>'.$row_view['name_bank'].'</td>
        </tr>
		</table>
		';
	}
}
?>