<?php
require 'function.php';

$conn = koneksi();
$id   = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query  = "SELECT * FROM keputusan WHERE idkep = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Data tidak ditemukan!");
}

if (isset($_POST['update'])) {
    $id           = intval($_POST['id']);
    $judul        = strtoupper(trim($_POST['judul']));
    $nomor        = strtoupper(trim($_POST['nomor']));
    $kodenaskah   = strtoupper(trim($_POST['kodenaskah']));
    $opd          = strtoupper(trim($_POST['opd']));
    $tglpenetapan = $_POST['tanggalpenetapan'];
    $status       = strtoupper(trim($_POST['status']));
    $keterangan   = strtoupper(trim($_POST['keterangan']));

    // Handle file upload for filekep
    $fileNameKep            = $row['filekep']; // Use existing file by default
    if (!empty($_FILES['filekep']['name'])) {
        $fileTmpNameKep     = $_FILES['filekep']['tmp_name'];
        $fileNameKep        = $_FILES['filekep']['name'];
        $fileDestinationKep = 'previewkep/' . $fileNameKep;
        if (!move_uploaded_file($fileTmpNameKep, $fileDestinationKep)) {
            echo "Failed to upload filekep.";
        }
    }

    // Handle file upload for filebarukep
    $fileNameBaru            = $row['filebarukep']; // Use existing file by default
    if (!empty($_FILES['filebarukep']['name'])) {
        $fileTmpNameBaru     = $_FILES['filebarukep']['tmp_name'];
        $fileNameBaru        = $_FILES['filebarukep']['name'];
        $fileDestinationBaru = 'previewkep/' . $fileNameBaru;
        if (!move_uploaded_file($fileTmpNameBaru, $fileDestinationBaru)) {
            echo "Failed to upload filebarukep.";
        }
    }

    // Prepare SQL query
    $query = "UPDATE keputusan SET
        judulkep        = '$judul',
        nomorkep        = '$nomor',
        kodenaskahkep   = '$kodenaskah',
        opd             = '$opd',
        tglpenetapankep = '$tglpenetapan',
        statuskep       = '$status',
        ketkep          = '$keterangan',
        filekep         = '$fileNameKep',
        filebarukep     = '$fileNameBaru'
        WHERE idkep     = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: keputusan.php");
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
  <title>Edit Keputusan</title>

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
            <h1 class="h3 mt-4 mb-4 text-gray-800">Edit Keputusan</h1>
          </div>

          <div class="card shadow mb-4">
            <div class="card-body">
              <form action="editkep.php?id=<?= htmlspecialchars($row['idkep']); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['idkep']); ?>">

                <div class="form-group">
                  <label for="nomor">Nomor Keputusan</label>
                  <input type="text" class="form-control" id="nomor" name="nomor" value="<?= htmlspecialchars($row['nomorkep']); ?>" required>
                </div>

                <div class="form-group">
                  <label for="judul">Judul Keputusan</label>
                  <input type="text" class="form-control" id="judul" name="judul" value="<?= htmlspecialchars($row['judulkep']); ?>" required>
                </div>

                <div class="form-group">
                  <label for="kodenaskah">Kode Naskah</label>
                  <input type="text" class="form-control" id="kodenaskah" name="kodenaskah" value="<?= htmlspecialchars($row['kodenaskahkep']); ?>" required>
                </div>

                <div class="form-group">
                  <label for="opd">OPD</label>
                  <input type="text" class="form-control" id="opd" name="opd" value="<?= htmlspecialchars($row['opd']); ?>" required>
                </div>

                <div class="form-group">
                  <label for="tanggalpenetapan">Tanggal Penetapan</label>
                  <input type="date" class="form-control" id="tanggalpenetapan" name="tanggalpenetapan" value="<?= htmlspecialchars($row['tglpenetapankep']); ?>" required>
                </div>

                <div class="form-group">
                  <label for="filekep">Dokumen</label>
                  <input type="file" class="form-control-file border" id="filekep" name="filekep">
                  <small>Dokumen sebelumnya: <?= htmlspecialchars($row['filekep']); ?></small>
                </div>

                <div class="form-group">
                  <label for="status">Status Keputusan</label>
                  <select name="status" id="status" class="form-control" required>
                    <option value="berlaku" <?= $row['statuskep'] == 'berlaku' ? 'selected' : ''; ?>>Berlaku</option>
                    <option value="diubah" <?= $row['statuskep'] == 'diubah' ? 'selected' : ''; ?>>Diubah</option>
                    <option value="dicabut" <?= $row['statuskep'] == 'dicabut' ? 'selected' : ''; ?>>Dicabut</option>
                    <option value="diganti" <?= $row['statuskep'] == 'diganti' ? 'selected' : ''; ?>>Diganti</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= htmlspecialchars($row['ketkep']); ?>" required>
                </div>

                <div id="dokumenBaru" class="form-group" style="display: none;">
                  <label for="filebarukep">Dokumen Baru</label>
                  <input type="file" class="form-control-file border" id="filebarukep" name="filebarukep">
                  <small>Dokumen sebelumnya: <?= htmlspecialchars($row['filebarukep']); ?></small>
                </div>
                
                <br>
                <div class="form-group">
                  <a href="keputusan.php" class="btn btn-danger mb-1">Batal</a>
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

  <!-- Custom Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var statusSelect = document.getElementById('status');
        var dokumenBaruDiv = document.getElementById('dokumenBaru');
        
        function toggleDokumenBaru() {
            if (statusSelect.value === 'diganti' || statusSelect.value === 'dicabut') {
                dokumenBaruDiv.style.display = 'block';
            } else {
                dokumenBaruDiv.style.display = 'none';
            }
        }
        
        // Initialize visibility based on current value
        toggleDokumenBaru();
        
        // Add event listener to handle changes
        statusSelect.addEventListener('change', toggleDokumenBaru);
    });
  </script>
</body>
</html>
