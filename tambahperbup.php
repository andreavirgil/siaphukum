<?php
require 'function.php';
$conn = koneksi();

if (isset($_POST['submit'])) {
    // Ambil input dari form dan ubah ke huruf kapital
    $diinputolehperbup     = strtoupper($_POST['diinputolehperbup']);
    $judulperbup           = strtoupper($_POST['judulperbup']);
    $nomorperbup           = strtoupper($_POST['nomorperbup']);
    $tglevaluasiperbup     = strtoupper($_POST['tglevaluasiperbup']);
    $tglpenetapanperbup    = strtoupper($_POST['tglpenetapanperbup']);
    $tglpengundanganperbup = strtoupper($_POST['tglpengundanganperbup']);
    $statusperbup          = strtoupper($_POST['statusperbup']);
    $nobd                  = strtoupper($_POST['nobd']);
    $nobdt                 = strtoupper($_POST['nobdt']);
    $ketperbup             = strtoupper($_POST['ketperbup']);

    // Penanganan upload file
    $fileperbup            = $_FILES['fileperbup']['name'];
    $filebaruperbup        = $_FILES['filebaruperbup']['name'];
    $tmp_name_perbup       = $_FILES['fileperbup']['tmp_name'];
    $tmp_name_baru         = $_FILES['filebaruperbup']['tmp_name'];
    $error_perbup          = $_FILES['fileperbup']['error'];
    $error_baru            = $_FILES['filebaruperbup']['error'];

    $uploadDir = 'previewperbup/';

    // Upload file
    if ($error_perbup === UPLOAD_ERR_OK) {
        if (move_uploaded_file($tmp_name_perbup, $uploadDir . $fileperbup)) {
            $fileperbup = $fileperbup; // Update variable file name
        } else {
            echo "<script>
                    alert('Gagal mengupload file Perbup!');
                    window.location.href = 'perbup.php';
                  </script>";
            exit;
        }
    } else {
        echo "<script>
                alert('Error uploading file Perbup: $error_perbup');
                window.location.href = 'perbup.php';
              </script>";
        exit;
    }

    if ($error_baru === UPLOAD_ERR_OK && !empty($filebaruperbup)) {
        if (move_uploaded_file($tmp_name_baru, $uploadDir . $filebaruperbup)) {
            $filebaruperbup = $filebaruperbup; // Update variable file name
        } else {
            echo "<script>
                    alert('Gagal mengupload file Baru!');
                    window.location.href = 'perbup.php';
                  </script>";
            exit;
        }
    } else {
        $filebaruperbup = ''; // Set to empty if no file is uploaded or an error occurred
    }

    $query = "INSERT INTO perbup 
              (diinputolehperbup, judulperbup, nomorperbup, tglevaluasiperbup, tglpenetapanperbup, tglpengundanganperbup, statusperbup, nobd, nobdt, ketperbup, fileperbup, filebaruperbup) 
              VALUES 
              ('$diinputolehperbup', '$judulperbup', '$nomorperbup', '$tglevaluasiperbup', '$tglpenetapanperbup', '$tglpengundanganperbup', '$statusperbup', '$nobd', '$nobdt', '$ketperbup', '$fileperbup', '$filebaruperbup')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                window.location.href = 'perbup.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambahkan!');
                window.location.href = 'perbup.php';
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
    <title>Tambah Peraturan Bupati</title>

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
                        <h1 class="h3 mt-4 mb-4 text-gray-800">Tambah Peraturan Bupati</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="tambahperbup.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="diinputolehperbup">Diinput Oleh</label>
                                    <input type="text" class="form-control" id="diinputolehperbup" name="diinputolehperbup" required>
                                </div>

                                <div class="form-group">
                                    <label for="judulperbup">Judul Peraturan Bupati</label>
                                    <input type="text" class="form-control" id="judulperbup" name="judulperbup" required>
                                </div>

                                <div class="form-group">
                                    <label for="nomorperbup">Nomor Peraturan Bupati</label>
                                    <input type="text" class="form-control" id="nomorperbup" name="nomorperbup" required>
                                </div>

                                <div class="form-group">
                                    <label for="tglevaluasiperbup">Tanggal Evaluasi</label>
                                    <input type="date" class="form-control" id="tglevaluasiperbup" name="tglevaluasiperbup">
                                </div>

                                <div class="form-group">
                                    <label for="tglpenetapanperbup">Tanggal Penetapan</label>
                                    <input type="date" class="form-control" id="tglpenetapanperbup" name="tglpenetapanperbup" required>
                                </div>

                                <div class="form-group">
                                    <label for="tglpengundanganperbup">Tanggal Pengundangan</label>
                                    <input type="date" class="form-control" id="tglpengundanganperbup" name="tglpengundanganperbup">
                                </div>

                                <div class="form-group">
                                    <label for="nobd">No BD</label>
                                    <input type="text" class="form-control" id="nobd" name="nobd">
                                </div>

                                <div class="form-group">
                                    <label for="nobdt">No BD Tambahan</label>
                                    <input type="text" class="form-control" id="nobdt" name="nobdt">
                                </div>

                                <div class="form-group">
                                    <label for="fileperbup">Dokumen</label>
                                    <input type="file" class="form-control-file border" id="fileperbup" name="fileperbup">
                                </div>

                                <div class="form-group">
                                    <label for="statusperbup">Status Peraturan Bupati</label>
                                    <select name="statusperbup" id="statusperbup" class="form-control" required>
                                        <option value="berlaku">Berlaku</option>
                                        <option value="diubah">Diubah</option>
                                        <option value="dicabut">Dicabut</option>
                                        <option value="diganti">Diganti</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ketperbup">Keterangan</label>
                                    <input type="text" class="form-control" id="ketperbup" name="ketperbup">
                                </div>

                                <div class="form-group" id="formDokumenBaru" style="display: none;">
                                    <label for="filebaruperbup">Dokumen Baru</label>
                                    <input type="file" class="form-control-file border" name="filebaruperbup">  <!-- Ubah name menjadi filebaruperbup -->
                                </div>
                                <br>
                                <div class="form-group">
                                    <a href="perbup.php" class="btn btn-danger mb-1">Batal</a>
                                    <button type="submit" name="submit" class="btn btn-primary">Tambah Peraturan Bupati</button>
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
    var statusSelect = document.getElementById('statusperbup');  // Ubah ID menjadi statusperbup
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
