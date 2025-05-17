<?php
require 'function.php';

$conn = koneksi();
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM perbup WHERE idperbup = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Data tidak ditemukan!");
}

if (isset($_POST['update'])) {
    $judul               = strtoupper($_POST['judul']);
    $nomor               = strtoupper($_POST['nomor']);
    $tanggalevaluasi     = $_POST['tanggalevaluasi'];
    $tanggalpenetapan    = $_POST['tanggalpenetapan'];
    $tanggalpengundangan = $_POST['tanggalpengundangan'];
    $status              = strtoupper($_POST['status']);
    $nobd                = strtoupper($_POST['nobd']);
    $nobdt               = strtoupper($_POST['nobdt']);
    $keterangan          = strtoupper($_POST['keterangan']);

    // Handle file upload for fileperbup
    $fileNameperbup = $row['fileperbup']; // Use existing file by default
    if (!empty($_FILES['fileperbup']['name'])) {
        $fileTmpNameperbup = $_FILES['fileperbup']['tmp_name'];
        $fileNameperbup = $_FILES['fileperbup']['name'];
        $fileDestinationperbup = 'previewperbup/' . $fileNameperbup;
        if (!move_uploaded_file($fileTmpNameperbup, $fileDestinationperbup)) {
            echo "Failed to upload fileperbup.";
        }
    }

    // Handle file upload for filebaruperbup
    $fileNameBaru = $row['filebaruperbup']; // Use existing file by default
    if (!empty($_FILES['filebaruperbup']['name'])) {
        $fileTmpNameBaru = $_FILES['filebaruperbup']['tmp_name'];
        $fileNameBaru = $_FILES['filebaruperbup']['name'];
        $fileDestinationBaru = 'previewperbup/' . $fileNameBaru;
        if (!move_uploaded_file($fileTmpNameBaru, $fileDestinationBaru)) {
            echo "Failed to upload filebaruperbup.";
        }
    }

    $query = "UPDATE perbup SET
        judulperbup           = '$judul',
        nomorperbup           = '$nomor',
        tglevaluasiperbup     = '$tanggalevaluasi',
        tglpenetapanperbup    = '$tanggalpenetapan',
        tglpengundanganperbup = '$tanggalpengundangan',
        statusperbup          = '$status',
        nobd                  = '$nobd',
        nobdt                 = '$nobdt',
        ketperbup             = '$keterangan',
        fileperbup            = '$fileNameperbup',
        filebaruperbup        = '$fileNameBaru'
        WHERE idperbup        = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: perbup.php");
        exit;
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
    <title>Edit Perbup</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Modal (Using Bootstrap 4.6.0) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    
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
                        <h1 class="h3 mt-4 mb-4 text-gray-800">Edit Perbup</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($row['idperbup']); ?>">
                                
                                <div class="form-group">
                                    <label for="judul">Judul Perbup</label>
                                    <input type="text" class="form-control" id="judul" name="judul" value="<?= htmlspecialchars($row['judulperbup']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="nomor">Nomor Perbup</label>
                                    <input type="text" class="form-control" id="nomor" name="nomor" value="<?= htmlspecialchars($row['nomorperbup']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="tanggalevaluasi">Tanggal Evaluasi</label>
                                    <input type="date" class="form-control" id="tanggalevaluasi" name="tanggalevaluasi" value="<?= htmlspecialchars($row['tglevaluasiperbup']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="tanggalpenetapan">Tanggal Penetapan</label>
                                    <input type="date" class="form-control" id="tanggalpenetapan" name="tanggalpenetapan" value="<?= htmlspecialchars($row['tglpenetapanperbup']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="tanggalpengundangan">Tanggal Pengundangan</label>
                                    <input type="date" class="form-control" id="tanggalpengundangan" name="tanggalpengundangan" value="<?= htmlspecialchars($row['tglpengundanganperbup']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="nobd">No. BD</label>
                                    <input type="text" class="form-control" id="nobd" name="nobd" value="<?= htmlspecialchars($row['nobd']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="nobdt">No. BD Tambahan</label>
                                    <input type="text" class="form-control" id="nobdt" name="nobdt" value="<?= htmlspecialchars($row['nobdt']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="fileperbup">Dokumen</label>
                                    <input type="file" class="form-control-file" id="fileperbup" name="fileperbup">
                                    <small>Dokumen sebelumnya: <?= htmlspecialchars($row['fileperbup']); ?></small>
                                </div>

                                <div class="form-group">
                                <label for="status">Status Perbup</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="berlaku" <?= $row['statusperbup'] == 'berlaku' ? 'selected' : ''; ?>>Berlaku</option>
                                    <option value="diubah" <?= $row['statusperbup'] == 'diubah' ? 'selected' : ''; ?>>Diubah</option>
                                    <option value="dicabut" <?= $row['statusperbup'] == 'dicabut' ? 'selected' : ''; ?>>Dicabut</option>
                                    <option value="diganti" <?= $row['statusperbup'] == 'diganti' ? 'selected' : ''; ?>>Diganti</option>
                                </select>
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= htmlspecialchars($row['ketperbup']); ?>" required>
                                </div>

                                <div id="dokumenBaru" class="form-group" style="display: none;" >
                                    <label for="filebaruperbup">Dokumen Baru</label>
                                    <input type="file" class="form-control-file" id="filebaruperbup" name="filebaruperbup">
                                    <small>Dokumen sebelumnya: <?= htmlspecialchars($row['filebaruperbup']); ?></small>
                                </div>
                                <br>
                                <a href="perbup.php" class="btn btn-danger mb-1">Batal</a>
                                <button type="submit" class="btn btn-primary" name="update">Update</button>
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
