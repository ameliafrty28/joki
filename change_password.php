<?php
// File: change_password.php

session_start();
require_once 'koneksi.php'; // Pastikan file koneksi database sudah disiapkan

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $error = "Semua bidang harus diisi.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Kata sandi baru dan konfirmasi tidak cocok.";
    } else {
        // Ambil kata sandi pengguna dari database
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($stored_password);
        $stmt->fetch();
        $stmt->close();

        // Periksa apakah kata sandi saat ini cocok
        if ($current_password !== $stored_password) {
            $error = "Kata sandi saat ini salah.";
        } else {
            // Perbarui kata sandi di database
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $new_password, $user_id);
            if ($stmt->execute()) {
                $success = "Kata sandi berhasil diperbarui.";
            } else {
                $error = "Terjadi kesalahan saat memperbarui kata sandi.";
            }
            $stmt->close();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password</title>
</head>
<body>
    <h2>Ubah Password</h2>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <p style="color: green;"><?= $success ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="current_password">Password Saat Ini:</label><br>
        <input type="password" id="current_password" name="current_password" required><br><br>

        <label for="new_password">Password Baru:</label><br>
        <input type="password" id="new_password" name="new_password" required><br><br>

        <label for="confirm_password">Konfirmasi Password Baru:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <button type="submit">Ubah Password</button>
    </form>
</body>
</html>
