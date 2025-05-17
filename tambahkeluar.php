<?php
require 'function.php';
$conn = koneksi();

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // Ambil input dari form
    $nosuratkeluar   = ($_POST['nosuratkeluar']);
    $tglsuratkeluar  = ($_POST['tglsuratkeluar']);
    $tglsekarangkeluar = ($_POST['tglsekarangkeluar']);
    $tujuan          = strtoupper($_POST['tujuan']);
    $perihalkeluar   = strtoupper($_POST['perihalkeluar']);
    $orangkeluar     = strtoupper($_POST['orangkeluar']);

    // Query untuk menyimpan data ke tabel `keluar`
    $query = "INSERT INTO keluar
              (nosuratkeluar, tglsuratkeluar, tglsekarangkeluar, tujuan, perihalkeluar, orangkeluar) 
              VALUES 
              ('$nosuratkeluar', '$tglsuratkeluar', '$tglsekarangkeluar', '$tujuan', '$perihalkeluar', '$orangkeluar')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                window.location.href = 'suratkeluar.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambahkan: " . htmlspecialchars(mysqli_error($conn), ENT_QUOTES, 'UTF-8') . "');
                window.location.href = 'suratkeluar.php';
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tambah Surat Keluar</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />

    <style>
        .form-control-file {
            border: 1px solid #ced4da;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-text mx-3">SIAP Hukum</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider" />
        <!-- Heading -->
        <div class="sidebar-heading">Dokumen Hukum</div>
        <li class="nav-item">
            <a class="nav-link" href="perda.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Peraturan Daerah</span>
            </a>
            <a class="nav-link" href="perbup.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Peraturan Bupati</span>
            </a>
            <a class="nav-link" href="keputusan.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Keputusan</span>
            </a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />
        <!-- Heading -->
        <div class="sidebar-heading">Surat</div>
        <li class="nav-item">
            <a class="nav-link" href="suratmasuk.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Surat Masuk</span>
            </a>
            <a class="nav-link" href="suratkeluar.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Surat Keluar</span>
            </a>
        </li>
        <hr class="sidebar-divider d-none d-md-block" />
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="card shadow mt-4 mb-4" align="center">
                    <h1 class="h3 mt-4 mb-4 text-gray-800">Tambah Surat Keluar</h1>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="tambahkeluar.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nosuratkeluar">Nomor Surat</label>
                                <input type="text" class="form-control" id="nosuratkeluar" name="nosuratkeluar" required>
                            </div>

                            <div class="form-group">
                                <label for="tglsuratkeluar">Tanggal Surat</label>
                                <input type="date" class="form-control" id="tglsuratkeluar" name="tglsuratkeluar" required>
                            </div>

                            <div class="form-group">
                                <label for="tglsekarangkeluar">Tanggal Sekarang</label>
                                <input type="date" class="form-control" id="tglsekarangkeluar" name="tglsekarangkeluar" value="<?php echo date('Y-m-d'); ?>" required readonly>
                            </div>

                            <div class="form-group">
                                <label for="tujuan">Tujuan</label>
                                <input type="text" class="form-control" id="tujuan" name="tujuan" required>
                            </div>

                            <div class="form-group">
                                <label for="perihalkeluar">Perihal</label>
                                <input type="text" class="form-control" id="perihalkeluar" name="perihalkeluar" required>
                            </div>

                            <div class="form-group">
                                <label for="orangkeluar">Pembuat</label>
                                <input type="text" class="form-control" id="orangkeluar" name="orangkeluar">
                            </div>
                            <br>
                            <div class="form-group">
                                <a href="suratkeluar.php" class="btn btn-danger mb-1">Batal</a>
                                <button type="submit" name="submit" class="btn btn-primary">Tambah Surat Keluar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>
</html>
