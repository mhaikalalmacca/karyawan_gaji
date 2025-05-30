<?php
$current_page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<div class="d-none d-md-block position-fixed top-0 start-0 vh-100 bg-dark text-white p-3" style="width: 230px; z-index: 1030;">
  <a href="?page=dashboard" class="d-flex align-items-center mb-3 text-white text-decoration-none">
    <img src="assets/image/smk.png" alt="Logo" width="50" class="me-2 rounded-circle">
    <h7 class="fw-semibold">SISTEM MANAJEMEN GAJI</h7>
  </a>
  <hr>
  <ul class="nav nav-pills flex-column gap-2">
    <li class="nav-item">
      <a href="?page=dashboard" class="nav-link <?= ($current_page == 'dashboard') ? 'active bg-primary text-light' : 'text-white'; ?>">
        <i class="bi bi-speedometer2 me-2"></i>Dashboard
      </a>
    </li>
    <li class="nav-item">
      <a href="?page=karyawan" class="nav-link <?= ($current_page == 'karyawan') ? 'active bg-primary text-light' : 'text-white'; ?>">
        <i class="bi bi-people me-2"></i>Daftar Karyawan
      </a>
    </li>
    <li class="nav-item">
      <a href="?page=jabatan" class="nav-link <?= ($current_page == 'jabatan') ? 'active bg-primary text-light' : 'text-white'; ?>">
        <i class="bi bi-briefcase me-2"></i>Daftar Jabatan
      </a>
    </li>
    <li class="nav-item">
      <a href="?page=rating" class="nav-link <?= ($current_page == 'rating') ? 'active bg-primary text-light' : 'text-white'; ?>">
        <i class="bi bi-star me-2"></i>Daftar Rating
      </a>
    </li>
    <li class="nav-item">
      <a href="?page=lembur" class="nav-link <?= ($current_page == 'lembur') ? 'active bg-primary text-light' : 'text-white'; ?>">
        <i class="bi bi-clock-history me-2"></i>Tarif Lembur
      </a>
    </li>
    <li class="nav-item">
      <a href="?page=gaji" class="nav-link <?= ($current_page == 'gaji') ? 'active bg-primary text-light' : 'text-white'; ?>">
        <i class="bi bi-cash-stack me-2"></i>Gaji Karyawan
      </a>
    </li>
  </ul>
</div>

<!-- SIDEBAR MOBILE: OFFCANVAS -->
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="sidebarMenu">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Menu</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav nav-pills flex-column gap-2">
      <li class="nav-item">
        <a href="?page=dashboard" class="nav-link <?= ($current_page == 'dashboard') ? 'active bg-primary text-light' : 'text-white'; ?>">
          <i class="bi bi-speedometer2 me-2"></i>Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a href="?page=karyawan" class="nav-link <?= ($current_page == 'karyawan') ? 'active bg-primary text-light' : 'text-white'; ?>">
          <i class="bi bi-people me-2"></i>Daftar Karyawan
        </a>
      </li>
      <li class="nav-item">
        <a href="?page=jabatan" class="nav-link <?= ($current_page == 'jabatan') ? 'active bg-primary text-light' : 'text-white'; ?>">
          <i class="bi bi-briefcase me-2"></i>Daftar Jabatan
        </a>
      </li>
      <li class="nav-item">
        <a href="?page=rating" class="nav-link <?= ($current_page == 'rating') ? 'active bg-primary text-light' : 'text-white'; ?>">
          <i class="bi bi-star me-2"></i>Daftar Rating
        </a>
      </li>
      <li class="nav-item">
        <a href="?page=lembur" class="nav-link <?= ($current_page == 'lembur') ? 'active bg-primary text-light' : 'text-white'; ?>">
          <i class="bi bi-clock me-2"></i>Tarif Lembur
        </a>
      </li>
      <li class="nav-item">
        <a href="?page=gaji" class="nav-link <?= ($current_page == 'gaji') ? 'active bg-primary text-light' : 'text-white'; ?>">
          <i class="bi bi-cash-coin me-2"></i>Gaji Karyawan
        </a>
      </li>
    </ul>
  </div>
</div>
