<?php
include '../config/koneksi.php';

$id = $_GET['id']; // Ambil ID lembur dari URL

$query = mysqli_query($conn, "
    SELECT lembur.*, jabatan.nama AS nama_jabatan, jabatan.gaji_pokok, jabatan.tunjangan
    FROM lembur
    JOIN jabatan ON lembur.id_jabatan = jabatan.id
    WHERE lembur.id = '$id'
");

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-center">Detail Tarif Lembur</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 200px;">ID Lembur</th>
                    <td><?= $data['id'] ?></td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td><?= $data['nama_jabatan'] ?></td>
                </tr>
                <tr>
                    <th>Gaji Pokok</th>
                    <td>Rp <?= number_format($data['gaji_pokok'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Tunjangan</th>
                    <td>Rp <?= number_format($data['tunjangan'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Tarif Lembur</th>
                    <td>Rp <?= number_format($data['tarif'], 0, ',', '.') ?></td>
                </tr>
            </table>
            <a href="../index.php?page=lembur" class="btn btn-outline-secondary mt-3">← Kembali</a>
        </div>
    </div>
</div>

</body>
</html>

