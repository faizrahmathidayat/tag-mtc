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
        if(isset($_GET['id_lokasi_atm'])) {
            if($_SERVER['REQUEST_METHOD'] == 'GET') {
                $id_lokasi_atm = mysqli_real_escape_string($connection, $_GET['id_lokasi_atm']);
                $get_by_id = "SELECT a.id as id_sektor, a.nama_sektor, b.id as id_lokasi_atm, b.kode_lokasi_atm, b.lokasi_atm, b.fascia_atas, b.fascia_bawah, b.tombak, b.kombinasi, b.casing_or_both FROM tag_sektor a JOIN tag_lokasi_atm b ON a.id = b.id_sektor WHERE b.id='$id_lokasi_atm'";  
                $resultbyid = mysqli_query($connection,$get_by_id)or die(mysqli_error());
                $countlokasi_atm = mysqli_num_rows($resultbyid);
                $rowslokasi_atm = mysqli_fetch_array($resultbyid);
                $rows[] = $rowslokasi_atm;
                if($countlokasi_atm == 0) {
                    $response = [
                        'status' => 'error',
                        'msg' => 'data tidak ditemukan',
                    ];
                } else {
                    $response = [
                        'status' => 'success',
                        'msg' => $rows,
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
