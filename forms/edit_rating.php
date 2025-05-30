<?php
include_once '../config/koneksi.php';

// Ambil ID dari parameter URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data rating berdasarkan ID
$query = "SELECT * FROM rating WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data rating tidak ditemukan.";
    exit;
}

// Proses update saat form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rating           = $_POST['rating'];
    $presentase_bonus = $_POST['presentase_bonus'];

    $update = "UPDATE rating SET rating = '$rating', presentase_bonus = '$presentase_bonus' WHERE id = $id";

    if (mysqli_query($conn, $update)) {
        header("Location: ../index.php?page=rating");
        exit;
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Rating</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3 class="mb-4 text-center text-primary fw-bold">Edit Rating</h3>

  <form method="POST" class="card p-4 shadow-sm">
    <div class="mb-3">
      <label class="form-label">Rating</label>
      <input type="text" name="rating" class="form-control" value="<?= htmlspecialchars($data['rating']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Presentase Bonus (%)</label>
      <input type="number" name="presentase_bonus" class="form-control" value="<?= htmlspecialchars($data['presentase_bonus']) ?>" required>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="../index.php?page=rating" class="btn btn-secondary mt-2">Kembali</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
