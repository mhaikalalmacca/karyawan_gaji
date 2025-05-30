<?php 
include 'config/koneksi.php';
?>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h2 class="m-0">Daftar Rating</h2>
    <a href="forms/add_rating.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Rating
    </a>
</div>


<div class="table-responsive">
    <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Rating</th>
                <th>Bonus</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($conn, "SELECT * FROM rating");
            while ($data = mysqli_fetch_assoc($query)) {
                echo "<tr>
                        <td>$no</td>
                        <td>" . number_format($data['rating']) . "</td>
                        <td>" . number_format($data['presentase_bonus']) . "%</td>
                        <td>
                            <div class='d-flex justify-content-center flex-wrap gap-2'>
                                <a href='forms/detail_rating.php?id={$data['id']}' class='btn btn-info btn-sm px-3'>
                                    <i class='bi bi-eye'></i>
                                </a>
                                <a href='forms/edit_rating.php?id={$data['id']}' class='btn btn-warning btn-sm px-3'>
                                    <i class='bi bi-pencil'></i>
                                </a>
                                <a href='forms/hapus_rating.php?id={$data['id']}' onclick=\"return confirm('Yakin hapus?')\" class='btn btn-danger btn-sm px-3'>
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