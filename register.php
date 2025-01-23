<?php
include 'koneksi.php';

$success = ""; // Variabel untuk menampung pesan keberhasilan
$error = ""; // Variabel untuk menampung pesan kesalahan

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $umur = $_POST['umur'];

    // Validasi password
    if ($password !== $confirmPassword) {
        $error = "Password dan Konfirmasi Password tidak cocok.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        $error = "Password harus terdiri dari minimal 8 karakter, mengandung huruf kapital, huruf kecil, angka, dan karakter khusus.";
    } else {
        // Mengecek apakah username sudah ada menggunakan prepared statement
        $stmt = $conn->prepare("SELECT * FROM tb_user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $resultUsername = $stmt->get_result();

        // Mengecek apakah email sudah ada menggunakan prepared statement
        $stmt2 = $conn->prepare("SELECT * FROM tb_user WHERE email = ?");
        $stmt2->bind_param("s", $email);
        $stmt2->execute();
        $resultEmail = $stmt2->get_result();

        // Jika username atau email sudah ada
        if ($resultUsername->num_rows > 0) {
            $error = "Username sudah digunakan, silakan pilih username lain.";
        } elseif ($resultEmail->num_rows > 0) {
            $error = "Email sudah terdaftar, silakan pilih email lain.";
        } else {
            // Jika username dan email belum terdaftar, lanjutkan registrasi
            $stmt3 = $conn->prepare("INSERT INTO tb_user (nama, username, email, password, umur) VALUES (?, ?, ?, ?, ?)");
            $stmt3->bind_param("ssssi", $nama, $username, $email, $password, $umur);

            if ($stmt3->execute()) {
                $success = "Registrasi berhasil! Klik Login untuk melanjutkan.";
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <link rel="stylesheet" href="style/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="icon" href="favicon.png" type="image/png">


    <script>
        // Fungsi untuk menampilkan modal pop-up
        function showModal() {
            const modal = document.getElementById('successModal');
            modal.style.display = 'block';
        }
    </script>
</head>
<body>
    <header>
        <nav>
            <img src="img/logo.png" alt="Logo" class="logo">
            <h1>KesehatanKu</h1>
        </nav>
    </header>

    <main>
        <form method="POST">
            <h2>Registrasi Akun</h2>

            <?php if (!empty($error)): ?>
                <p class="error-message" style="color: red;"> <?= htmlspecialchars($error); ?> </p>
            <?php endif; ?>

            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required placeholder="Masukkan Nama">

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required placeholder="Masukkan Username">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required placeholder="Masukkan Email">

            <label for="umur">Umur:</label>
            <input type="number" id="umur" name="umur" required placeholder="Masukkan usia">

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


            <button type="submit">Daftar</button>
            <p>Sudah punya akun? <a href="login.php">Login</a></p>
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

    <!-- Modal Pop-up -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <h3>Registrasi Berhasil!</h3>
            <p>Silakan klik tombol di bawah untuk login.</p>
            <a href="login.php">Login</a>
        </div>
    </div>

    <?php if (!empty($success)): ?>
        <script>
            showModal();
        </script>
    <?php endif; ?>
</body>
</html>
