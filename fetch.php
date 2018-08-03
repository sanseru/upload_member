<?php
//fetch.php
if(isset($_POST["tempat_lahir"]))
{
 $connect = mysqli_connect("localhost", "root", "", "belajar");
 $output = '';
 $query = "select*from pegawai where tempat_lahir = '".$_POST["tempat_lahir"]."'";
 $result = mysqli_query($connect, $query);
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
  <h2>'.$row["nama"].'</h2>
  <p><label>Author By - '.$row["tempat_lahir"].'</label></p>
  <p>'.$row["post_description"].'</p>
  ';
  $query_1 = "SELECT post_id FROM tbl_posts WHERE post_id < '".$_POST['post_id']."' ORDER BY post_id DESC LIMIT 1";
  $result_1 = mysqli_query($connect, $query_1);
  $data_1 = mysqli_fetch_assoc($result_1);
  $query_2 = "SELECT post_id FROM tbl_posts WHERE post_id > '".$_POST['post_id']."' ORDER BY post_id ASC LIMIT 1";
  $result_2 = mysqli_query($connect, $query_2);
  $data_2 = mysqli_fetch_assoc($result_2);
  $if_previous_disable = '';
  $if_next_disable = '';
  if($data_1["post_id"] == "")
  {
   $if_previous_disable = 'disabled';
  }
  if($data_2["post_id"] == "")
  {
   $if_next_disable = 'disabled';
  }
  $output .= '
  <br /><br />
  <div align="center">
   <button type="button" name="previous" class="btn btn-warning btn-sm previous" id="'.$data_1["post_id"].'" '.$if_previous_disable.'>Previous</button>
   <button type="button" name="next" class="btn btn-warning btn-sm next" id="'.$data_2["post_id"].'" '.$if_next_disable.'>Next</button>
  </div>
  <br /><br />
  ';
 }
 echo $output;
}

?>