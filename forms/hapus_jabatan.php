<?php
include '../config/koneksi.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM jabatan WHERE id = $id");

header("Location: ../index.php?page=jabatan");
?>