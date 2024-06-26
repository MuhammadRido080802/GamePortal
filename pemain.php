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
// Menampilkan semua data dari table pemain berdasarkan nim secara Descending
$siswa = query("SELECT * FROM pemain ORDER BY nip DESC");
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
.dataTables_length {
    display: none; /* Menempatkan "Show entries" di sebelah kiri */
}
.dataTables_filter {
            justify-content: flex-end; /* Menempatkan "Search" di sebelah kanan */
            display: flex; /* Mengatur kedua elemen dalam satu baris */
            align-items: center; /* Mengatur elemen vertikal di tengah */
            margin-bottom: 10px; /* Menambahkan sedikit jarak bawah */
        }
    /* Tambahkan CSS baru di sini */
    .dataTables_info {
        color: black; /* Mengatur warna teks menjadi hitam */
        text-align: left; /* Mengatur tampilan teks menjadi rata kiri */
    }
</style>
    <title>GAME PORTAL</title>
</head>
<body>
    <span id="menuIcon" class="menu-icon" onclick="toggleSidebar()">&#9776; GAME PORTAL <img src="img/bg/logo12.png" alt="Game Portal" class="game-portal-logo"></span>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase fixed-top">
        <div class="container">
            <!-- Ikon menu -->
            <div class="sidebar" id="sidebar">
    <ul class="left-align">
        <li></li>
        <li></li>
        <hr></hr>
        <li><a href="admin.php"><i class="bi bi-house-door"></i> <span>Home</span></a></li>
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
            <h3 class="text-center fw-bold text-uppercase" style="color: red;">Data pemain</h3>
            <hr>
        </div>
    </div>
    <div class="row my-2 justify-content-end"> 
        <div class="col-md-auto"> 
            <a href="addData.php" class="btn btn-primary"><i class="bi bi-person-plus-fill"></i>&nbsp;Tambah Data</a>
            <a href="export.php" target="_blank" class="btn btn-success ms-1"><i class="bi bi-file-earmark-spreadsheet-fill"></i>&nbsp;Ekspor ke Excel</a>
        </div>
    </div>
        <div class="container-fluid">
    <div class="row my-3">
        <div class="col-md">
            <table id="data" class="table table-striped table-responsive table-hover text-center" style="width:100%">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Tier</th>
                        <th>Game yang Di Mainkan</th>
                        <th>Device</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($siswa as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['nip']; ?></td>
                            <td><?= $row['tier']; ?></td>
                            <td><?= $row['game_main']; ?></td>
                            <td><?= $row['device']; ?></td>                          
                            <td>
                                <button class="btn btn-success btn-sm text-white detail" data-id="<?= $row['nip']; ?>" style="font-weight: 600;"><i class="bi bi-info-circle-fill"></i>&nbsp;Detail</button> |

                                <a href="ubah.php?nip=<?= $row['nip']; ?>" class="btn btn-warning btn-sm" style="font-weight: 600;"><i class="bi bi-pencil-square"></i>&nbsp;Ubah</a> |

                                <a href="hapus.php?nip=<?= $row['nip']; ?>" class="btn btn-danger btn-sm" style="font-weight: 600;" onclick="return confirm('Apakah anda yakin ingin menghapus data <?= $row['nama']; ?> ?');"><i class="bi bi-trash-fill"></i>&nbsp;Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <!-- Close Container -->
    <!-- Overlay untuk menutup sidebar saat mengklik di luar menu -->
    <div class="overlay" onclick="closeNav()" id="myOverlay"></div>
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
    <!-- Modal Detail Data -->
    <div class="modal fade" id="detail" tabindex="-1" aria-labelledby="detail" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color: black"class="modal-title fw-bold text-uppercase" id="detail">Detail Data Pemain</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center" id="detail-siswa">
                </div>
            </div>
        </div>
    </div>
    <!-- Close Modal Detail Data -->
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <!-- Data Tables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
    <script>
$(document).ready(function() {
    // Fungsi Table
    $('#data').DataTable({
        dom: '<"row justify-content-between"l<"search-box"f>><"row justify-content-between"rtip>'
    });
    // Fungsi Table
    // Fungsi Detail
    $('.detail').click(function() {
        var dataSiswa = $(this).attr("data-id");
        $.ajax({
            url: "detail.php",
            method: "post",
            data: {
                dataSiswa,
                dataSiswa
            },
            success: function(data) {
                $('#detail-siswa').html(data);
                $('#detail').modal("show");
            }
        });
    });
    // Fungsi Detail
});
    </script>
</body>
</html>