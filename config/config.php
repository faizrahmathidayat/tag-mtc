<?php
define("BASE_URL", "http://localhost/template/tag/");
$hostname = "localhost";
$username = "root";
$password = '';
$database = "tag";
//create variable connectin
$connection = mysqli_connect($hostname, $username, $password, $database);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
