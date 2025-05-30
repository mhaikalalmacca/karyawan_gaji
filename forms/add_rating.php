<?php
include_once '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rating           = $_POST['rating'];
    $presentase_bonus = $_POST['presentase_bonus'];

    $query = "INSERT INTO rating (rating, presentase_bonus)
              VALUES ('$rating', '$presentase_bonus')";

    if (mysqli_query($conn, $query)) {
        header("Location: ../index.php?page=rating");
        exit;
    } else {
        echo "Gagal menambahkan data rating: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Rating</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3 class="mb-4 text-center text-primary fw-bold">Tambah Rating</h3>

  <form method="POST" class="card p-4 shadow-sm">
    <div class="mb-3">
      <label class="form-label">Rating</label>
      <input type="text" name="rating" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Presentase Bonus (%)</label>
      <input type="number" name="presentase_bonus" class="form-control" required>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="../index.php?page=rating" class="btn btn-secondary mt-2">Kembali</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</bod
