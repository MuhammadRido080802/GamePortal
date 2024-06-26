<?php
session_start();
// Jika bisa login maka ke index.php
if (isset($_SESSION['login'])) {
    header('location:pemain.php');
    exit;
}
// Memanggil atau membutuhkan file function.php
require 'function.php';
// jika tombol yang bernama login diklik
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    // password menggunakan md5
    // mengambil data
    $result = mysqli_query($koneksi, "SELECT * FROM admin WHERE username = '$username'");
    $cek = mysqli_num_rows($result);
    if ($cek > 0) {
        $_SESSION['login'] = true;
        header('location:admin.php');
        exit;
    }
     $error = true;  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
    <style>
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
       body {
            background-repeat: no-repeat;
            background-size: cover;
        }
        </style>	
</head>
<body style="background-image: url('img/bg/gameportal.png');">
<header>
        <img src="img/bg/logo12.png" alt="Logo GamePortal" style="width: 50px; height: auto; display: inline-block;">
        <div style="display: inline-block; vertical-align: top;">
            <h1 style="display: inline-block; margin: 0;">GamePortal</h1>
            <p style="margin: 0;">Portal Data Pemain dan Game</p>
        </div>
    </header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #343a40; color: white;">
    <div class="container-fluid">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link" href="home.php">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">REGISTER</a>
            </li>
        </ul>
    </div>
</nav>
    <!-- Close Navbar -->
    <div class="container">
        <div class="row my-5 justify-content-center">
            <div class="col-md-6 text-center login" style="background-image: url('img/bg/gameportal2.png');">
            <h4 class="fw-bold" style="color: white;">Login | Admin</h4>
                <!-- Ini Error jika tidak bisa login -->
                <?php if (isset($error)) : ?>
                    <?php echo '<script>alert("Username atau Password Salah!");</script>'; ?>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="form-group user">
                        <input type="text" class="form-control w-50" placeholder="Masukkan Username" name="username" autocomplete="off" required>
                    </div>
                    <div class="form-group my-5">
                        <input type="password" class="form-control w-50" placeholder="Masukkan Password" name="password" autocomplete="off" required>
                    </div>
                    <button class="btn btn-primary text-uppercase" type="submit" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>