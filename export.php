<?php
// Memanggil atau membutuhkan file function.php
require 'function.php';

// Menampilkan semua data dari table pemain berdasarkan nim secara Descending
$siswa = query("SELECT * FROM pemain ORDER BY nip DESC");

// Membuat nama file
$filename = "data pemain " . date('Ymd') . ".xls";

// export ke excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Pemain.xls");

?>
<table class="text-center" border="1">
    <thead class="text-center">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>NIP</th>
            <th>Tier</th>
            <th>Game Yang Di Mainkan</th>
            <th>Device</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php $no = 1; ?>
        <?php foreach ($siswa as $row) : ?>
            <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['nip']; ?></td>
            <td><?= $row['tier']; ?></td>
            <td><?= $row['game_main']; ?></td>
            <td><?= $row['device']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>