<?php
require 'function.php';

$conn = koneksi();

// Periksa apakah ID pengguna telah diterima melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data pengguna berdasarkan ID
    $query = "SELECT * FROM login WHERE iduser = $id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    // Jika data pengguna tidak ditemukan, redirect ke halaman utama
    if (!$user) {
        header("Location: indexadmin.php");
        exit;
    }
} else {
    // Jika ID tidak ada, redirect kembali ke halaman utama
    header("Location: indexadmin.php");
    exit;
}

// Proses update data pengguna
if (isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $peran = htmlspecialchars($_POST['peran']);

    // Periksa apakah password diubah
    if (!empty($_POST['password'])) {
        $password = htmlspecialchars($_POST['password']);
        $query_update = "UPDATE login SET username = '$username', email = '$email', peran = '$peran', password = '$password' WHERE iduser = $id";
    } else {
        $query_update = "UPDATE login SET username = '$username', email = '$email', peran = '$peran' WHERE iduser = $id";
    }

    // Debugging: Cek query update
    // echo $query_update;

    // Eksekusi query update
    if (mysqli_query($conn, $query_update)) {
        header("Location: indexadmin.php");
        exit;
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Pengguna</h6>
                                </div>
                                <div class="card-body">
                                    <form action="edituser.php?id=<?= $id ?>" method="POST">
                                        <div class="form-group">
                                            <label for="username">Nama Pengguna:</label>
                                            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="peran">Peran:</label>
                                            <select class="form-control" id="peran" name="peran" required>
                                                <option value="Admin" <?= $user['peran'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                                                <option value="User" <?= $user['peran'] == 'User' ? 'selected' : ''; ?>>User</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password (Kosongkan jika tidak ingin mengubah):</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        <br>
                                        <div class="form-group text-right">
                                            <a href="indexadmin.php" class="btn btn-danger btn-custom">Batal</a>
                                            <button type="submit" name="submit" class="btn btn-primary btn-custom">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>
    </body>
</html>
