<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Explore Bandung</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- inline critical theme gradient (fast) -->
  <style>
    :root{
      --primary-1: #6a11cb;
      --primary-2: #2575fc;
      --accent: #ff5722;
      --muted: #7b7f86;
    }
    body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg,#f6f9ff 0%, #ffffff 100%); color:#222; }
    .bg-gradient-primary {
      background: linear-gradient(90deg,var(--primary-1),var(--primary-2));
      color: #fff;
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
      <div style="width:42px;height:42px;border-radius:10px;background:linear-gradient(135deg,var(--primary-1),var(--primary-2));display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700">EB</div>
      <div>
        <div style="font-weight:700">Explore Bandung</div>
        <small class="text-muted">wisata — paket — guide</small>
      </div>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="paket.php">Paket</a></li>
        <li class="nav-item"><a class="nav-link" href="guide.php">Guide</a></li>
        <li class="nav-item"><a class="nav-link" href="galerry.php">Galeri</a></li>
        <li class="nav-item"><a class="nav-link" href="riwayat.php">Pemesanan</a></li>
        <li class="nav-item ms-3">
          <?php if(isset($_SESSION['user_id'])): ?>
            <div class="dropdown">
              <a class="btn btn-sm btn-outline-primary rounded-pill dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user me-1"></i> <?= htmlspecialchars($_SESSION['username']) ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
            </div>
          <?php else: ?>
            <a class="btn btn-sm btn-outline-primary rounded-pill" href="login.php"><i class="fa fa-user me-1"></i> Masuk</a>
          <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- main wrapper start -->
<main>
