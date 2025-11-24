<?php
require 'config.php';
$pageTitle = "Form Pemesanan";
require 'header.php';

// ======================
// CEK LOGIN
// ======================
if (!isset($_SESSION['user_id'])) {
    // Redirect ke login.php dengan redirect kembali ke halaman ini
    $redirect = urlencode($_SERVER['REQUEST_URI']);
    header("Location: login.php?redirect=$redirect");
    exit;
}

// Ambil slug paket dari URL
$slug = $_GET['paket'] ?? '';

// Ambil info paket dari database
$stmt = $pdo->prepare("SELECT * FROM items WHERE slug = ?");
$stmt->execute([$slug]);
$paket = $stmt->fetch();

// Jika paket tidak ditemukan
if(!$paket){
    echo "<div class='container py-5'>
            <div class='alert alert-danger text-center'>
                ❌ Paket tidak ditemukan.
            </div>
            <div class='text-center'>
                <a href='index.php' class='btn btn-primary'>Kembali</a>
            </div>
          </div>";
    require 'footer.php';
    exit;
}

// Proses form submit
$success = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name          = $_POST['name'];
    $email         = $_POST['email'];
    $contact       = $_POST['phone'];
    $packageId     = $paket['id'];
    $packageTitle  = $paket['title'];
    $dateEvent     = $_POST['date'];
    $note          = $_POST['notes'];
    $userId        = $_SESSION['user_id'];

    // Simpan ke database
    $stmt = $pdo->prepare("INSERT INTO reservations
        (user_id, name, email, contact, package_id, package_title, date_event, note, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$userId, $name, $email, $contact, $packageId, $packageTitle, $dateEvent, $note]);

    $success = "✅ Pemesanan berhasil! Terima kasih, $name.";
}

// Ambil histori pemesanan user
$stmtHistory = $pdo->prepare("SELECT * FROM reservations WHERE user_id = ? ORDER BY created_at DESC");
$stmtHistory->execute([$_SESSION['user_id']]);
$history = $stmtHistory->fetchAll();
?>

<div class="container py-5">
    <h2 class="fw-bold mb-4">Form Pemesanan: <?= htmlspecialchars($paket['title']) ?></h2>

    <?php if($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">No. Telepon</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Pemesanan</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Catatan / Permintaan Khusus</label>
            <textarea name="notes" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Pemesanan</button>
    </form>

    <hr class="my-5">

    <h5>Detail Paket</h5>
    <p><?= nl2br(htmlspecialchars($paket['content'])) ?></p>
    <p><strong>Harga:</strong> <?= htmlspecialchars($paket['price']) ?></p>

    <hr class="my-5">
    <h4>Riwayat Pemesanan Anda</h4>
    <?php if(count($history) > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Paket</th>
                    <th>Tanggal Event</th>
                    <th>Catatan</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($history as $i => $res): ?>
                <tr>
                    <td><?= $i+1 ?></td>
                    <td><?= htmlspecialchars($res['package_title']) ?></td>
                    <td><?= htmlspecialchars($res['date_event']) ?></td>
                    <td><?= htmlspecialchars($res['note']) ?></td>
                    <td><?= htmlspecialchars($res['created_at']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Belum ada riwayat pemesanan.</p>
    <?php endif; ?>
</div>

<?php require 'footer.php'; ?>
