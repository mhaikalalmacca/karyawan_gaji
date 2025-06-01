<?php
include_once '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_karyawan      = $_POST['id_karyawan'];
    $id_lembur        = $_POST['id_lembur'];
    $periode_input    = $_POST['periode']; // format: 2025-06
    $periode          = $periode_input . "-01"; // ubah jadi 2025-06-01
    $lama_lembur      = $_POST['lama_lembur'];
    $total_lembur     = $_POST['total_lembur'];
    $total_bonus      = $_POST['total_bonus'];
    $total_tunjangan  = $_POST['total_tunjangan'];
    $total_pendapatan = $_POST['total_pendapatan'];
    $created_at       = date('Y-m-d');

    $query = "INSERT INTO gaji (
        id_karyawan, id_lembur, periode, lama_lembur, total_lembur, 
        total_bonus, total_tunjangan, total_pendapatan, created_at
    ) VALUES (
        '$id_karyawan', '$id_lembur', '$periode', '$lama_lembur', '$total_lembur',
        '$total_bonus', '$total_tunjangan', '$total_pendapatan', '$created_at'
    )";

    if (mysqli_query($conn, $query)) {
        header("Location: ../index.php?page=gaji");
        exit;
    } else {
        echo "Gagal menambahkan data gaji: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Data Gaji</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3 class="mb-4 text-center text-primary fw-bold">Tambah Data Gaji</h3>

  <form method="POST" class="card p-4 shadow-sm">
    <div class="mb-3">
      <label class="form-label">Karyawan</label>
      <select name="id_karyawan" class="form-select" required>
        <option value="">-- Pilih Karyawan --</option>
        <?php
        $karyawan = mysqli_query($conn, "SELECT * FROM karyawan");
        while ($row = mysqli_fetch_assoc($karyawan)) {
            echo "<option value='{$row['id']}'>{$row['nama']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Jabatan</label>
      <select name="id_lembur" class="form-select" required>
        <option value="">-- Pilih Jabatan --</option>
        <?php
        $lembur = mysqli_query($conn, "SELECT lembur.id, jabatan.nama FROM lembur JOIN jabatan ON lembur.id_jabatan = jabatan.id");
        while ($row = mysqli_fetch_assoc($lembur)) {
            echo "<option value='{$row['id']}'>Jabatan: {$row['nama']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Periode</label>
      <input type="month" name="periode" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Lama Lembur (jam)</label>
      <input type="number" name="lama_lembur" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Total Lembur (Rp)</label>
      <input type="number" name="total_lembur" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Total Bonus (Rp)</label>
      <input type="number" name="total_bonus" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Total Tunjangan (Rp)</label>
      <input type="number" name="total_tunjangan" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Total Pendapatan (Rp)</label>
      <input type="number" name="total_pendapatan" class="form-control" required>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="../index.php?page=gaji" class="btn btn-secondary mt-2">Kembali</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
