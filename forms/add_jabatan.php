<?php
include_once '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama        = $_POST['nama'];
    $gaji_pokok  = $_POST['gaji_pokok'];
    $tunjangan   = $_POST['tunjangan'];

    $query = "INSERT INTO jabatan (nama, gaji_pokok, tunjangan)
              VALUES ('$nama', '$gaji_pokok', '$tunjangan')";

    if (mysqli_query($conn, $query)) {
        header("Location: ../index.php?page=jabatan");
        exit;
    } else {
        echo "Gagal menambahkan data jabatan: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Jabatan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3 class="mb-4 text-center text-primary fw-bold">Tambah Jabatan</h3>

  <form method="POST" class="card p-4 shadow-sm">
    <div class="mb-3">
      <label class="form-label">Nama Jabatan</label>
      <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Gaji Pokok</label>
      <input type="number" name="gaji_pokok" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Tunjangan</label>
      <input type="number" name="tunjangan" class="form-control" required>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="../index.php?page=jabatan" class="btn btn-secondary mt-2">Kembali</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
