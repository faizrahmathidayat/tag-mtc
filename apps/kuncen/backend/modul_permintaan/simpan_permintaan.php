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
        if(isset($_POST['nama_sektor'])) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nama_sektor = mysqli_real_escape_string($connection, $_POST['nama_sektor']);
                $get_by_id = "SELECT * FROM tag_sektor WHERE nama_sektor='$nama_sektor'";  
                $resultbyid = mysqli_query($connection,$get_by_id)or die(mysqli_error());
                $countsektor = mysqli_num_rows($resultbyid);
                if($countsektor == 0) {
                    $queryinsertsektor = "INSERT INTO tag_sektor(nama_sektor)VALUES('$_POST[nama_sektor]');";  
                    mysqli_query($connection, $queryinsertsektor);
                    $response = [
                        'msg' => 'success',
                    ];
                } else {
                    $response = [
                        'msg' => 'Nama Sektor Sudah ada!',
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
