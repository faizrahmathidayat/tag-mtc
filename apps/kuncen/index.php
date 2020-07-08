<?php
require_once('../../auth/function_auth.php');
require_once ('../../config/config.php');

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

$session = $_SESSION['logged_in'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="<?= $_SESSION['csrf_token']; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="../../dist/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- sweetalert2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php include "static/navbar.php"; ?>
        <?php include "static/sidebar.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <?php 
                if(isset($_GET['page'])) {
                    $page = $_GET['page'];

                    switch ($page) {
                        case 'dashboard':
                        include "frontend/dashboard.php";
                        break;
                        case 'sektor':
                        include "frontend/sektor.php";
                        break;
                        case 'lokasi_atm':
                        include "frontend/lokasi_atm.php";
                        break;
                        case 'kunci':
                        include "frontend/kunci.php";
                        break;
                        case 'permintaan':
                        include "frontend/permintaan.php";
                        break;

                        default:
                        echo "Oops ! Halaman tidak ditemukan!";
                        break;
                    }
                } else {
                    include "frontend/dashboard.php";
                }
                ?>
                </main>
                <?php include "static/footer.php"; ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../dist/js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="../../dist/assets/demo/datatables-demo.js"></script>
    </body>
</html>
