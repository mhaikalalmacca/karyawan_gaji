<?php 
include_once '../config/koneksi.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;


$from = $_GET['from'] ?? 'karyawan'; // default kalau tidak dikirim dari dashboard

$query = "
    SELECT k.*, j.nama AS jabatan, r.rating AS rating
    FROM karyawan k
    LEFT JOIN jabatan j ON k.id_jabatan = j.id
    LEFT JOIN rating r ON k.id_rating = r.id
    WHERE k.id = $id
";
$from = $_GET['from'] ?? 'karyawan'; // default kalau tidak dikirim dari dashboard
$result = mysqli_query($conn, $query);
$karyawan = mysqli_fetch_assoc($result);

if (!$karyawan) {
    echo "Data tidak ditemukan.";
    exit;
}


// Tentukan gambar
$gender = $karyawan['jenis_kelamin'] ?? 'Laki-laki';
$gambar = ($gender == 'Perempuan') ? 'girl.jpg' : 'man.jpg';
$foto = !empty($karyawan['foto']) ? $karyawan['foto'] : $gambar;  
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .rating i {
            color: gold;
        }
        .card-img-top {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h3 class="text-center mb-4 text-primary fw-bold">DETAIL KARYAWAN</h3>

    <div class="card shadow rounded">
        <div class="row g-0">
          
            <!-- Kolom Gambar dan Rating -->
            <div class="col-md-4 text-center p-4">
            <img src="../assets/image/<?= htmlspecialchars($foto) ?>" class="card-img-top img-fluid" alt="Foto Karyawan">

                <div class="mt-3 fw-semibold">Rating:</div>
                <div class="rating">
                    <?php for ($i = 0; $i < $karyawan['rating']; $i++): ?>
                        <i class="bi bi-star-fill"></i>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Kolom Detail -->
            <div class="col-md-8 p-4">
                <table class="table table-borderless">
                    <tr><th>Nama</th><td>: <?= $karyawan['nama'] ?></td></tr>
                    <tr><th>Jenis Kelamin</th><td>: <?= $karyawan['jenis_kelamin'] ?></td></tr>
                    <tr><th>Alamat</th><td>: <?= $karyawan['alamat'] ?></td></tr>
                    <tr><th>Divisi</th><td>: <?= $karyawan['divisi'] ?></td></tr>
                    <tr><th>Umur</th><td>: <?= $karyawan['umur'] ?></td></tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>: <span class="badge bg-primary"><?= $karyawan['jabatan'] ?></span></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: <span class="badge bg-success"><?= $karyawan['status'] ?></span></td>
                    </tr>
                    <tr><th>Tanggal Bergabung</th><td>: <?= date('d M Y', strtotime($karyawan['created_at'])) ?></td></tr>
                </table>

                <div class="mt-4">
                <a href="../index.php?page=karyawan" class="btn btn-outline-secondary">← Kembali</a>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
