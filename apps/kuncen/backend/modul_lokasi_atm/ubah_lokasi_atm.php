<?php
require_once('../../../../config/config.php');
require_once('../../../../auth/function_auth.php');

if(isset($_SESSION['logged_in']) && isset($_SESSION['role']))
{
    if($_SESSION['role'] != 'kuncen') {
        header("Location: ../logout.php");
    }
    if (!login_check()) {
        header("Location: ../logout.php");
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
                $id_sektor = mysqli_real_escape_string($connection, $_POST['id_sektor']);
                $nama_lokasi_atm = mysqli_real_escape_string($connection, $_POST['nama_lokasi_atm']);
                $kode_lokasi_atm = mysqli_real_escape_string($connection, $_POST['kode_lokasi_atm']);
                $kunci_fascia_atas = mysqli_real_escape_string($connection, $_POST['kunci_fascia_atas']);
                $kunci_fascia_bawah = mysqli_real_escape_string($connection, $_POST['kunci_fascia_bawah']);
                $kunci_tombak = mysqli_real_escape_string($connection, $_POST['kunci_tombak']);
                $kunci_kombinasi = mysqli_real_escape_string($connection, $_POST['kunci_tombak']);
                $kunci_casing_both = mysqli_real_escape_string($connection, $_POST['kunci_casing_both']);
                $get_by_id = "SELECT * FROM tag_lokasi_atm WHERE id='$id_lokasi_atm'";  
                $resultbyid = mysqli_query($connection,$get_by_id)or die(mysqli_error());
                $countlokasiatm = mysqli_num_rows($resultbyid);
                if($countlokasiatm > 0) {
                    $queryubahlokasiatm = "UPDATE tag_lokasi_atm SET id_sektor='$id_sektor', kode_lokasi_atm='$kode_lokasi_atm', lokasi_atm='$nama_lokasi_atm', fascia_atas='$kunci_fascia_atas', fascia_bawah='$kunci_fascia_bawah', tombak='$kunci_tombak', kombinasi='$kunci_kombinasi', casing_or_both='$kunci_casing_both' WHERE id='$id_lokasi_atm'";  
                    mysqli_query($connection, $queryubahlokasiatm);
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
