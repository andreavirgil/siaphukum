<?php
require 'function.php';
$conn = koneksi();

// Ambil ID dari URL
$id = $_GET['id'];

// Query untuk mengambil data detail berdasarkan ID
$query = "SELECT * FROM perda WHERE idperda = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $judulperda = htmlspecialchars($row["judulperda"]);
    $nomorperda = htmlspecialchars($row["nomorperda"]);
    $tglevaluasiperda = date('d/m/Y', strtotime($row["tglevaluasiperda"]));
    $tglpenetapanperda = date('d/m/Y', strtotime($row["tglpenetapanperda"]));
    $tglpengundanganperda = date('d/m/Y', strtotime($row["tglpengundanganperda"]));
    $statusperda = htmlspecialchars($row["statusperda"]);
    $nold = htmlspecialchars($row["nold"]);
    $noldt = htmlspecialchars($row["noldt"]);
    $seriperda = htmlspecialchars($row["seriperda"]);
    $ketperda = htmlspecialchars($row["ketperda"]);
    $fileperda = htmlspecialchars($row["fileperda"]);
    $filebaruperda = htmlspecialchars($row["filebaruperda"]);
    $diinputolehperda = htmlspecialchars($row["diinputolehperda"]);
} else {
    echo "Data tidak ditemukan!";
    exit;
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
  <title>Detail Perda</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet" />
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
          <h1 class="h3 mb-4 ml-4 text-gray-800">Detail Peraturan Daerah</h1>

          <!-- Detail Content -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th>Nomor Perda</th>
                    <td><?= $nomorperda; ?></td>
                  </tr>
                  <tr>
                    <th>Judul Perda</th>
                    <td><?= $judulperda; ?></td>
                  </tr>
                  <tr>
                    <th>Tanggal Evaluasi</th>
                    <td><?= $tglevaluasiperda; ?></td>
                  </tr>
                  <tr>
                    <th>Tanggal Penetapan</th>
                    <td><?= $tglpenetapanperda; ?></td>
                  </tr>
                  <tr>
                    <th>Tanggal Pengundangan</th>
                    <td><?= $tglpengundanganperda; ?></td>
                  </tr>
                  <tr>
                    <th>No. LD</th>
                    <td><?= $nold; ?></td>
                  </tr>
                  <tr>
                    <th>No. LD Tambahan</th>
                    <td><?= $noldt; ?></td>
                  </tr>
                  <tr>
                    <th>Seri</th>
                    <td><?= $seriperda; ?></td>
                  </tr>
                  <tr>
                    <th>Dokumen</th>
                    <td><a href="previewperda/<?= $fileperda; ?>" target="_blank"><?= $fileperda; ?></a></td>
                  </tr>
                  <tr>
                    <th>Status</th>
                    <td><?= $statusperda; ?></td>
                  </tr>
                  <tr>
                    <th>Keterangan</th>
                    <td><?= $ketperda; ?> <a href="previewperda/<?= $filebaruperda; ?>" target="_blank"><?= $filebaruperda; ?></a></td>
                  </tr>
                  <tr>
                    <th>Diinput Oleh</th>
                    <td><?= $diinputolehperda; ?></td>
                  </tr>
                </tbody>
              </table>
              <a href="perda.php" class="btn btn-primary">Kembali</a>
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
