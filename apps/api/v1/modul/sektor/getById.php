<?php 
session_start();
require_once('../../../../../config/config.php');
if(!isset($_SESSION['token'])) {
    http_response_code(401);
    echo json_encode(array('status' => 'fail', 'message' => 'Unauthorized'));
} else {
    $id= mysqli_real_escape_string($connection, $_GET['id']);
    $query_get_sektor = "SELECT * FROM tag_sektor WHERE id='$id'";
    $execute_row_sektor = mysqli_query($connection, $query_get_sektor)or die(mysqli_error());
    $countsektor = mysqli_num_rows($execute_row_sektor);
    $rows_sektor = mysqli_fetch_assoc($execute_row_sektor);
    if($countsektor > 0) {
        $data[] = array('id' => intval($rows_sektor['id']),'nama_sektor' => $rows_sektor['nama_sektor']);
        $data =array('status' => 'success', 'data' =>$data);
    } else {
        http_response_code(404);
        $data = array('status' => 'fail', 'data' => []);
    }
    echo json_encode($data);
}
