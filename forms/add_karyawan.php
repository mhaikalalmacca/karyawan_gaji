<?php
include_once '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama          = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat        = $_POST['alamat'];
    $divisi        = $_POST['divisi'];
    $umur          = $_POST['umur'];
    $status        = $_POST['status'];
    $id_jabatan    = $_POST['id_jabatan'];
    $id_rating     = $_POST['id_rating'];
    $created_at    = date('Y-m-d');

$query = "INSERT INTO karyawan (nama, jenis_kelamin, alamat, divisi, status, umur, id_jabatan, id_rating, created_at)
          VALUES ('$nama', '$jenis_kelamin', '$alamat', '$divisi', '$status', '$umur', '$id_jabatan', '$id_rating', '$created_at')";


    if (mysqli_query($conn, $query)) {
        header("Location: ../index.php?page=karyawan");
        exit;
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Karyawan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3 class="mb-4 text-center text-primary fw-bold">Tambah Karyawan</h3>

  <form method="POST" class="card p-4 shadow-sm">
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Jenis Kelamin</label>
      <select name="jenis_kelamin" class="form-select" required>
        <option value="Pria">Pria</option>
        <option value="Perempuan">Perempuan</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <textarea name="alamat" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Divisi</label>
      <input type="text" name="divisi" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Status</label>
      <input type="text" name="status" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Umur</label>
      <input type="number" name="umur" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Jabatan</label>
      <select name="id_jabatan" class="form-select" required>
        <?php
        $jabatan = mysqli_query($conn, "SELECT * FROM jabatan");
        while ($row = mysqli_fetch_assoc($jabatan)) {
            echo "<option value='{$row['id']}'>{$row['nama']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Rating</label>
      <select name="id_rating" class="form-select">
        <option value="">-- Pilih Rating --</option>
        <?php
        $rating = mysqli_query($conn, "SELECT * FROM rating");
        while ($r = mysqli_fetch_assoc($rating)) {
            echo "<option value='{$r['id']}'>{$r['rating']} ⭐</option>";
        }
        ?>
      </select>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="../index.php?page=karyawan" class="btn btn-secondary mt-2">Kembali</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
