<?php
include 'template/header.php';
//memasukkan koneksi database
require_once("koneksi.php");
$id = $_GET['tpl'];
?>
<main role="main" class="container">
      <div class="jumbotron">
<table>
<tr>
<table id="myTable" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No Karyawan</th>
                <th>Nama Member</th>
                <th>Tanggal Lahir</th>
                <th>Department</th>
                <th>Lokasi</th>

                <th>Action</th>
        </tr>
        </thead>
        <tbody>
<?php
$sql = "select*from member_uni where nama_file = '$id'";
$result = $conn->query($sql);
 
if (!empty($result)) { 
    foreach($result as $row) {
    $tgl_lahir = DateTime::createFromFormat('Y-m-d',$row['tgl_lahir']);
    $ftgl_lahir = $tgl_lahir->format('d-m-Y');
    ?>
    <tr>
        <td><?php echo $row['nik'];?></td>
        <td><?php echo $row['nama_member'];?></td>
        <td><?php echo $ftgl_lahir;?></td>
        <td><?php echo $row['department'];?></td>
        <td><?php echo $row['job_position'];?></td>
       <td> <?php echo "<button type='button' class='view_data btn btn-primary btn-xs' data-toggle='modal' id='$row[id_member]' data-target='#myModal'>Lihat data</button>"; ?> </td>   </tr>
    <?php }}?>
</tbody>
        <tfoot>
            <tr>
                <th>No Karyawan</th>
                <th>Nama Member</th>
                <th>Tanggal Lahir</th>
                <th>Department</th>
                <th>Lokasi</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
    </div>

    </main>


    <!-- memulai modal nya. pada id="$myModal" harus sama dengan data-target="#myModal" pada tombol di atas -->
	<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mmyLargeModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Data Member Unilever</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<!-- memulai untuk konten dinamis -->
				<!-- lihat id="data_siswa", ini yang di pangging pada ajax di bawah -->
				<div class="modal-body" id="data_siswa">
				</div>
				<!-- selesai konten dinamis -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    <?php   
include 'template/footer.php';
$conn->close();
?>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
$(document).ready(function(){
    $("body").on('click', '.view_data',function(){
		// yang bawah ini bekerja jika tombol lihat data (class="view_data") di klik
		// $('.view_data').on('click',function(){
			// membuat variabel id, nilainya dari attribut id pada button
			// id="'.$row['id'].'" -> data id dari database ya sob, jadi dinamis nanti id nya
			var id = $(this).attr("id");
            // var id = $(this).closest('td').attr("id")
            // var id = table.row( this ).id();

			
			// memulai ajax
			$.ajax({
				url: 'detail.php',	// set url -> ini file yang menyimpan query tampil detail data siswa
				method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
				data: {id:id},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
				success:function(data){		// kode dibawah ini jalan kalau sukses
					$('#data_siswa').html(data);	// mengisi konten dari -> <div class="modal-body" id="data_siswa">
					$('#myModal').modal("show");	// menampilkan dialog modal nya
				}
			});
		});
        
	});

</script> 
