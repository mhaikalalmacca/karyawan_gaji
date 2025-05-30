<?php
include_once '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_jabatan = $_POST['id_jabatan'];
    $tarif      = $_POST['tarif'];

    $query = "INSERT INTO lembur (id_jabatan, tarif) VALUES ('$id_jabatan', '$tarif')";

    if (mysqli_query($conn, $query)) {
        header("Location: ../index.php?page=lembur");
        exit;
    } else {
        echo "Gagal menambahkan data lembur: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Data Lembur</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3 class="mb-4 text-center text-primary fw-bold">Tambah Data Lembur</h3>

  <form method="POST" class="card p-4 shadow-sm">
    <div class="mb-3">
      <label class="form-label">Jabatan</label>
      <select name="id_jabatan" class="form-select" required>
        <option value="">-- Pilih Jabatan --</option>
        <?php
        $jabatan = mysqli_query($conn, "SELECT * FROM jabatan");
        while ($row = mysqli_fetch_assoc($jabatan)) {
            echo "<option value='{$row['id']}'>{$row['nama']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Tarif Lembur (Rp)</label>
      <input type="number" name="tarif" class="form-control" required>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="../index.php?page=lembur" class="btn btn-secondary mt-2">Kembali</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
