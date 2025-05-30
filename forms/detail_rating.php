<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query_rating = mysqli_query($conn, "SELECT * FROM rating WHERE id = '$id'")
        or die("Query Error (rating): " . mysqli_error($conn));
    $data_rating = mysqli_fetch_assoc($query_rating);

    $query_jumlah = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM karyawan WHERE id_rating = '$id'")
        or die("Query Error (karyawan): " . mysqli_error($conn));
    $data_jumlah = mysqli_fetch_assoc($query_jumlah);
} else {
    echo "<div class='alert alert-danger'>ID rating tidak ditemukan.</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Rating</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <h3 class="text-center mb-4 text-primary fw-bold">DETAIL RATING</h3>
    <div class="card shadow rounded">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Rating</th>
                            <th>Persentase Bonus</th>
                            <th>Jumlah Karyawan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $data_rating['id']; ?></td>
                            <td><?= $data_rating['rating']; ?></td>
                            <td><?= $data_rating['presentase_bonus']; ?>%</td>
                            <td><?= $data_jumlah['jumlah']; ?> orang</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="../index.php?page=rating" class="btn btn-outline-secondary mt-3">← Kembali</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
