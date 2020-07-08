<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="index.php?page=dashboard">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Master Data</div>
                    <a class="nav-link" href="index.php?page=sektor">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Master Sektor
                    </a>
                    <a class="nav-link" href="index.php?page=lokasi_atm">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Master Lokasi ATM
                    </a>
                    <a class="nav-link" href="index.php?page=kunci">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Master Kunci
                    </a>
                    <div class="sb-sidenav-menu-heading">Maintenance</div>
                    <a class="nav-link" href="index.php?page=permintaan">
                        <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                        Permintaan
                    </a>
                    <a class="nav-link" href="tables.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                        Persetujuan
                    </a>
                    <a class="nav-link" href="tables.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                        Pengembalian
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?= $_SESSION['role'] ?>
            </div>
        </nav>
    </div>
