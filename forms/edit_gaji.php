<?php
include_once '../config/koneksi.php';

// Ambil ID gaji dari parameter
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data gaji
$query = "SELECT * FROM gaji WHERE id = $id";
$result = mysqli_query($conn, $query);
$gaji = mysqli_fetch_assoc($result);

if (!$gaji) {
    echo "Data tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_karyawan      = $_POST['id_karyawan'];
    $id_lembur        = $_POST['id_lembur'];
    $periode_input    = $_POST['periode']; 
    $periode          = $periode_input . "-01"; 
    $lama_lembur      = $_POST['lama_lembur'];
    $total_lembur     = $_POST['total_lembur'];
    $total_bonus      = $_POST['total_bonus'];
    $total_tunjangan  = $_POST['total_tunjangan'];
    $total_pendapatan = $_POST['total_pendapatan'];

    // Update data
    $update = "
        UPDATE gaji SET
            id_karyawan = '$id_karyawan',
            id_lembur = '$id_lembur',
            periode = '$periode',
            lama_lembur = '$lama_lembur',
            total_lembur = '$total_lembur',
            total_bonus = '$total_bonus',
            total_tunjangan = '$total_tunjangan',
            total_pendapatan = '$total_pendapatan'
        WHERE id = $id
    ";

    if (mysqli_query($conn, $update)) {
        header("Location: ../index.php?page=gaji");
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
  <title>Edit Gaji</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3 class="mb-4 text-center text-primary fw-bold">Edit Gaji Karyawan</h3>

  <form method="POST" class="card p-4 shadow-sm">
    <div class="mb-3">
      <label class="form-label">Karyawan</label>
      <select name="id_karyawan" class="form-select" required>
        <option value="">-- Pilih Karyawan --</option>
        <?php
        $karyawan = mysqli_query($conn, "SELECT id, nama FROM karyawan");
        while ($k = mysqli_fetch_assoc($karyawan)) {
            $selected = $k['id'] == $gaji['id_karyawan'] ? 'selected' : '';
            echo "<option value='{$k['id']}' $selected>{$k['nama']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Lembur</label>
      <select name="id_lembur" class="form-select" required>
        <option value="">-- Pilih Jabatan Lembur --</option>
        <?php
        $lembur = mysqli_query($conn, "SELECT lembur.id, jabatan.nama FROM lembur JOIN jabatan ON lembur.id_jabatan = jabatan.id");
        while ($l = mysqli_fetch_assoc($lembur)) {
            $selected = $l['id'] == $gaji['id_lembur'] ? 'selected' : '';
            echo "<option value='{$l['id']}' $selected>Jabatan: {$l['nama']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Periode</label>
      <?php
      $periode_val = substr($gaji['periode'], 0, 7); // potong ke format YYYY-MM
      ?>
      <input type="month" name="periode" class="form-control" value="<?= $periode_val ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Lama Lembur (jam)</label>
      <input type="number" name="lama_lembur" class="form-control" value="<?= $gaji['lama_lembur'] ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Total Lembur (Rp)</label>
      <input type="number" name="total_lembur" class="form-control" value="<?= $gaji['total_lembur'] ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Total Bonus (Rp)</label>
      <input type="number" name="total_bonus" class="form-control" value="<?= $gaji['total_bonus'] ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Total Tunjangan (Rp)</label>
      <input type="number" name="total_tunjangan" class="form-control" value="<?= $gaji['total_tunjangan'] ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Total Pendapatan (Rp)</label>
      <input type="number" name="total_pendapatan" class="form-control" value="<?= $gaji['total_pendapatan'] ?>" required>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="../index.php?page=gaji" class="btn btn-secondary mt-2">Kembali</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
