<?php 
include_once '../config/koneksi.php';

$query = "SELECT * FROM jabatan ORDER BY id ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Jabatan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Tambahan penting -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <h3 class="text-center mb-4 text-primary fw-bold">DAFTAR JABATAN</h3>

    <div class="card shadow rounded">
        <div class="card-body">
            <!-- Tambahkan wrapper agar tabel bisa di-scroll di layar kecil -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Jabatan</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan</th>
                            <th>Total Gaji</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while ($jabatan = mysqli_fetch_assoc($result)) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($jabatan['nama']) ?></td>
                                <td>Rp <?= number_format($jabatan['gaji_pokok'], 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($jabatan['tunjangan'], 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($jabatan['gaji_pokok'] + $jabatan['tunjangan'], 0, ',', '.') ?></td>
                                <td><?= date('d M Y', strtotime($jabatan['created_at'])) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <a href="../index.php?page=jabatan" class="btn btn-outline-secondary mt-3">← Kembali</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>