<?php
require 'function.php';

$conn = koneksi();
$id   = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query  = "SELECT * FROM masuk WHERE idmasuk = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Data tidak ditemukan!");
}

if (isset($_POST['update'])) {
    $id           = intval($_POST['id']);
    $nosurat      = strtoupper(trim($_POST['nosurat']));
    $tglsurat     = $_POST['tglsurat'];
    $asal         = strtoupper(trim($_POST['asal']));
    $perihal      = strtoupper(trim($_POST['perihal']));
    $orang        = strtoupper(trim($_POST['orang']));

    // Prepare SQL query
    $query = "UPDATE masuk SET
        nosuratmasuk = '$nosurat',
        tglsuratmasuk = '$tglsurat',
        asal = '$asal',
        perihalmasuk = '$perihal',
        orangmasuk = '$orang'
        WHERE idmasuk = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: suratmasuk.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
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
  <title>Edit Surat Masuk</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet" />

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
</head>

<body id="page-top">
  <!-- Page Wrapper -->
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
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand mb-4 static-top">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="card shadow mt-4 mb-4 text-center">
            <h1 class="h3 mt-4 mb-4 text-gray-800">Edit Surat Masuk</h1>
          </div>

          <div class="card shadow mb-4">
            <div class="card-body">
              <form action="editmasuk.php?id=<?= htmlspecialchars($row['idmasuk']); ?>" method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['idmasuk']); ?>">

                <div class="form-group">
                  <label for="nosurat">Nomor Surat</label>
                  <input type="text" class="form-control" id="nosurat" name="nosurat" value="<?= htmlspecialchars($row['nosuratmasuk']); ?>" required>
                </div>

                <div class="form-group">
                  <label for="tglsurat">Tanggal Surat</label>
                  <input type="date" class="form-control" id="tglsurat" name="tglsurat" value="<?= htmlspecialchars($row['tglsuratmasuk']); ?>" required>
                </div>

                <div class="form-group">
                  <label for="asal">Asal</label>
                  <input type="text" class="form-control" id="asal" name="asal" value="<?= htmlspecialchars($row['asal']); ?>" required>
                </div>

                <div class="form-group">
                  <label for="perihal">Perihal</label>
                  <input type="text" class="form-control" id="perihal" name="perihal" value="<?= htmlspecialchars($row['perihalmasuk']); ?>" required>
                </div>

                <div class="form-group">
                  <label for="orang">Orang</label>
                  <input type="text" class="form-control" id="orang" name="orang" value="<?= htmlspecialchars($row['orangmasuk']); ?>" required>
                </div>

                <br>
                <div class="form-group">
                  <a href="suratmasuk.php" class="btn btn-danger mb-1">Batal</a>
                  <button type="submit" name="update" class="btn btn-primary mb-1">Simpan</button>
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

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="js/demo/datatables-demo.js"></script>
</body>
</html>
