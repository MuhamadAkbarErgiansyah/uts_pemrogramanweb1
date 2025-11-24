<?php
require 'config.php';
$pageTitle = "Detail Paket";
require 'header.php';

// Ambil slug dari URL
$slug = $_GET['slug'] ?? '';

// Ambil data dari database berdasarkan slug
$stmt = $pdo->prepare("SELECT * FROM items WHERE slug = ?");
$stmt->execute([$slug]);
$item = $stmt->fetch();

// Jika data tidak ditemukan
if(!$item){
  echo "<div class='container py-5'>
          <div class='alert alert-danger text-center'>
            ❌ Data tidak ditemukan untuk slug: <b>$slug</b>
          </div>
          <div class='text-center'>
            <a href='index.php' class='btn btn-primary'>Kembali</a>
          </div>
        </div>";
  require 'footer.php';
  exit;
}
?>

<!-- HERO IMAGE -->
<div class="hero d-flex align-items-end text-white"
     style="height:45vh; background-size:cover;
     background-position:center;
     background-image:url('<?= htmlspecialchars($item['image']) ?>');">

  <div class="container pb-4">
    <h1 class="fw-bold text-shadow"><?= htmlspecialchars($item['title']) ?></h1>
  </div>
</div>

<div class="container py-5">

  <div class="row gy-4">

    <!-- MAIN CONTENT -->
    <div class="col-lg-8" data-aos="fade-up">
      
      <h3 class="fw-bold"><?= htmlspecialchars($item['title']) ?></h3>
      <p class="text-muted small">
        📅 Diposting: <?= htmlspecialchars($item['created_at']) ?>
      </p>

      <div class="p-3 bg-light rounded border">
        <?= nl2br($item['content']) ?>
      </div>

    </div>

    <!-- SIDEBAR -->
    <div class="col-lg-4" data-aos="fade-left">
      <div class="card border-0 shadow-sm p-3">

        <h5 class="fw-bold mb-2">Informasi Paket</h5>
        <p><?= htmlspecialchars($item['summary']) ?></p>

        <h4 class="fw-bold text-primary mb-3">
          💰 <?= htmlspecialchars($item['price']) ?>
        </h4>

        <div class="d-grid gap-2 mb-3">
          <a href="index.php" class="btn btn-secondary">← Kembali</a>
          <a href="pemesanan.php?paket=<?= $item['slug'] ?>" class="btn btn-warning fw-bold">
    Pesan Sekarang
</a>

</a>

        </div>

        <hr>

        <h6 class="fw-bold">Apa saja yang didapat?</h6>
        <ul class="small ps-3">
          <li>Guide lokal berpengalaman</li>
          <li>Tiket wisata & dokumentasi</li>
          <li>Transport pada paket tertentu</li>
          <li>Rute wisata terlengkap</li>
        </ul>

      </div>
    </div>

  </div>
</div>

<?php require 'footer.php'; ?>
