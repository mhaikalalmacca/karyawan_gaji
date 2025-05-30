<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Gaji</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

  <style>
    body, html {
      height: 100%;
    }

    .wrapper {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <!-- Tombol sidebar mobile -->
    <div class="d-md-none">
      <button class="btn btn-dark m-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
        <i class="bi bi-list"></i>
      </button>
    </div>

    <div class="container-fluid">
      <div class="row">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
          <?php
            $page = $_GET['page'] ?? 'dashboard';
            include "pages/$page.php";
          ?>
        </main>
      </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-end text-muted py-3 mt-auto border-top">
      <div class="container">
        <small>&copy; <?= date('Y') ?> PT.KEISYA. All rights reserved.</small>
      </div>
    </footer>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
