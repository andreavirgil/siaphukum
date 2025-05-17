<?php
require 'function.php';
$conn = koneksi();

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // Ambil input dari form
    $diinputolehkep  = strtoupper($_POST['diinputolehkep']);
    $judulkep        = strtoupper($_POST['judul']);
    $kodenaskahkep   = strtoupper($_POST['kodenaskahkep']);
    $nomorkep        = strtoupper($_POST['nomorkep']);
    $tglpenetapankep = $_POST['tanggalpenetapankep'];
    $opd             = strtoupper($_POST['opd']);
    $statuskep       = strtoupper($_POST['status']);
    $ketkep          = strtoupper($_POST['keterangan']);
    
    // Penanganan upload file
    $filekep         = $_FILES['filekep']['name'];
    $filebarukep     = $_FILES['filebarukep']['name'];
    $tmp_name_kep    = $_FILES['filekep']['tmp_name'];
    $tmp_name_baru   = $_FILES['filebarukep']['tmp_name'];
    
    // Upload file
    if (!empty($filekep)) {
        move_uploaded_file($tmp_name_kep, "previewkep/$filekep");
    }
    if (!empty($filebarukep)) {
        move_uploaded_file($tmp_name_baru, "previewkep/$filebarukep");
    }

    $query = "INSERT INTO keputusan
              (diinputolehkep, judulkep, nomorkep, kodenaskahkep, tglpenetapankep, opd, statuskep, ketkep, filekep, filebarukep) 
              VALUES 
              ('$diinputolehkep', '$judulkep', '$nomorkep', '$kodenaskahkep', '$tglpenetapankep', '$opd', '$statuskep', '$ketkep', '$filekep', '$filebarukep')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                window.location.href = 'keputusan.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambahkan: " . htmlspecialchars(mysqli_error($conn), ENT_QUOTES, 'UTF-8') . "');
                window.location.href = 'keputusan.php';
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
    <title>Tambah Keputusan</title>

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
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card shadow mt-4 mb-4" align="center">
                        <h1 class="h3 mt-4 mb-4 text-gray-800">Tambah Keputusan</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="tambahkep.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="diinputolehkep">Diinput Oleh</label>
                                    <input type="text" class="form-control" id="diinputolehkep" name="diinputolehkep" required>
                                </div>

                                <div class="form-group">
                                    <label for="judul">Judul Keputusan</label>
                                    <input type="text" class="form-control" id="judul" name="judul" required>
                                </div>

                                <div class="form-group">
                                    <label for="kodenaskahkep">Kode Naskah</label>
                                    <input type="text" class="form-control" id="kodenaskahkep" name="kodenaskahkep" required>
                                </div>

                                <div class="form-group">
                                    <label for="nomorkep">Nomor Keputusan</label>
                                    <input type="text" class="form-control" id="nomorkep" name="nomorkep" required>
                                </div>

                                <div class="form-group">
                                    <label for="opd">OPD</label>
                                    <input type="text" class="form-control" id="opd" name="opd" required>
                                </div>

                                <div class="form-group">
                                    <label for="tanggalpenetapankep">Tanggal Penetapan</label>
                                    <input type="date" class="form-control" id="tanggalpenetapankep" name="tanggalpenetapankep" required>
                                </div>

                                <div class="form-group">
                                    <label for="filekep">Dokumen</label>
                                    <input type="file" class="form-control-file border" name="filekep" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="status">Status Keputusan</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="berlaku">Berlaku</option>
                                        <option value="diubah">Diubah</option>
                                        <option value="dicabut">Dicabut</option>
                                        <option value="diganti">Diganti</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                                </div>

                                <div class="form-group" id="formDokumenBaru" style="display: none;">
                                    <label for="filebarukep">Dokumen Baru</label>
                                    <input type="file" class="form-control-file border" name="filebarukep">
                                </div>
                                <br>
                                <div class="form-group">
                                    <a href="keputusan.php" class="btn btn-danger mb-1">Batal</a>
                                    <button type="submit" name="submit" class="btn btn-primary">Tambah Keputusan</button>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var statusSelect = document.getElementById('status');
        var formDokumenBaru = document.getElementById('formDokumenBaru');

        function toggleFormDokumenBaru() {
            if (statusSelect.value === 'diganti' || statusSelect.value === 'dicabut') {
                formDokumenBaru.style.display = 'block';
            } else {
                formDokumenBaru.style.display = 'none';
            }
        }

        // Menampilkan form berdasarkan status yang sudah dipilih saat halaman dimuat
        toggleFormDokumenBaru();

        // Menambahkan event listener untuk perubahan pada dropdown status
        statusSelect.addEventListener('change', toggleFormDokumenBaru);
    });
    </script>
</body>
</html>
