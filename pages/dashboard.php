<?php
include 'config/koneksi.php';
$nama_user = $_SESSION['nama'] ?? 'User';

// Total data
$total_karyawan = $conn->query("SELECT COUNT(*) AS total FROM karyawan")->fetch_assoc()['total'];
$total_jabatan  = $conn->query("SELECT COUNT(*) AS total FROM jabatan")->fetch_assoc()['total'];
$total_rating   = $conn->query("SELECT COUNT(*) AS total FROM rating")->fetch_assoc()['total'];

// 3 karyawan terbaru
$query = "SELECT karyawan.*, jabatan.nama AS nama_jabatan, rating.rating
          FROM karyawan
          JOIN jabatan ON karyawan.id_jabatan = jabatan.id
          LEFT JOIN rating ON karyawan.id_rating = rating.id
          ORDER BY karyawan.id DESC
          LIMIT 3";
$result = mysqli_query($conn, $query);

function generateStars($count) {
  $stars = '';
  $count = (int)$count;
  for ($i = 0; $i < $count; $i++) {
    $stars .= '⭐';
  }
  return $stars ?: '-';
}
?>

<div class="main-content">
  <div class="container">

    <marquee class="p-3 mb-4 bg-info rounded shadow-sm text-white fw-bold" behavior="scroll" direction="left" scrollamount="6">
      Selamat datang di Sistem Manajemen Gaji PT. KEISYA! 🎉
    </marquee>

    <div class="text-center mb-5">
      <h1 class="fw-bold">SELAMAT DATANG DI PT. KEISYA</h1>
    </div>

    <div class="row mb-4">
      <div class="col-md-4 mb-3">
        <div class="d-flex justify-content-between align-items-center p-4 bg-white rounded shadow border-start border-4 border-primary">
          <div>
            <p class="mb-1 text-muted">TOTAL KARYAWAN</p>
            <h3 class="fw-bold"><?= $total_karyawan ?></h3>
          </div>
          <i class="bi bi-people fs-1 text-primary"></i>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="d-flex justify-content-between align-items-center p-4 bg-white rounded shadow border-start border-4 border-success">
          <div>
            <p class="mb-1 text-muted">TOTAL JABATAN</p>
            <h3 class="fw-bold"><?= $total_jabatan ?></h3>
          </div>
          <i class="bi bi-briefcase fs-1 text-success"></i>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="d-flex justify-content-between align-items-center p-4 bg-white rounded shadow border-start border-4 border-warning">
          <div>
            <p class="mb-1 text-muted">TOTAL RATING</p>
            <h3 class="fw-bold"><?= $total_rating ?></h3>
          </div>
          <i class="bi bi-star fs-1 text-warning"></i>
        </div>
      </div>
    </div>

    <h3 class="mb-3">Karyawan Terbaru</h3>
    <div class="row">
      <?php while($row = mysqli_fetch_assoc($result)) : 
        $gender = $row['jenis_kelamin'] ?? 'lski';
        $gambar = ($gender == 'Perempuan') ? 'girl.jpg' : 'man.jpg';
        $foto = !empty($row['foto']) ? $row['foto'] : $gambar;
      ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="assets/image/<?= htmlspecialchars($foto) ?>" class="card-img-top" alt="Foto Karyawan">
            <div class="card-body text-center">
              <h5 class="card-title"><?= htmlspecialchars($row['nama']) ?></h5>
              <p class="card-text star-rating"><?= generateStars($row['rating']) ?></p>
              <strong><p class="card-text"><?= htmlspecialchars($row['nama_jabatan']) ?></p></strong>
            </div>
            <div class="card-footer d-flex justify-content-between">
              <a href="forms/detail_karyawan-1.php?id=<?= $row['id'] ?>&from=dashboard" class="btn btn-info btn-sm"><i class="bi bi-info-circle"></i></a>
              <a href="forms/edit_karyawan-1.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
              <a href="forms/hapus_karyawan-1.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash3-fill"></i></a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
