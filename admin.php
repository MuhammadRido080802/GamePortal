<?php
// Memanggil atau membutuhkan file function.php
require 'function.php';

// Memulai session
session_start();

// Jika tidak ada session login, arahkan pengguna kembali ke halaman login
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Periksa apakah data pengguna telah disimpan dalam session
if (isset($_SESSION['username'])) {
    // Simpan nama pengguna dalam variabel
    $username = $_SESSION['username'];
} else {
    // Jika tidak ada data pengguna dalam session, berikan nilai default pada variabel
    $username = 'Tidak Diketahui';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GAME PORTAL</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- CSS untuk Sidebar -->
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

        .dataTables_filter label,
        .dataTables_length label {
            color: transparent; /* Mengubah warna teks menjadi hitam */
        }

        .dataTables_length,
        .dataTables_filter {
            display: flex; /* Mengatur kedua elemen dalam satu baris */
            align-items: center; /* Mengatur elemen vertikal di tengah */
        }

        .dataTable_length {
            display: none; /* Menempatkan "Show entries" di sebelah kiri */
        }

        /* Tambahkan CSS baru di sini */
        .dataTables_info {
            color: black; /* Mengatur warna teks menjadi hitam */
            text-align: left; /* Mengatur tampilan teks menjadi rata kiri */
        }
    </style>
</head>
<body>
<span id="menuIcon" class="menu-icon" onclick="toggleSidebar()">&#9776; GAME PORTAL <img src="img/bg/logo12.png" alt="Game Portal" class="game-portal-logo"></span>
<!-- Navbar -->
<nav  class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase fixed-top" style="padding-bottom: 2px; padding-top: 30px;">
    <div class="container">
        <!-- Ikon menu -->
        <div class="sidebar" id="sidebar">
            <ul class="left-align">
                <li></li>
                <li></li>
                <hr></hr>
                <li><a href="home.php"><i class="bi bi-house-door"></i> <span>Home</span></a></li>
                <li><a href="pemain.php"><i class="bi bi-joystick"></i> <span>Pemain</span></a></li>
                <li><a href="game.php"><i class="bi bi-controller"></i> <span>Game</span></a></li>
                <li><a href="about.php"><i class="bi bi-info-circle"></i> <span>About</span></a></li>
                <li><a href="logout.php"><i class="bi bi-box-arrow-right"></i> <span>Logout</span></a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Close Navbar -->
<!-- Container -->
<div class="container" style="padding-top: 80px;">
    
    </div>
    <div class="home-content">
    <h2 id="greeting"></h2>
    <h4 id="datetime"></h4>
</div>

<script>
    // Mengambil nilai username dari elemen dengan id 'username' dan menetapkannya ke dalam variabel JavaScript
    var username = "<?php echo htmlspecialchars($_SESSION['username']); ?>";

    function setGreeting() {
        const hours = new Date().getHours();
        let greeting;
        if (hours < 4) {
            greeting = 'Selamat Malam';
        } else if (hours < 10) {
            greeting = 'Selamat Pagi';
        } else if (hours < 15) {
            greeting = 'Selamat Siang';
        } else if (hours < 19) {
            greeting = 'Selamat Sore';
        } else {
            greeting = 'Selamat Malam';
        }
        // Menampilkan salam beserta nama pengguna dalam satu baris
        document.getElementById('greeting').innerText = greeting + ', ' + username;
    }


        function updateTime() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari',             'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

const day = days[now.getDay()];
const date = now.getDate();
const month = months[now.getMonth()];
const year = now.getFullYear();
let hour = now.getHours();
let minute = now.getMinutes();
let second = now.getSeconds();

// Padding nol jika waktu kurang dari 10
hour = hour < 10 ? '0' + hour : hour;
minute = minute < 10 ? '0' + minute : minute;
second = second < 10 ? '0' + second : second;

const dateTimeString = `${day}, ${date} ${month} ${year}, ${hour}:${minute}:${second}`;

document.getElementById('datetime').innerText = dateTimeString;

// Update waktu setiap detik
setTimeout(updateTime, 1000);
}

// Panggil fungsi untuk menetapkan salam
setGreeting();

// Panggil fungsi untuk mengupdate waktu
updateTime();
</script>

<!-- JavaScript untuk membuka dan menutup sidebar -->
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
</script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"></script>
<!-- Data Tables -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>

