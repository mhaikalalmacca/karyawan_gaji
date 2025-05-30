<?php
include_once '../config/koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Hapus semua data gaji yang terkait dengan karyawan
    $hapus_gaji = mysqli_query($conn, "DELETE FROM gaji WHERE id_karyawan = $id");

    if ($hapus_gaji) {
        // Jika penghapusan gaji berhasil, lanjut hapus karyawan
        $hapus_karyawan = mysqli_query($conn, "DELETE FROM karyawan WHERE id = $id");

        if ($hapus_karyawan) {
            echo "<script>alert('Data karyawan berhasil dihapus.'); window.location.href = '../index.php?page=karyawan';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data karyawan.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Gagal menghapus data gaji yang terkait.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('ID karyawan tidak valid.'); window.history.back();</script>";
}
?>
