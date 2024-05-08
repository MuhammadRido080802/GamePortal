<?php
// Memanggil atau membutuhkan file function.php
require '../function.php';

// Jika Data Mahasiswa diklik maka
if (isset($_POST['dataSiswa'])) {
    $output = '';

    // mengambil data Mahasiswa dari nim 
    $sql = "SELECT * FROM game WHERE tanggal = '" . $_POST['dataSiswa'] . "'";
    $result = mysqli_query($koneksi, $sql);

    $output .= '<div class="table-responsive">
                        <table class="table table-bordered">';
    foreach ($result as $row) {
        $output .= '
                        <tr>
                            <th width="40%">Tanggal</th>
                            <td width="60%">' . $row['tanggal'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Nama</th>
                            <td width="60%">' . $row['nama'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Tier</th>
                            <td width="60%">' . $row['tier'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Game yang Dimainkan</th>
                            <td width="60%">' . $row['game_main'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Device</th>
                            <td width="60%">' . $row['device'] . '</td>
                        </tr>
                        ';
    }
    $output .= '</table></div>';
    // Tampilkan $output
    echo $output;
}
