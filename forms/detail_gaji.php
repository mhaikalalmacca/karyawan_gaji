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
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Gaji Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<div class="container my-5">
    <h3 class="text-center mb-4 text-primary fw-bold">DETAIL GAJI KARYAWAN</h3>
    <div class="card shadow rounded">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                            <th>Periode</th>
                            <th>Lama Lembur</th>
                            <th>Tarif Lembur</th>
                            <th>Total Lembur</th>
                            <th>Total Bonus</th>
                            <th>Total Tunjangan</th>
                            <th>Total Pendapatan</th>
                            <th>Tanggal Input</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= htmlspecialchars($data['nama']) ?></td>
                            <td><?= htmlspecialchars($data['nama_jabatan']) ?></td>
                            <td><?= $data['umur'] ?> tahun</td>
                            <td><?= $data['jenis_kelamin'] ?></td>
                            <td><?= $data['status'] ?></td>
                            <td><?= $data['periode'] ?></td>
                            <td><?= $data['lama_lembur'] ?> jam</td>
                            <td>Rp <?= number_format($data['tarif'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($data['total_lembur'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($data['total_bonus'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($data['total_tunjangan'], 0, ',', '.') ?></td>
                            <td><strong>Rp <?= number_format($data['total_pendapatan'], 0, ',', '.') ?></strong></td>
                            <td><?= date('d M Y', strtotime($data['created_at'])) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="../index.php?page=gaji" class="btn btn-outline-secondary mt-3">← Kembali</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
