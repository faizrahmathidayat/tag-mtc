<?php 
require_once('../../../../../config/config.php');
$getkunci = "SELECT * FROM tag_kunci ORDER BY nama_kunci ASC";
$resultkunci = mysqli_query($connection,$getkunci)or die(mysqli_error());
while($row=mysqli_fetch_assoc($resultkunci)) {
    $data[] = $row;
}
$array = array('status' => 'success', 'data' => $data);
echo json_encode($array);
