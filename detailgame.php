<?php
// Memanggil atau membutuhkan file function.php
require 'function.php';

// Jika Data game diklik maka
if (isset($_POST['dataGame'])) {
    $output = '';

    // mengambil data game dari nim 
    $sql = "SELECT * FROM game WHERE nama_game = '" . $_POST['dataGame'] . "'";
    $result = mysqli_query($koneksi, $sql);

    $output .= '<div class="table-responsive">
                        <table class="table table-bordered">';
    foreach ($result as $row) {
        $output .= '
                        <tr>
                            <th width="40%">nama_game</th>
                            <td width="60%">' . $row['nama_game'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">deskripsi</th>
                            <td width="60%">' . $row['deskripsi'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">tanggal</th>
                            <td width="60%">' . $row['tanggal'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">platform</th>
                            <td width="60%">' . $row['platform'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">ulasan</th>
                            <td width="60%">' . $row['ulasan'] . '</td>
                        </tr>
                        ';
    }
    $output .= '</table></div>';
    // Tampilkan $output
    echo $output;
}
