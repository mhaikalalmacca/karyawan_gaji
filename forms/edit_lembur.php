<?php
include_once '../config/koneksi.php';

// Ambil ID dari parameter URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data lembur berdasarkan ID
$query = "SELECT * FROM lembur WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data lembur tidak ditemukan.";
    exit;
}

// Proses update saat form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_jabatan = $_POST['id_jabatan'];
    $tarif      = $_POST['tarif'];

    $update = "UPDATE lembur SET id_jabatan = '$id_jabatan', tarif = '$tarif' WHERE id = $id";

    if (mysqli_query($conn, $update)) {
        header("Location: ../index.php?page=lembur");
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
  <title>Edit Lembur</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3 class="mb-4 text-center text-primary fw-bold">Edit Lembur</h3>

  <form method="POST" class="card p-4 shadow-sm">
    <div class="mb-3">
      <label class="form-label">ID Jabatan</label>
      <input type="text" name="id_jabatan" class="form-control" value="<?= htmlspecialchars($data['id_jabatan']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Tarif</label>
      <input type="number" name="tarif" class="form-control" value="<?= htmlspecialchars($data['tarif']) ?>" required>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="../index.php?page=lembur" class="btn btn-secondary mt-2">Kembali</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
