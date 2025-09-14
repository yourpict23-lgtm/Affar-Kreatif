<?php
require 'function.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Kalau sudah login, langsung ke index
if (isset($_SESSION['log'])) {
    header('location: index.php');
    exit;
}

// Cek login
$error = '';
if (isset($_POST['login'])) {
    $iduser = $_POST['iduser'];
    $password = $_POST['password'];

    $cekdatabase = mysqli_query($conn, "SELECT * FROM login WHERE iduser='$iduser' AND password='$password'");
    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung > 0) {
        $_SESSION['log'] = 'true';
        $_SESSION['iduser'] = $iduser;
        header('location: index.php');
        exit;
    } else {
        $error = 'ID User atau Password salah!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login</title>
    <link href="css/sb-admin-2.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        html, body {
            height: 100%;
        }
        body {
            background: url('img/bglogin.jpg');
            background-position: center;
            background-size: cover;
            min-height: 100vh;
            position: relative;
        }
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4"><b>Sign-In</b></h3></div>
                                <div class="card-body">
                                    <?php if ($error) { ?>
                                        <div class="alert alert-danger"><?= $error; ?></div>
                                    <?php } ?>
                                    <form method="post">
                                        <div class="mb-3">
                                            <label for="inputIdUser" class="form-label"><b>ID Number</b></label>
                                            <input class="form-control" name="iduser" id="inputIdUser" type="number" placeholder="12345" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputPassword" class="form-label"><b>Password</b></label>
                                            <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" required />
                                        </div>
                                        <button class="btn btn-primary w-100" name="login">Sign-In</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div id="layoutAuthentication_footer"></div>
            <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Hok A Hok E </div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>