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
    <link rel="icon" href="favicon.png" type="image/png">

</head>
<body>
    <header>
        <nav>
            <img src="img/logo.png" alt="Logo" class="logo">
            <h1>KesehatanKu</h1>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul id="main-menu" class="nav-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="about-us.php">About Us</a></li>
                <li><a href="profile.php">Akun Saya</a></li>
            </ul>

        </nav>
    </header>

    <main>
    <section id="home">
        <h2>Selamat Datang, <?= $_SESSION['username']; ?></h2>
        <p>Selamat datang di platform KESEHATANKU. Di sini Anda bisa menemukan informasi penting mengenai berbagai topik kesehatan, dari anemia hingga kesehatan mental. Pilih kategori di bawah untuk memulai perjalanan informasi kesehatan Anda.</p>
        <p>Website ini bertujuan untuk mengetahui pengtingnya informasi terkait masalah kesehatan yang dialami remaja putri seperti Anemia, Kesehatan reproduksi, Kesehatan Mental dan Masalah nutrisi </p>
        <p></p>
        <div class="home-hero-container">
            <img src="img/hero.jpg" alt="Hero utama" class="home-hero">
            <div class="home-hero-text">
                <h2>Selamat Datang di KESEHATANKU</h2>
                <p>Platform ini menyediakan informasi yang ditujukan pada kesehatan Remaja Putri.</p>
                <p>Temukan informasi kesehatan yang bermanfaat untuk hidup lebih sehat!</p>
            </div>
        </div>

        <div class="home-images">
            <a href="cek-anemia.php">
                <img src="img/anemia2.jpg" alt="Anemia" class="home-img">
                <div class="image-caption">Cek Risiko Anemia</div>
            </a>
            <a href="cek-mental.php">
                <img src="img/mental.jpeg" alt="Kesehatan Mental" class="home-img">
                <div class="image-caption">Cek Tingkat Stres</div>
            </a>
            <a href="teskalender.php">
                <img src="img/reproduksi.jpg" alt="Kesehatan Reproduksi" class="home-img">
                <div class="image-caption">Cek Siklus Menstruasi</div>
            </a>
            <a href="cek-nutrisi.php">
                <img src="img/nutrisi.jpg" alt="Masalah Nutrisi" class="home-img">
                <div class="image-caption">Cek Indeks Massa Tubuh (IMT)</div>
            </a>
        </div>
    </section>

    </main>
    <script src="hamburger.js" defer></script>

    <footer>
    <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelas 2 Kelompok 8</p>
    </footer>
</body>
</html>
