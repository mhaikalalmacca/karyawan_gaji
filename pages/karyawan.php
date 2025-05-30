<?php
include 'config/koneksi.php';

$query = "SELECT karyawan.*, jabatan.nama AS nama_jabatan, rating.rating
          FROM karyawan
          JOIN jabatan ON karyawan.id_jabatan = jabatan.id
          LEFT JOIN rating ON karyawan.id_rating = rating.id
          ORDER BY karyawan.id DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}

function generateStars($count) {
    $stars = '';
    $count = (int)$count;
    for ($i = 0; $i < $count; $i++) {
        $stars .= '⭐';
    }
    return $stars ?: '-';
}
?>

<div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
        <h2 class="m-0">Daftar Karyawan</h2>
        <a href="forms/add_karyawan.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Karyawan
        </a>
    </div>


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
