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
        if(isset($_POST['nama_kunci'])) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nama_kunci = mysqli_real_escape_string($connection, $_POST['nama_kunci']);
                $get_by_id = "SELECT * FROM tag_kunci WHERE nama_kunci='$nama_kunci'";  
                $resultbyid = mysqli_query($connection,$get_by_id)or die(mysqli_error());
                $countkunci = mysqli_num_rows($resultbyid);
                if($countkunci == 0) {
                    $queryinsertkunci = "INSERT INTO tag_kunci(nama_kunci)VALUES('$_POST[nama_kunci]');";  
                    mysqli_query($connection, $queryinsertkunci);
                    $response = [
                        'msg' => 'success',
                    ];
                } else {
                    $response = [
                        'msg' => 'Nama kunci Sudah ada!',
                    ];
                }
                
            } else {
                $response = [
                    'msg' => 'Action Invalid / METHOD '.$_SERVER['REQUEST_METHOD'].' NOT ALLOWED',
                ];
            }
        } else {
            $response = [
                    'msg' => 'Oops! something wrong.',
            ];
        }
    }
} else {
    $response = [
            'msg' => 'No Csrf Token',
    ];
}
echo json_encode($response);
?>
