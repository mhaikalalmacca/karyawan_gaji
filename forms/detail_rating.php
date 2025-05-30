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
            <h4 class="mb-0 text-center">Detail Tarif Rating</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
            <tr>
                    <th  style="width: 200px;">ID</th>
                    <td><?= $data_rating['id']; ?></td>
                </tr>
                <tr>
                    <th>Rating</th>
                    <td><?= $data_rating['rating']; ?></td>
                </tr>
                <tr>
                    <th>Persentase Bonus</th>
                    <td><?= $data_rating['presentase_bonus']; ?>%</td>
                </tr>
                <tr>
                    <th>Jumlah Karyawan</th>
                    <td><?= $data_jumlah['jumlah']; ?> orang</td>
                </tr>
            </table>
            <a href="../index.php?page=rating" class="btn btn-outline-secondary mt-3">← Kembali</a>
        </div>
    </div>
</div>

</body>
</html>