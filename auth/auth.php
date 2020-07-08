<?php
require_once('function_auth.php');
require_once('../config/config.php');

 if(isset($_POST['btn-login']))
 {

  $username    = mysql_escape_string($_POST['username']);
  $password = md5($_POST['password']);
  
  $query  = "SELECT * FROM tag_pengguna WHERE username='$username' AND password='$password'";
  $result = mysqli_query($connection,$query)or die(mysqli_error());
  $num_row = mysqli_num_rows($result);
  $row     = mysqli_fetch_array($result);

  if( $num_row >=1 ) {
    if($_SESSION['Captcha'] == $_POST['captcha']) {
        login_validate();
        $_SESSION['logged_in'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        $csrf_token = bin2hex(openssl_random_pseudo_bytes(32));
        $_SESSION['csrf_token'] = $csrf_token;
        $array = [
              'status' => 'success',
              'role' => $row['role'],
              'msg' => 'success',
          ];
    } else {
        $array = [
            'status' => 'warning',
            'msg' => 'Captcha Salah.',
        ];
    }
  } else {
    $array = [
            'status' => 'error',
            'msg' => 'username atau password salah.',
        ];
  }
  echo json_encode($array);
    
 }

?>
