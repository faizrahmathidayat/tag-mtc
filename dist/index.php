<?php
require_once('../auth/function_auth.php');
require_once ('../config/config.php');
// require_once ('static/active_sidebar.php');

if(isset($_SESSION['logged_in']))
{
    if (!login_check()) {
        header("Location: logout.php");
    }
}
else
{
    header("Location: ../");
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
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- sweetalert2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php include "navbar.php"; ?>
        <?php include "sidebar.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <?php 
                if(isset($_GET['page'])) {
                    $page = $_GET['page'];

                    switch ($page) {
                        case 'dashboard':
                        include "dashboard.php";
                        break;
                        case 'sektor':
                        include "sektor.php";
                        break;
                        case 'canceled':
                        include "content/canceled_customer.php";
                        break;
                        case 'invoice':
                        include "content/invoice.php";
                        break;
                        case 'laporan':
                        include "content/laporan.php";
                        break;
                        case 'ubahpassword':
                        include "content/ubahpassword.php";
                        break;

                        default:
                        echo "Oops ! Halaman tidak ditemukan!";
                        break;
                    }
                } else {
                    include "dashboard.php";
                }
                ?>
                </main>
                <?php include "footer.php"; ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
