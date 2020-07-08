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
        if(isset($_POST['id_lokasi_atm'])) {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id_lokasi_atm = mysqli_real_escape_string($connection, $_POST['id_lokasi_atm']);
                $get_by_id = "SELECT * FROM tag_lokasi_atm WHERE id='$id_lokasi_atm'";  
                $resultbyid = mysqli_query($connection,$get_by_id)or die(mysqli_error());
                $countlokasi_atm = mysqli_num_rows($resultbyid);
                if($countlokasi_atm > 0) {
                    $queryhapuslokasi_atm = "DELETE FROM tag_lokasi_atm WHERE id = '$id_lokasi_atm'";  
                    mysqli_query($connection, $queryhapuslokasi_atm);
                    $response = [
                        'msg' => 'success',
                    ];
                } else {
                    $response = [
                        'msg' => 'data tidak ditemukan!',
                    ];
                }
            } else {
                $response = [
                    'msg' => 'METHOD '.$_SERVER['REQUEST_METHOD'].' NOT ALLOWED',
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
