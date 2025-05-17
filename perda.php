<?php
require 'function.php';
$conn = koneksi();
$query = "SELECT * FROM perda ORDER BY nomorperda ASC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Perda</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet" />

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />

  <!-- Modal (Using Bootstrap 4.6.0) -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
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
          <h1 class="h3 mb-4 ml-4 text-gray-800">Peraturan Daerah</h1>

          <div class="container mb-5">
            <a href="tambahperda.php" class="btn btn-primary">Tambah Perda</a>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Judul Perda</th>
                      <th>Nomor Perda</th>
                      <th>Tanggal Penetapan</th>
                      <th>No. LD</th>
                      <th>Seri</th>
                      <th>Status</th>
                      <th>Dokumen</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= htmlspecialchars($row["judulperda"]); ?></td>
                        <td><?= htmlspecialchars($row["nomorperda"]); ?></td>
                        <td>
                          <?php 
                          $date = new DateTime($row["tglpenetapanperda"]);
                          echo htmlspecialchars($date->format('d/m/Y')); 
                          ?>
                        </td>
                        <td><?= htmlspecialchars($row["nold"]); ?></td>
                        <td><?= htmlspecialchars($row["seriperda"]); ?></td>
                        <td><?= htmlspecialchars($row["statusperda"]); ?></td>
                        <td><a href="previewperda/<?= htmlspecialchars($row['fileperda']); ?>" target="_blank"><?= htmlspecialchars($row["fileperda"]); ?></a></td>
                        <td align="center">
                          <a href="detailperda.php?id=<?= $row["idperda"]; ?>" class="btn btn-secondary mb-1">Detail</a>
                          <a href="hapusperda.php?id=<?= $row["idperda"]; ?>" class="btn btn-danger mb-1">Hapus</a>
                          <a href="editperda.php?id=<?= $row["idperda"]; ?>" class="btn btn-warning mb-1">Edit</a>
                        </td>
                      </tr>
                      <?php $i++; ?>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
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

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
</body>
</html>
