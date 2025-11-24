<?php
require 'config.php'; // config.php sudah start session dan punya $pdo

// Jika tombol login ditekan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username']; // ini bisa name atau email
    $password = $_POST['password'];

    // Cek user berdasarkan name ATAU email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE name = ? OR email = ?");
    $stmt->execute([$username, $username]);
    $user = $stmt->fetch();

    if ($user) {
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Jika login sukses → simpan session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['name'];

            // Redirect ke halaman utama
            header("Location: index.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "User tidak ditemukan!";
    }
}
?>

<?php include 'header.php'; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card p-4 shadow" style="width:400px;">
        <h3 class="text-center mb-3">Login</h3>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            
            <label class="form-label">Username atau Email</label>
            <input type="text" name="username" class="form-control mb-3" required>

            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control mb-4" required>
            
            <button class="btn btn-primary w-100 mb-3">Login</button>

            <p class="text-center small">
                Belum punya akun? <a href="register.php">Daftar</a>
            </p>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
