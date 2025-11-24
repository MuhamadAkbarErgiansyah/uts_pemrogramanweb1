<?php
require 'config.php';
$pageTitle = "Riwayat Pemesanan";
require 'header.php';

// ======================
// CEK LOGIN
// ======================
if (!isset($_SESSION['user_id'])) {
    // Redirect ke login dengan redirect kembali ke halaman ini
    $redirect = urlencode($_SERVER['REQUEST_URI']);
    header("Location: login.php?redirect=$redirect");
    exit;
}

$userId = $_SESSION['user_id'];

// Ambil semua pemesanan user
$stmt = $pdo->prepare("SELECT * FROM reservations WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$userId]);
$reservations = $stmt->fetchAll();
?>

<div class="container py-5">
    <h2 class="fw-bold mb-4">Riwayat Pemesanan</h2>

    <?php if(!$reservations): ?>
        <div class="alert alert-info">Belum ada reservasi.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Paket</th>
                        <th>Tanggal Event</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Catatan</th>
                        <th>Tanggal Pesan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($reservations as $i => $r): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= htmlspecialchars($r['package_title']) ?></td>
                        <td><?= htmlspecialchars($r['date_event']) ?></td>
                        <td><?= htmlspecialchars($r['name']) ?></td>
                        <td><?= htmlspecialchars($r['email']) ?></td>
                        <td><?= htmlspecialchars($r['contact']) ?></td>
                        <td><?= nl2br(htmlspecialchars($r['note'])) ?></td>
                        <td><?= htmlspecialchars($r['created_at']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require 'footer.php'; ?>
