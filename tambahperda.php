<?php
require 'function.php';
$conn = koneksi();

// Aktifkan error reporting untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit'])) {
    // Ambil input dari form dan ubah ke huruf kapital
    $diinputolehperda     = strtoupper($_POST['diinputoleh']);
    $judulperda           = strtoupper($_POST['judul']);
    $nomorperda           = strtoupper($_POST['nomor']);
    $tglevaluasiperda     = strtoupper($_POST['tanggalevaluasi']);
    $tglpenetapanperda    = strtoupper($_POST['tanggalpenetapan']);
    $tglpengundanganperda = strtoupper($_POST['tanggalpengundangan']);
    $statusperda          = strtoupper($_POST['status']);
    $nold                 = strtoupper($_POST['nold']);
    $noldt                = strtoupper($_POST['noldt']);
    $seriperda            = strtoupper($_POST['seri']);
    $ketperda             = strtoupper($_POST['keterangan']);
    
    // Penanganan upload file
    $fileperda           = $_FILES['fileperda']['name'];
    $filebaruperda       = $_FILES['filebaruperda']['name'];
    $tmp_name_perda      = $_FILES['fileperda']['tmp_name'];
    $tmp_name_baru       = $_FILES['filebaruperda']['tmp_name'];
    $error_perda         = $_FILES['fileperda']['error'];
    $error_baru          = $_FILES['filebaruperda']['error'];

    $uploadDir = 'previewperda/';
    
    // Upload file
    if ($error_perda === UPLOAD_ERR_OK) {
        if (!move_uploaded_file($tmp_name_perda, $uploadDir . $fileperda)) {
            echo "<script>
                    alert('Gagal mengupload file Perda!');
                    window.location.href = 'perda.php';
                  </script>";
            exit;
        }
    } else {
        echo "<script>
                alert('Error uploading file Perda: $error_perda');
                window.location.href = 'perda.php';
              </script>";
        exit;
    }
    
    if ($error_baru === UPLOAD_ERR_OK && !empty($filebaruperda)) {
        if (!move_uploaded_file($tmp_name_baru, $uploadDir . $filebaruperda)) {
            echo "<script>
                    alert('Gagal mengupload file Baru!');
                    window.location.href = 'perda.php';
                  </script>";
            exit;
        }
    } else {
        $filebaruperda = ''; // Set to empty if no file is uploaded or an error occurred
    }

    // Query untuk menambahkan data
    $query = "INSERT INTO perda 
              (diinputolehperda, judulperda, nomorperda, tglevaluasiperda, tglpenetapanperda, tglpengundanganperda, statusperda, nold, noldt, seriperda, ketperda, fileperda, filebaruperda) 
              VALUES 
              ('$diinputolehperda', '$judulperda', '$nomorperda', '$tglevaluasiperda', '$tglpenetapanperda', '$tglpengundanganperda', '$statusperda', '$nold', '$noldt', '$seriperda', '$ketperda', '$fileperda', '$filebaruperda')";

    // Menjalankan query
    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                window.location.href = 'perda.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambahkan: " . mysqli_error($conn) . "');
                window.location.href = 'perda.php';
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
    <title>Tambah Peraturan Daerah</title>

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
                        <h1 class="h3 mt-4 mb-4 text-gray-800">Tambah Peraturan Daerah</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="tambahperda.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="diinputolehperda">Diinput Oleh</label>
                                    <input type="text" class="form-control" id="diinputolehperda" name="diinputoleh" required>
                                </div>

                                <div class="form-group">
                                    <label for="judulperda">Judul Peraturan Daerah</label>
                                    <input type="text" class="form-control" id="judulperda" name="judul" required>
                                </div>

                                <div class="form-group">
                                    <label for="nomorperda">Nomor Peraturan Daerah</label>
                                    <input type="text" class="form-control" id="nomorperda" name="nomor" required>
                                </div>

                                <div class="form-group">
                                    <label for="tglevaluasiperda">Tanggal Evaluasi</label>
                                    <input type="date" class="form-control" id="tglevaluasiperda" name="tanggalevaluasi">
                                </div>

                                <div class="form-group">
                                    <label for="tglpenetapanperda">Tanggal Penetapan</label>
                                    <input type="date" class="form-control" id="tglpenetapanperda" name="tanggalpenetapan" required>
                                </div>

                                <div class="form-group">
                                    <label for="tglpengundanganperda">Tanggal Pengundangan</label>
                                    <input type="date" class="form-control" id="tglpengundanganperda" name="tanggalpengundangan">
                                </div>

                                <div class="form-group">
                                    <label for="nobd">No LD</label>
                                    <input type="text" class="form-control" id="nold" name="nold">
                                </div>

                                <div class="form-group">
                                    <label for="nobdt">No LD Tambahan</label>
                                    <input type="text" class="form-control" id="noldt" name="noldt">
                                </div>

                                <div class="form-group">
                                    <label for="seriperda">Seri</label>
                                    <input type="text" class="form-control" id="seriperda" name="seri">
                                </div>

                                <div class="form-group">
                                    <label for="fileperda">Dokumen</label>
                                    <input type="file" class="form-control-file border" id="fileperda" name="fileperda">
                                </div>

                                <div class="form-group">
                                    <label for="statusperda">Status Peraturan Daerah</label>
                                    <select name="status" id="statusperda" class="form-control" required>
                                        <option value="berlaku">Berlaku</option>
                                        <option value="diubah">Diubah</option>
                                        <option value="dicabut">Dicabut</option>
                                        <option value="diganti">Diganti</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ketperda">Keterangan</label>
                                    <input type="text" class="form-control" id="ketperda" name="keterangan">
                                </div>

                                <div class="form-group" id="formDokumenBaru" style="display: none;">
                                    <label for="filebaruperda">Dokumen Baru</label>
                                    <input type="file" class="form-control-file border" name="filebaruperda">
                                </div>
                                <br>
                                <div class="form-group">
                                    <a href="perda.php" class="btn btn-danger mb-1">Batal</a>
                                    <button type="submit" name="submit" class="btn btn-primary">Tambah Peraturan Daerah</button>
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
        var statusSelect = document.getElementById('statusperda');
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
