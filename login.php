<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_or_email = $conn->real_escape_string($_POST['username_or_email']);
    $password = $_POST['password'];

    // Query untuk mencari pengguna berdasarkan username atau email
    $sql = "SELECT * FROM tb_user WHERE (username = '$username_or_email' OR email = '$username_or_email') AND password = '$password'";
    $result = $conn->query($sql);

    // Memeriksa apakah pengguna ditemukan
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Menyimpan informasi ke sesi
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username'];

        // Redirect ke halaman home
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
    <header>
        <nav>
            <img src="img/logo.png" alt="Logo" class="logo">
            <h1>Web Kesehatan UNRIYO</h1>
        </nav>
    </header>

    <main>
        <form method="POST" class="login-form">
            <h2>Login</h2>
            <?php if (isset($error)): ?>
                <p class="error-message" style="color: red;"><?= htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <label for="username_or_email">Username atau Email:</label>
            <input type="text" id="username_or_email" name="username_or_email" required placeholder="Masukkan Username atau Email">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required placeholder="Masukkan Password">

            <button type="submit">Login</button>
            <p>Belum punya akun? <a href="register.php">Daftar</a></p>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelompok 8 Kelas 2.</p>
    </footer>
</body>
</html>

