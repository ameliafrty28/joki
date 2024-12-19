<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kesehatan</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <header>
        <nav>
            <img src="img/logo.png" alt="Logo" class="logo">
            <h1>Web Kesehatan UNRIYO</h1>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about-us">About Us</a></li>
                <li><a href="profile.php">Akun Saya</a></li>
            </ul>
        </nav>
    </header>

    <main>
    <section id="home">
        <h2>Selamat Datang, <?= $_SESSION['username']; ?></h2>
        <p>Selamat datang di platform kesehatan UNRIYO. Di sini Anda bisa menemukan informasi penting mengenai berbagai topik kesehatan, dari anemia hingga kesehatan mental. Pilih kategori di bawah untuk memulai perjalanan informasi kesehatan Anda.</p>
        <p>Website ini bertujuan untuk mengetahui pengtingnya informasi terkait masalah kesehatan yang dialami remaja putri seperti Anemia, Kesehatan reproduksi, Kesehatan Mental dan Masalah nutrisi </p>
        <p></p>
        <div class="home-hero-container">
            <img src="img/hero.jpg" alt="Hero utama" class="home-hero">
            <div class="home-hero-text">
                <h2>Selamat Datang di Web Kesehatan UNRIYO</h2>
        
                <p>Temukan informasi kesehatan yang bermanfaat untuk hidup lebih sehat!</p>
            </div>
        </div>

        <div class="home-images">
            <a href="anemia.php">
                <img src="img/anemia2.jpg" alt="Anemia" class="home-img">
                <div class="image-caption">Anemia</div>
            </a>
            <a href="kesehatan_mental.php">
                <img src="img/mental.jpeg" alt="Kesehatan Mental" class="home-img">
                <div class="image-caption">Kesehatan Mental</div>
            </a>
            <a href="kesehatan_reproduksi.php">
                <img src="img/reproduksi.jpg" alt="Kesehatan Reproduksi" class="home-img">
                <div class="image-caption">Kesehatan Reproduksi</div>
            </a>
            <a href="nutrisi.php">
                <img src="img/nutrisi.jpg" alt="Masalah Nutrisi" class="home-img">
                <div class="image-caption">Masalah Nutrisi</div>
            </a>
        </div>
    </section>

    </main>

    <footer>
        <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelompok 8 Kelas 2.</p>
    </footer>
</body>
</html>
