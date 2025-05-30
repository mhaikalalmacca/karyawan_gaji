<?php
include_once '../config/koneksi.php';

// Ambil ID karyawan dari parameter
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data karyawan
$query = "SELECT * FROM karyawan WHERE id = $id";
$result = mysqli_query($conn, $query);
$karyawan = mysqli_fetch_assoc($result);

if (!$karyawan) {
    echo "Data tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama          = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat        = $_POST['alamat'];
    $divisi        = $_POST['divisi'];
    $status        = $_POST['status'];
    $umur          = $_POST['umur'];
    $id_jabatan    = $_POST['id_jabatan'];
    $id_rating     = $_POST['id_rating'];

    // Update data
    $update = "
        UPDATE karyawan SET
            nama = '$nama',
            jenis_kelamin = '$jenis_kelamin',
            alamat = '$alamat',
            divisi = '$divisi',
            status = '$status',
            umur = '$umur',
            id_jabatan = '$id_jabatan',
            id_rating = '$id_rating'
        WHERE id = $id
    ";

    if (mysqli_query($conn, $update)) {
        header("Location: ../index.php?page=dashboard");
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
  <title>Edit Karyawan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3 class="mb-4 text-center text-primary fw-bold">Edit Karyawan</h3>

  <form method="POST" class="card p-4 shadow-sm">
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($karyawan['nama']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Jenis Kelamin</label>
      <select name="jenis_kelamin" class="form-select" required>
        <option value="Laki-laki" <?= $karyawan['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
        <option value="Perempuan" <?= $karyawan['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <textarea name="alamat" class="form-control" required><?= htmlspecialchars($karyawan['alamat']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Divisi</label>
      <input type="text" name="divisi" class="form-control" value="<?= htmlspecialchars($karyawan['divisi']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Status</label>
      <input type="text" name="status" class="form-control" value="<?= htmlspecialchars($karyawan['status']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Umur</label>
      <input type="number" name="umur" class="form-control" value="<?= $karyawan['umur'] ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Jabatan</label>
      <select name="id_jabatan" class="form-select" required>
        <?php
        $jabatan = mysqli_query($conn, "SELECT * FROM jabatan");
        while ($row = mysqli_fetch_assoc($jabatan)) {
            $selected = $row['id'] == $karyawan['id_jabatan'] ? 'selected' : '';
            echo "<option value='{$row['id']}' $selected>{$row['nama']}</option>";
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
            $selected = $r['id'] == $karyawan['id_rating'] ? 'selected' : '';
            echo "<option value='{$r['id']}' $selected>{$r['rating']} ⭐</option>";
        }
        ?>
      </select>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="../index.php?page=dashboard" class="btn btn-secondary mt-2">Kembali</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
