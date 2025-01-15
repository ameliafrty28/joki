<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_or_email = $conn->real_escape_string($_POST['username_or_email']);
    $password = $_POST['password'];
    $captcha = $_POST['g-recaptcha-response'];

    // Verifikasi CAPTCHA dengan Google reCAPTCHA
    $secretKey = '6LdLF7gqAAAAAFyOYq5nTLG-s5U4hF6CWXT_6Msr';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
    $responseKeys = json_decode($response, true);

    if(intval($responseKeys["success"]) !== 1) {
        $error = "Verifikasi CAPTCHA gagal, coba lagi.";
    } else {
        // CAPTCHA berhasil, lanjutkan proses login
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
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/login.css">
    <!-- Tambahkan reCAPTCHA v2 script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <header>
        <nav>
            <img src="img/logo.png" alt="Logo" class="logo">
            <h1>KesehatanKu</h1>
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

            <!-- Tambahkan CAPTCHA -->
            <div class="g-recaptcha" data-sitekey="6LdLF7gqAAAAADqTgQxUxz8x6jzCZZBVUlJ-1Zte"></div>

            <button type="submit">Login</button>
            <p>Belum punya akun? <a href="register.php">Daftar</a></p>
        </form>
    </main>

    <footer>
    <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelas 2 Kelompok 8</p>
    </footer>
</body>
</html>
