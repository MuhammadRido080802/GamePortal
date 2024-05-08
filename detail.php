<?php
// Memanggil atau membutuhkan file function.php
require 'function.php';

// Jika Data pemain diklik maka
if (isset($_POST['dataSiswa'])) {
    $output = '';

    // mengambil data pemain dari nim 
    $sql = "SELECT * FROM pemain WHERE nip = '" . $_POST['dataSiswa'] . "'";
    $result = mysqli_query($koneksi, $sql);

    $output .= '<div class="table-responsive">
                        <table class="table table-bordered">';
    foreach ($result as $row) {
        $output .= '
                        <tr>
                            <th width="40%">nip</th>
                            <td width="60%">' . $row['nip'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Nama</th>
                            <td width="60%">' . $row['nama'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">tier</th>
                            <td width="60%">' . $row['tier'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">game_main</th>
                            <td width="60%">' . $row['game_main'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">device</th>
                            <td width="60%">' . $row['device'] . '</td>
                        </tr>
                        ';
    }
    $output .= '</table></div>';
    // Tampilkan $output
    echo $output;
}
