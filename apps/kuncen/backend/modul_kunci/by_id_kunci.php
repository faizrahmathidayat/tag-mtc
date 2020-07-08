<?php
require_once('../../../../config/config.php');
require_once('../../../../auth/function_auth.php');

if(isset($_SESSION['logged_in']) && isset($_SESSION['role']))
{
    if($_SESSION['role'] != 'kuncen') {
        header("Location: logout.php");
    }
    if (!login_check()) {
        header("Location: logout.php");
    }
}
else
{
    header("Location: ../../");
}
header('Content-Type: application/json');
$headers = apache_request_headers();
if (isset($headers['CsrfToken'])) {
    if ($headers['CsrfToken'] !== $_SESSION['csrf_token']) {
        $response = [
            'msg' => 'Wrong csrf token',
        ];
    } else {
        if(isset($_GET['id_kunci'])) {
            if($_SERVER['REQUEST_METHOD'] == 'GET') {
                $id_kunci = mysqli_real_escape_string($connection, $_GET['id_kunci']);
                $get_by_id = "SELECT * FROM tag_kunci WHERE id='$id_kunci'";  
                $resultbyid = mysqli_query($connection,$get_by_id)or die(mysqli_error());
                $countkunci = mysqli_num_rows($resultbyid);
                $rowskunci = mysqli_fetch_array($resultbyid);
                if($countkunci == 0) {
                    $response = [
                        'status' => 'error',
                        'msg' => 'data tidak ditemukan',
                    ];
                } else {
                    $response = [
                        'status' => 'success',
                        'msg' => $rowskunci['nama_kunci'],
                    ];
                }
                
            } else {
                $response = [
                    'status' => 'error',
                    'msg' => 'METHOD '.$_SERVER['REQUEST_METHOD'].' NOT ALLOWED',
                ];
            }
        } else {
            $response = [
                    'status' => 'error',
                    'msg' => 'Oops! something wrong.',
            ];
        }
    }
} else {
    $response = [
            'status' => 'error',
            'msg' => 'No Csrf Token',
    ];
}
echo json_encode($response);
?>
