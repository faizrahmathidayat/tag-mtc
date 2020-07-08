<?php
require_once('../../../config/config.php');
require_once('jwt.php');
// GET REQUEST BODY
$json = file_get_contents("php://input");
$data = json_decode($json);
//END GET REQUEST

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($data->username == '' && $data->password == '') {
        http_response_code(400);
        $array = [
                    'status' => 'fail',
                    'message' => 'username dan Password tidak boleh kosong'
                ];
        echo json_encode($array);
        exit;
    }
    if($data->password == '') {
        http_response_code(400);
        $array = [
                    'status' => 'fail',
                    'message' => 'Password tidak boleh kosong'
                ];
        echo json_encode($array);
        exit;
    }
    if($data->username == '') {
        http_response_code(400);
        $array = [
                    'status' => 'fail',
                    'message' => 'username tidak boleh kosong'
                ];
        echo json_encode($array);
        exit;
    }

    $username = mysqli_real_escape_string($connection, $data->username);
    $password = md5($data->password);
    $query  = "SELECT * FROM tag_pengguna WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connection,$query)or die(mysqli_error());
    $num_row = mysqli_num_rows($result);
    $row     = mysqli_fetch_assoc($result);

    if($num_row >=1) {
        // GENERATE_JWT TOKEN
        $jwt_encode = json_encode(TokenJwt($row['id'],$row['nama']));
        $jwt_decode = json_decode($jwt_encode, true);
        // END GENERATE
        http_response_code(200);
        // $array = [
        //             'status' => 'success',
        //             'nama' => $row['nama'],
        //             'user_id' => intval($row['id_user']),
        //             'token' => $jwt_decode['token'],
        //             'exp' => $jwt_decode['exp']
        //         ];
        $array = array('status' => 'success', 'data' => array(
                                                        ['nama'=>$row['nama'],
                                                        'id_user'=>intval($row['id']),
                                                        'role'=>$row['role'],
                                                        'token'=>$jwt_decode['token'],
                                                        'exp'=>$jwt_decode['exp']],
                                                        ));
        session_start();
        $_SESSION['logged_in'] = $row['id'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['token'] = $jwt_decode['token'];
        echo json_encode($array);
        exit();
    } else {
        http_response_code(400);
        $array = [
                    'status' => 'fail',
                    'message' => 'Username atau Password Salah'
                ];
        echo json_encode($array);
    }
} else {
    http_response_code(405);
    echo json_encode(array('status'=> 'fail', 'message'=>'method '.$_SERVER['REQUEST_METHOD'].' not allowed'));
}
