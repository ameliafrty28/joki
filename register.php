<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $umur = $_POST['umur'];

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
            echo "Registrasi berhasil. <a href='login.php'>Login</a>";
        } else {
            echo "Error: " . $conn->error;
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
</head>
<body>
    <header>
        <nav>
            <img src="img/logo.png" alt="Logo" class="logo">
            <h1>Web Kesehatan UNRIYO</h1>
        </nav>
    </header>

    <main>
        <form method="POST">
            <h2>Registrasi Akun</h2>

            <?php if (isset($error)): ?>
                <p class="error-message" style="color: red;"><?= htmlspecialchars($error); ?></p>
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
            <input type="password" id="password" name="password" required placeholder="Masukkan Password">

            <button type="submit">Daftar</button>
            <p>Sudah punya akun? <a href="login.php">Login</a></p>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelompok 8 Kelas 2.</p>
    </footer>
</body>
</html>
