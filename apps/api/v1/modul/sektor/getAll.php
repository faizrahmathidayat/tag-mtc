<?php 
session_start();
require_once('../../../../../config/config.php');
if(!isset($_SESSION['token'])) {
    http_response_code(401);
    echo json_encode(array('status' => 'fail', 'message' => 'Unauthorized'));
} else {
    $queryAllSektor = "SELECT * FROM tag_sektor ORDER BY nama_sektor ASC";
    $resultAllSektor = mysqli_query($connection,$queryAllSektor)or die(mysqli_error());
    $rows = array();
    while($row=mysqli_fetch_assoc($resultAllSektor)) {
        $rows[] = $row;
    }
    $data = array('status' => 'success', 'data' => $rows);
    echo json_encode($data);
}
