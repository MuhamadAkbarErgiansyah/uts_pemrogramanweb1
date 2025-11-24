<?php
$pageTitle = "Guide - Explore Nusantara";
require 'header.php';

// === DATA GUIDE & TOUR ===
$guides = [
  [
    'name'=>'Muhamad Akbar Ergiansyah',
    'lang'=>'ID/EN',
    'exp'=>'20 Tahun',
    'photo'=>'images/aku.jpg',
    'bio'=>'Guide spesialis wisata alam, survival & tracking di area Bandung.',
    'tours'=>[
      [
        'title'=>'Sunrise Adventure Lembang',
        'rundown'=>[
          '04.30 - Penjemputan dan briefing singkat',
          '05.15 - Tiba di spot sunrise Gunung Putri',
          '06.00 - Dokumentasi foto & video',
          '07.00 - Sarapan khas Sunda',
          '09.00 - Tracking ringan ke spot tebing',
          '11.00 - Kembali & penutupan'
        ]
      ]
    ]
  ],
  [
    'name'=>'Abi Rahman',
    'lang'=>'ID',
    'exp'=>'7 Tahun',
    'photo'=>'images/abi.jpg',
    'bio'=>'Guide berkepribadian fun & humoris, cocok untuk tour bersama teman.',
    'tours'=>[
      [
        'title'=>'Ciwidey Eksplore 1 Hari',
        'rundown'=>[
          '06.00 - Penjemputan Peserta',
          '07.30 - Tiba di Kawah Putih, sesi foto & cerita sejarah',
          '09.00 - Kunjungan perkebunan teh',
          '11.00 - Panen strawberry bebas pilih',
          '12.30 - Makan siang khas Ciwidey',
          '14.30 - Kembali & penutupan'
        ]
      ]
    ]
  ],
  [
    'name'=>'Dewi Kusumastuti',
    'lang'=>'ID/EN/JP',
    'exp'=>'12 Tahun',
    'photo'=>'images/ahay.jpg',
    'bio'=>'Guide perempuan profesional, cocok untuk wisata keluarga & tamu mancanegara.',
    'tours'=>[
      [
        'title'=>'Pangalengan Lakeside Journey',
        'rundown'=>[
          '05.00 - Berangkat menuju Pangalengan',
          '06.15 - Foto sunrise di Danau Cileunca',
          '07.00 - Perahu & eksplor spot foto rahasia',
          '09.00 - Sarapan di pinggir danau',
          '11.00 - Mini tracking ke hutan pinus',
          '14.00 - Kembali'
        ]
      ]
    ]
  ]
];
?>

<style>
/* === ANIMATION STYLE (SAMA DENGAN PAKET) === */
[data-animate] {
  opacity: 0;
  transform: translateY(30px);
  transition: .7s ease;
}

[data-animate].show {
  opacity: 1;
  transform: translateY(0);
}

/* ==== CARD ANIMATION ==== */
.guide-card {
  transition: .25s;
  cursor: pointer;
  border-radius: 14px;
  background: #fff;
}

.guide-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 10px 26px rgba(0,0,0,.16);
}

.guide-card:active {
  transform: scale(0.96);
}

/* icon timeline */
.timeline li::before {
  content:"▹";
  margin-right:8px;
  color:#0d6efd;
}

/* avatar */
.profile-photo {
  width: 95px;
  height: 95px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid #0d6efd;
}
</style>

<script>
// === SCROLL ANIMATE DETECTION (SAMA DENGAN PAKET) ===
window.addEventListener("scroll", function() {
  document.querySelectorAll("[data-animate]").forEach(el => {
    const rect = el.getBoundingClientRect();
    if(rect.top < window.innerHeight - 80){
      el.classList.add("show");
    }
  });
});
</script>

<div class="container mt-5">
  <h2 class="mb-4 fw-bold" data-animate>Daftar Guide Profesional Kami</h2>
  <div class="row g-4">

    <?php foreach($guides as $index => $g): ?>
    <div class="col-md-4" data-animate>
      <div class="card guide-card p-3 text-center shadow-sm">

        <img src="<?=$g['photo']?>" class="profile-photo mx-auto mb-3">

        <h5 class="fw-bold"><?=$g['name']?></h5>
        <small><?=$g['bio']?></small>

        <div class="mt-3 small">
          <strong>Bahasa:</strong> <?=$g['lang']?>  
          <br>
          <strong>Pengalaman:</strong> <?=$g['exp']?>
        </div>

      </div>
    </div>

    <div class="col-md-8" data-animate>
      <?php foreach($g['tours'] as $t): ?>
      <div class="card p-3 mb-3 shadow-sm" style="border-radius:14px;" data-animate>
        <h5 class="fw-bold mb-2"><?=$t['title']?></h5>
        <ul class="timeline">
          <?php foreach($t['rundown'] as $r): ?>
          <li><?=$r?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endforeach; ?>
    </div>

    <hr class="my-4" data-animate>

    <?php endforeach; ?>

  </div>
</div>

<?php require 'footer.php'; ?>
