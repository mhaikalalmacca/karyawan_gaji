<?php 
include 'config/koneksi.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Tarif Lembur</h2>
    <a href="forms/add_lembur.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Tarif Lembur
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Jabatan</th>
                <th>Tarif</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($conn, "
                SELECT lembur.id, jabatan.nama AS nama_jabatan, lembur.tarif
                FROM lembur
                JOIN jabatan ON lembur.id_jabatan = jabatan.id
            ");
            while ($data = mysqli_fetch_assoc($query)) {
                echo "<tr>
                        <td>$no</td>
                        <td>" . htmlspecialchars($data['nama_jabatan']) . "</td>
                        <td>Rp " . number_format($data['tarif'], 0, ',', '.') . "</td>
                        <td>
                            <div class='d-flex justify-content-center flex-wrap gap-2'>
                                <a href='forms/detail_lembur.php?id={$data['id']}' class='btn btn-info btn-sm px-3'>
                                    <i class='bi bi-eye'></i>
                                </a>
                                <a href='forms/edit_lembur.php?id={$data['id']}' class='btn btn-warning btn-sm px-3'>
                                    <i class='bi bi-pencil'></i>
                                </a>
                                <a href='forms/hapus_lembur.php?id={$data['id']}' onclick=\"return confirm('Yakin hapus?')\" class='btn btn-danger btn-sm px-3'>
                                    <i class='bi bi-trash'></i>
                                </a>
                            </div>
                        </td>
                      </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>
