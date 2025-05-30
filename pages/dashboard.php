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

    <h4 class="fw-bold mt-5 mb-3">Karyawan Terbaru</h4>
    <div class="table-responsive">
      <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-primary">
          <tr>
            <th>No</th>
            <th>Jabatan</th>
            <th>Rating</th>
            <th>Nama</th>
            <th>Divisi</th>
            <th>Umur</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($row['nama_jabatan']) ?></td>
              <td><?= htmlspecialchars($row['rating'] ?? '-') ?></td>
              <td><?= htmlspecialchars($row['nama']) ?></td>
              <td><?= htmlspecialchars($row['divisi']) ?></td>
              <td><?= htmlspecialchars($row['umur']) ?></td>
              <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
              <td><?= htmlspecialchars($row['alamat']) ?></td>
              <td><?= htmlspecialchars($row['status']) ?></td>
              <td>
                <div class="d-flex justify-content-center gap-2 flex-wrap">
                  <a href="forms/detail_karyawan.php?id=<?= $row['id'] ?>&from=dashboard" class="btn btn-info btn-sm px-3">
                    <i class="bi bi-eye"></i>
                  </a>
                  <a href="forms/edit_karyawan.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm px-3">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <a href="forms/hapus_karyawan.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm px-3" onclick="return confirm('Yakin ingin menghapus?')">
                    <i class="bi bi-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

  </div>
</div>
