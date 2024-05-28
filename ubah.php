<?php
session_start();
// Jika tidak bisa login maka balik ke login.php
// jika masuk ke halaman ini melalui url, maka langsung menuju halaman login
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';

// Mengambil data dari nip dengan fungsi get
$nip = $_GET['nip'];

// Mengambil data dari table pemain dari nip
$siswa = query("SELECT * FROM pemain WHERE nip = $nip")[0];

// Jika fungsi ubah ljika data terubah, maka munculkan alert dibawah
if (isset($_POST['ubah'])) {
    if (ubah_pemain($_POST) > 0) {
        echo "<script>
                alert('Data siswa berhasil diubah!');
                document.location.href = 'pemain    .php';
            </script>";
    } else {
        // Jika fungsi ubah jika data tidak terubah, maka munculkan alert dibawah
        echo "<script>
                alert('Data pemain gagal diubah!');
            </script>";
    }
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
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Ubah Data</title>
</head>

<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.sidebar {
    width: 240px;
    height: 100%;
    background-color: #202020;
    position: fixed;
    top: 0;
    left: -240px;
    overflow-x: hidden;
    transition: left 0.3s ease;
    z-index: 1000;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    padding: 10px 20px;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s;
}

.sidebar ul li:hover {
    background-color: #303030;
}

.menu-icon {
    color: #fff;
    cursor: pointer;
    font-size: 24px;
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 2000;
}

.content {
    margin-left: 260px; /* Adjust as per your requirement */
    padding: 20px;
}
#menuIcon {
    display: flex;
    align-items: center; /* Mengatur konten secara vertikal dalam div */
}

.game-portal-logo {
    width: 1em; /* Mengatur lebar gambar menjadi setara dengan lebar teks */
    height: auto; /* Agar gambar tetap proporsional */
    margin-right: 5px; /* Jarak antara gambar dan teks */
}
 /* CSS untuk mengatur rata kiri menusidebar */
 .left-align {
        text-align: left;
    }
</style>

<body>
    <span id="menuIcon" class="menu-icon" onclick="toggleSidebar()">&#9776; GAME PORTAL <img src="img/bg/logo12.png" alt="Game Portal" class="game-portal-logo"></span>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase fixed-top" >
        <div class="container">
            <!-- Ikon menu -->
            <div class="sidebar" id="sidebar">
    <ul class="left-align">
        <li></li>
        <li></li>
        <hr></hr>
        <li><a href="user.php"><i class="bi bi-house-door"></i> <span>Home</span></a></li>
        <li><a href="pemain.php"><i class="bi bi-joystick"></i> <span>Pemain</span></a></li>
        <li><a href="game.php"><i class="bi bi-controller"></i> <span>Game</span></a></li>
        <li><a href="about.php"><i class="bi bi-info-circle"></i> <span>About</span></a></li>
        <li><a href="logout.php"><i class="bi bi-box-arrow-right"></i> <span>Logout</span></a></li>
    </ul>
</div>

    </nav>
    <!-- Close Navbar -->

    <!-- Container -->
    <div class="container">
        <div class="row my-2">
            <div class="col-md">
                <h3 class="fw-bold text-uppercase" style="color:black;"><i class="bi bi-pencil-square"></i>&nbsp;Ubah Data Pemain</h3>
            </div>
            <hr>
        </div>
        <div class="row my-2">
            <div class="col-md">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nip" class="form-label" style="padding-right: 10000px; color:black;">nip</label>
                        <input type="number" class="form-control w-50" id="nip" value="<?= $siswa['nip']; ?>" name="nip" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label" style="padding-right: 10000px; color:black;">Nama</label>
                        <input type="text" class="form-control w-50" id="nama" value="<?= $siswa['nama']; ?>" name="nama" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="tier" class="form-label" style="padding-right: 10000px; color:black;">tier</label>
                        <input type="text" class="form-control w-50" id="tier" value="<?= $siswa['tier']; ?>" name="tier" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="game_main" class="form-label" style="padding-right: 10000px; color:black;">game_main</label>
                        <input type="text" class="form-control w-50" id="game_main" value="<?= $siswa['game_main']; ?>" name="game_main" autocomplete="off" required>
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="device" class="form-label" style="padding-right: 10000px; color:black;">device</label>
                        <input type="text" class="form-control w-50" id="device" value="<?= $siswa['device']; ?>" name="device" autocomplete="off" required>
                    </div>
                    <hr>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning" name="ubah">Ubah</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Close Container -->

    <!-- javascript -->
    <script>
        
function toggleSidebar() {
    var sidebar = document.getElementById('sidebar');
    var menuIcon = document.getElementById('menuIcon');

    if (sidebar.style.left === '-240px') {
        sidebar.style.left = '0';
    } else {
        sidebar.style.left = '-240px';
    }
}

        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementsByClassName("main-content")[0].style.marginLeft = "250px";
            document.getElementById("menuIcon").style.display = "none";
            document.getElementById("myOverlay").classList.add("show");
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementsByClassName("main-content")[0].style.marginLeft = "0";
            document.getElementById("menuIcon").style.display = "block";
            document.getElementById("myOverlay").classList.remove("show");
        }
    </script>

</body>

</html>