<?php
session_start();
// // Jika tidak bisa login maka balik ke login.php
// jika masuk ke halaman ini melalui url, maka langsung menuju halaman login
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}
// Memanggil atau membutuhkan file function.php
require 'function.php';

// Mengambil data dari nis dengan fungsi get
$nip = $_GET['nip'];

// Jika fungsi hapus jika data terhapus, maka munculkan alert dibawah
if (hapus_pemain($nip) > 0) {
    echo "<script>
                alert('Data pemain berhasil dihapus!');
                document.location.href = 'pemain.php';
            </script>";
} else {
    // Jika fungsi hapus jika data tidak terhapus, maka munculkan alert dibawah
    echo "<script>
            alert('Data siswa gagal dihapus!');
        </script>";
}
