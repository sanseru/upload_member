<?php

include 'template/header.php';
include 'koneksi.php';


?>
<main role="main" class="container">
      <div class="jumbotron">
<table>
<tr>
<table id="myTable" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nama Data</th>
                <th>Jumlah</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
<?php
$sql = "SELECT COUNT(nama_file) AS jumlah, nama_file FROM member_uni GROUP BY nama_file ORDER BY COUNT(nama_file) DESC";
$result = $conn->query($sql);
 
while ($row = $result->fetch_assoc()) :?>
    <tr>
        <td><?php echo $row['nama_file'];?></td>
        <td><?php echo $row['jumlah'];?></td>
        <td><?php echo "
                        <div class='btn-group'>
                        <a href='export.php?&tpl=$row[nama_file]'><button type='button' class='btn btn-primary btn-sm'><i class='fas fa-file-export'></i> Download</button></a>
                        </div>
                        <div class='btn-group'>
                        <a href='v_member.php?&tpl=$row[nama_file]'><button type='button' class='btn btn-primary btn-sm'><i class='fas fa-eye'></i> View</button></a>
                        </div>
                        <a class= 'hapus' href='batch_delete.php?&id=$row[nama_file]' onclick=\"javascript: return confirm(Anda yakin hapus ?);\"><button type='button' class='btn btn-primary btn-sm'><i class='fas fa-trash'></i>Hapus</button></a>
                        </div>"?>


        </td>

    </tr>
<?php endwhile;?>
</tbody>
        <tfoot>
            <tr>
            <th>Tempat Lahir</th>
            <th>Jumlah</th>
            <th>Action</th>
            </tr>
        </tfoot>
    </table>
    </div>
    </main>

 <?php   
include 'template/footer.php';
$conn->close();
?>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
<script>
    $(".hapus").click(function () {
        var jawab = confirm("Apakah Anda Yakin ingin Mengapus Data ini");
        if (jawab === true) {
//            kita set hapus false untuk mencegah duplicate request
            var hapus = false;
            if (!hapus) {
                hapus = true;
                $.post('batch_delete.php', {id: $(this).attr('data-id')},
                function (data) {
                });
                hapus = false;
            }
        } else {
            return false;
        }
    });
</script>