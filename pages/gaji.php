<?php 
include 'config/koneksi.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Gaji Karyawan</h2>
    <a href="forms/add_gaji.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Gaji
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Periode</th>
                <th>Total Gaji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($conn, "SELECT gaji.*, karyawan.nama FROM gaji 
                                          JOIN karyawan ON gaji.id_karyawan = karyawan.id");

            // Array bulan dalam Bahasa Indonesia
            $bulanIndo = [
                'January' => 'Januari',
                'February' => 'Februari',
                'March' => 'Maret',
                'April' => 'April',
                'May' => 'Mei',
                'June' => 'Juni',
                'July' => 'Juli',
                'August' => 'Agustus',
                'September' => 'September',
                'October' => 'Oktober',
                'November' => 'November',
                'December' => 'Desember'
            ];

            while ($data = mysqli_fetch_assoc($query)) {
                // Format periode ke Bulan Tahun (contoh: Juni 2025)
                $tanggal = strtotime($data['periode']);
                $bulan = date('F', $tanggal);
                $tahun = date('Y', $tanggal);
                $periodeFormatted = $bulanIndo[$bulan] . ' ' . $tahun;

                echo "<tr>
                        <td>$no</td>
                        <td>{$data['nama']}</td>
                        <td>$periodeFormatted</td>
                        <td>Rp " . number_format($data['total_pendapatan'], 0, ',', '.') . "</td>
                        <td>
                            <div class='d-flex justify-content-center flex-wrap gap-2'>
                                <a href='forms/detail_gaji.php?id={$data['id']}' class='btn btn-info btn-sm px-3'>
                                    <i class='bi bi-eye'></i>
                                </a>
                                <a href='forms/edit_gaji.php?id={$data['id']}' class='btn btn-warning btn-sm px-3'>
                                    <i class='bi bi-pencil'></i>
                                </a>
                                <a href='forms/hapus_gaji.php?id={$data['id']}' onclick=\"return confirm('Yakin hapus?')\" class='btn btn-danger btn-sm px-3'>
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
