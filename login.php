<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_or_email = $conn->real_escape_string($_POST['username_or_email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $captcha = $_POST['g-recaptcha-response'];

    // Verifikasi CAPTCHA dengan Google reCAPTCHA
    $secretKey = '6LdLF7gqAAAAAFyOYq5nTLG-s5U4hF6CWXT_6Msr';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        $error = "Verifikasi CAPTCHA gagal, coba lagi.";
    } elseif ($password !== $confirmPassword) {
        $error = "Password dan Konfirmasi Password tidak cocok.";
    } else {
        // CAPTCHA berhasil dan password cocok, lanjutkan proses login
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
            header("Location: index2.php");
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
    <link rel="icon" href="favicon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


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
            <div class="password-container">
                <input type="password" id="password" name="password" required placeholder="Masukkan Password">
                <i id="togglePassword" class="fa fa-eye"></i>
            </div>

            <label for="confirm_password">Konfirmasi Password:</label>
            <div class="password-container">
                <input type="password" id="confirm_password" name="confirm_password" required placeholder="Konfirmasi Password">
                <i id="toggleConfirmPassword" class="fa fa-eye"></i>
            </div>

            <style>
                /* Gaya dasar untuk password container */
                .password-container {
                    position: relative;
                    display: flex;
                    align-items: center;
                }

                /* Input */
                .password-container input {
                    width: 100%;
                    padding: 10px;
                    padding-right: 40px; /* Ruang untuk ikon mata */
                    font-size: 16px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }

                /* Ikon mata */
                .password-container i {
                    position: absolute;
                    right: 10px;
                    margin-bottom: 10px;
                    cursor: pointer;
                    font-size: 18px;
                    color: #888;
                }

                /* Hover efek untuk ikon mata */
                .password-container i:hover {
                    color: #333;
                }
            </style>
            <!-- Tambahkan CAPTCHA -->
            <div class="g-recaptcha" data-sitekey="6LdLF7gqAAAAADqTgQxUxz8x6jzCZZBVUlJ-1Zte"></div>

            <button type="submit">Login</button>
            <p>Belum punya akun? <a href="register.php">Daftar</a></p>
        </form>
    </main>
    <script>
    // Fungsi untuk toggle visibilitas password
    function togglePassword(inputId, toggleId) {
        const input = document.getElementById(inputId);
        const toggleIcon = document.getElementById(toggleId);
        if (input.type === "password") {
            input.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }

    // Event listener untuk input password
    document.getElementById("togglePassword").addEventListener("click", () => {
        togglePassword("password", "togglePassword");
    });

    // Event listener untuk input konfirmasi password
    document.getElementById("toggleConfirmPassword").addEventListener("click", () => {
        togglePassword("confirm_password", "toggleConfirmPassword");
    });
</script>
    <footer>
        <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelas 2 Kelompok 8</p>
    </footer>
</body>
</html>
