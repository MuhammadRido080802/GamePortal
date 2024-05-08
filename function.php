<?php
// Koneksi Database
$koneksi = mysqli_connect("localhost", "root", "", "db_gameportal");

function query($query)
{
    // Koneksi database
    global $koneksi;

    $result = mysqli_query($koneksi, $query);

    // membuat varibale array
    $rows = [];

    // mengambil semua data dalam bentuk array
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// Membuat fungsi tambah game
function tambah_game($data)
{
    global $koneksi;
    
    $nama_game = htmlspecialchars($data['nama_game']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $tanggal = htmlspecialchars($data['tanggal']);
    $platform = htmlspecialchars($data['platform']);
    $ulasan = htmlspecialchars($data['ulasan']);

    $sql = "INSERT INTO game(tanggal, nama_game, deskripsi, platform, ulasan) VALUES ('$tanggal','$nama_game','$deskripsi','$platform','$ulasan')";

    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}

// Membuat fungsi hapus game berdasarkan nama game
function hapus_game($nama_game)
{
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM game WHERE nama_game = '$nama_game'");
    return mysqli_affected_rows($koneksi);
}

// Membuat fungsi ubah game
function ubah_game($data)
{
    global $koneksi;
    $nama_game = htmlspecialchars($data['nama_game']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $tanggal = htmlspecialchars($data['tanggal']);
    $platform = htmlspecialchars($data['platform']);
    $ulasan = htmlspecialchars($data['ulasan']);
    $sql = "UPDATE game SET deskripsi = '$deskripsi', tanggal = '$tanggal', platform = '$platform', ulasan = '$ulasan' WHERE nama_game = '$nama_game'";
    mysqli_query($koneksi, $sql);
    return mysqli_affected_rows($koneksi);
}


// Membuat fungsi tambah pemain
function tambah_pemain($data)
{
    global $koneksi;

    $nip = htmlspecialchars($data['nip']);
    $nama = htmlspecialchars($data['nama']);
    $tier = htmlspecialchars($data['tier']);
    $game_main = htmlspecialchars($data['game_main']);
    $device = htmlspecialchars($data['device']);

    $sql = "INSERT INTO pemain (nip, nama, tier, game_main, device) VALUES ('$nip','$nama','$tier','$game_main','$device')";

    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}
    


// Membuat fungsi hapus
function hapus_pemain($nip)
{
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM pemain WHERE nip = $nip");
    return mysqli_affected_rows($koneksi);
}



// Membuat fungsi ubah pemain
function ubah_pemain($data)
{
    global $koneksi;

    $nip = htmlspecialchars($data['nip']);
    $nama = htmlspecialchars($data['nama']);
    $tier = htmlspecialchars($data['tier']);
    $game_main = htmlspecialchars($data['game_main']);
    $device = htmlspecialchars($data['device']);

    // Jika gambar diubah, lakukan pengunggahan gambar baru
    if ($_FILES['game_main']['error'] === 0) {
        // Mengambil informasi file gambar
        $nama_file = $_FILES['game_main']['name'];
        $ukuran_file = $_FILES['game_main']['size'];
        $tmp_file = $_FILES['game_main']['tmp_name'];

        // Tentukan lokasi penyimpanan gambar di server
        $lokasi = 'uploads/';

        // Pindahkan file gambar ke lokasi penyimpanan di server
        if(move_uploaded_file($tmp_file, $lokasi.$nama_file)) {
            // Jika pengunggahan berhasil, update data pemain dengan gambar baru
            $sql = "UPDATE pemain SET nama = '$nama', tier = '$tier', game_main = '$game_main', device = '$device', gambar = '$nama_file' WHERE nip = '$nip'";
            mysqli_query($koneksi, $sql);
            return mysqli_affected_rows($koneksi);
        } else {
            // Jika pengunggahan gambar baru gagal, kembalikan false
            return false;
        }
    } else {
        // Jika tidak ada perubahan gambar, update data pemain tanpa mengubah gambar
        $sql = "UPDATE pemain SET nama = '$nama', tier = '$tier', game_main = '$game_main', device = '$device' WHERE nip = '$nip'";

    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
    }

    
}

