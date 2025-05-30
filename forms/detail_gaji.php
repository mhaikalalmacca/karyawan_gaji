<?php
include '../config/koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID gaji tidak ditemukan.";
    exit;
}

$id = $_GET['id'];

$query = "
    SELECT g.*, k.nama, k.umur, k.jenis_kelamin, k.status,
           l.tarif, j.nama AS nama_jabatan
    FROM gaji g
    JOIN karyawan k ON g.id_karyawan = k.id
    LEFT JOIN lembur l ON g.id_lembur = l.id
    LEFT JOIN jabatan j ON k.id_jabatan = j.id
    WHERE g.id = ?
";


$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Query error: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Data gaji tidak ditemukan.";
    exit;
}

$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Gaji Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Detail Gaji Karyawan</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 200px;">Nama</th>
                    <td><?= htmlspecialchars($data['nama']) ?></td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td><?= htmlspecialchars($data['nama_jabatan']) ?></td>
                </tr>
                <tr>
                    <th>Umur</th>
                    <td><?= $data['umur'] ?> tahun</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td><?= $data['jenis_kelamin'] ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?= $data['status'] ?></td>
                </tr>
                <tr>
                    <th>Periode</th>
                    <td><?= $data['periode'] ?></td>
                </tr>
                <tr>
                    <th>Lama Lembur</th>
                    <td><?= $data['lama_lembur'] ?> jam</td>
                </tr>
                <tr>
                    <th>Tarif Lembur</th>
                    <td>Rp <?= number_format($data['tarif'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Total Lembur</th>
                    <td>Rp <?= number_format($data['total_lembur'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Total Bonus</th>
                    <td>Rp <?= number_format($data['total_bonus'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Total Tunjangan</th>
                    <td>Rp <?= number_format($data['total_tunjangan'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Total Pendapatan</th>
                    <td><strong>Rp <?= number_format($data['total_pendapatan'], 0, ',', '.') ?></strong></td>
                </tr>
                <tr>
                    <th>Tanggal Input</th>
                    <td><?= $data['created_at'] ?? '-' ?></td>
                </tr>
            </table>
            <a href="../index.php?page=gaji" class="btn btn-outline-secondary mt-3">← Kembali</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>