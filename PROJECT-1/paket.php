<?php include 'header.php'; ?>

<div class="container mt-5" data-animate>
  <h2>Paket Pilihan</h2>
  <p class="text-muted">Pilih paket sesuai minatmu. Klik preview video untuk lihat suasana.</p>

  <?php
  // contoh data paket statis — nanti bisa ke DB
  $paket = [
    [
      "slug"  => "paket-sunrise-lembang", // diubah supaya sesuai database
      "title" => "Paket Lembang Full Day",
      "price" => 250000,
      "video" => "https://youtu.be/Uetb7r_uqcY?si=E-R4KbuUwcrm6dYM",
      "img"   => "images/tebing keraton.jpg",
      "desc"  => "
        Nikmati perjalanan sehari penuh di kawasan Lembang yang terkenal dengan udara sejuk dan panorama alamnya yang menakjubkan. Paket ini membawa Anda mengunjungi destinasi terbaik dengan suasana pegunungan dan spot foto estetik.
        <br><br><strong>Yang akan Anda nikmati:</strong>
        <ul>
          <li>Trekking ringan menuju Tebing Keraton dengan pemandangan sunrise/sunset yang epik.</li>
          <li>Kunjungan ke hutan pinus dan area outdoor instagramable.</li>
          <li>Mampir ke kuliner khas Sunda untuk makan siang.</li>
          <li>Waktu bebas menikmati wisata populer seperti Farm House atau The Lodge.</li>
        </ul>
        <strong>Cocok untuk:</strong>
        <ul>
          <li>Pecinta alam & petualangan ringan</li>
          <li>Liburan keluarga dan rombongan sekolah</li>
          <li>Pasangan yang ingin healing romantis</li>
        </ul>
      "
    ],

    [
      "slug"  => "paket-ciwidey",
      "title" => "Paket Ciwidey Eksplore",
      "price" => 300000,
      "video" => "https://youtu.be/uej2-FUeb5Y?si=vHHJad_9SmJUuxV4",
      "img"   => "images/kawah putih.jpeg",
      "desc"  => "
        Eksplorasi Ciwidey yang terkenal dengan kawasan dingin dan keindahan alam yang memanjakan mata. Cocok untuk relaksasi dan wisata santai.
        <br><br><strong>Yang akan Anda nikmati:</strong>
        <ul>
          <li>Kunjungan ke Kawah Putih dengan nuansa dramatis dan ikonik.</li>
          <li>Jalan santai di kebun teh luas yang asri.</li>
          <li>Spot foto premium dengan latar perbukitan.</li>
          <li>Waktu belanja oleh-oleh khas Ciwidey seperti stroberi.</li>
        </ul>
        <strong>Cocok untuk:</strong>
        <ul>
          <li>Healing dari rutinitas kota</li>
          <li>Prewedding & foto profesional</li>
          <li>Wisata keluarga & rombongan sekolah</li>
        </ul>
      "
    ],

    [
      "slug"  => "paket-pangalengan",
      "title" => "Paket Pangalengan Sunrise",
      "price" => 280000,
      "video" => "https://youtu.be/PhBFDDl6LVM?si=1Dc90XAOjPSU4Fvr",
      "img"   => "images/kebun.jpg",
      "desc"  => "
        Pengalaman ekslusif menikmati sunrise terbaik di Bandung Selatan dengan latar pegunungan bertingkat dan kebun teh yang hijau.
        <br><br><strong>Yang akan Anda nikmati:</strong>
        <ul>
          <li>Sunrise dari puncak bukit dengan nuansa kabut lembut.</li>
          <li>Tracking ringan melewati perkebunan teh.</li>
          <li>Spot foto alami seperti danau dan hutan kecil.</li>
          <li>Suasana pedesaan yang damai dan menenangkan.</li>
        </ul>
        <strong>Cocok untuk:</strong>
        <ul>
          <li>Pecinta fotografi</li>
          <li>Solo adventure ringan</li>
          <li>Liburan santai bersama teman</li>
        </ul>
      "
    ]
];



  foreach($paket as $p){ ?>
    <div class="card mb-3 card-modern" data-animate>
      <div class="row g-0">
        <div class="col-md-4 img-hover-zoom">
          <img src="<?= $p['img'] ?>" alt="<?= $p['title'] ?>">
        </div>

        <div class="col-md-8">
          <div class="p-3">
            <h5><?= $p['title'] ?></h5>
            <p class="text-muted small">Durasi: Full Day • Transportasi termasuk</p>

            <div class="kv fw-bold mb-2">
              Rp <?= number_format($p['price'],0,',','.') ?>
            </div>

            <!-- === DESKRIPSI ADA DI SINI === -->
            <p class="small text-muted">
              <?= $p['desc'] ?>
            </p>

            <div class="d-flex justify-content-end mt-3">
              <button class="btn btn-outline-secondary me-2"
                      data-bs-toggle="modal"
                      data-bs-target="#modalVideo"
                      data-video-src="<?= $p['video'] ?>">
                Preview Video
              </button>

              <a href="pemesanan.php?paket=<?= $p['slug'] ?>" class="btn btn-cta">
    Pilih Paket
</a>

            </div>

          </div>
        </div>
      </div>
    </div>
  <?php } ?>

</div>

<?php include 'footer.php'; ?>


<!-- ======================  MODAL VIDEO ====================== -->
<div class="modal fade" id="modalVideo" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content bg-dark">
      <div class="modal-body p-0 position-relative">

        <!-- Close Button -->
        <button type="button"
                class="btn-close btn-close-white position-absolute top-0 end-0 m-2"
                data-bs-dismiss="modal"></button>

        <!-- Video Frame -->
        <iframe id="videoFrame"
                width="100%" height="450" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>

      </div>
    </div>
  </div>
</div>


<!-- ======================  MODAL SCRIPT ====================== -->
<script>
document.addEventListener("shown.bs.modal", function (event) {
    const btn = event.relatedTarget;
    const videoUrl = btn.getAttribute("data-video-src");

    let videoEmbed = videoUrl;

    // Convert Youtube standard link to embed
    if(videoUrl.includes("youtu.be")){
        videoEmbed = videoUrl.replace("youtu.be/", "www.youtube.com/embed/");
    }
    if(videoUrl.includes("watch?v=")){
        videoEmbed = videoUrl.replace("watch?v=", "embed/");
    }

    document.getElementById("videoFrame").src = videoEmbed + "?autoplay=1";
});

document.addEventListener("hidden.bs.modal", function () {
    document.getElementById("videoFrame").src = "";
});
</script>
