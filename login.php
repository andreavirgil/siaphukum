<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'hukumsiap');

if (isset($_POST['login'])) {
    // Ambil email dan password dari form
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Query untuk mendapatkan user berdasarkan email
    $query = "SELECT * FROM login WHERE email='$email'";
    $result = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($result);

    // Verifikasi password
    if ($user && $password === $user['password']) {
        // Set session variables
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_id'] = $user['id']; // Tambahkan ID pengguna ke session

        // Redirect ke halaman utama atau dashboard
        header("Location: index.php");
        exit();
    } else {
        // Jika login gagal, tampilkan pesan error
        $error_message = "Email atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet" />
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <!-- Bagian kiri dengan logo -->
                            <div class="col-lg-6 d-none d-lg-block text-center bg-white">
                                <img src="img/logo2.png" alt="Logo" style="width: 60%; margin-top: 25%; margin-left:10%;">
                            </div>
                            <!-- Bagian kanan dengan form login -->
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                    <hr />
                                    <br />
                                    <?php if (isset($error_message)) { ?>
                                        <div class="alert alert-danger">
                                            <?php echo $error_message; ?>
                                        </div>
                                    <?php } ?>
                                    <form class="user" method="post" action="">
                                        <div class="form-group">
                                            <p>Email</p>
                                            <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="Masukan email anda ..." required/>
                                        </div>
                                        <div class="form-group">
                                            <p>Password</p>
                                            <input type="text" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Masukan password anda ..." required/>
                                        </div>
                                        <br />
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                    <div style="text-align: center;">
                                        <small><a href="loginadmin.php">Halaman admin</a></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>
