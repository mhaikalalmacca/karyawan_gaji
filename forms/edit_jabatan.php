<?php
include_once '../config/koneksi.php';

// Ambil ID jabatan dari parameter
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data jabatan
$query = "SELECT * FROM jabatan WHERE id = $id";
$result = mysqli_query($conn, $query);
$jabatan = mysqli_fetch_assoc($result);

if (!$jabatan) {
    echo "Data jabatan tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama        = $_POST['nama'];
    $gaji_pokok  = $_POST['gaji_pokok'];
    $tunjangan   = $_POST['tunjangan'];

    // Update data
    $update = "
        UPDATE jabatan SET
            nama = '$nama',
            gaji_pokok = '$gaji_pokok',
            tunjangan = '$tunjangan'
        WHERE id = $id
    ";

    if (mysqli_query($conn, $update)) {
        header("Location: ../index.php?page=jabatan");
        exit;
    } else {
        echo "Gagal mengupdate data jabatan: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Jabatan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3 class="mb-4 text-center text-Primary fw-bold">Edit Jabatan</h3>

  <form method="POST" class="card p-4 shadow-sm">
    <div class="mb-3">
      <label class="form-label">Nama Jabatan</label>
      <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($jabatan['nama']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Gaji Pokok</label>
      <input type="number" name="gaji_pokok" class="form-control" value="<?= $jabatan['gaji_pokok'] ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Tunjangan</label>
      <input type="number" name="tunjangan" class="form-control" value="<?= $jabatan['tunjangan'] ?>" required>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="../index.php?page=jabatan" class="btn btn-secondary mt-2">Kembali</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
