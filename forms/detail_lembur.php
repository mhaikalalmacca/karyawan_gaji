<?php
include '../config/koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "
    SELECT lembur.*, jabatan.nama AS nama_jabatan, jabatan.gaji_pokok, jabatan.tunjangan
    FROM lembur
    JOIN jabatan ON lembur.id_jabatan = jabatan.id
    WHERE lembur.id = '$id'
");

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Lembur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <h3 class="text-center mb-4 text-primary fw-bold">DETAIL TARIF LEMBUR</h3>
    <div class="card shadow rounded">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Jabatan</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan</th>
                            <th>Tarif Lembur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $data['id'] ?></td>
                            <td><?= $data['nama_jabatan'] ?></td>
                            <td>Rp <?= number_format($data['gaji_pokok'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($data['tunjangan'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($data['tarif'], 0, ',', '.') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="../index.php?page=lembur" class="btn btn-outline-secondary mt-3">← Kembali</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
