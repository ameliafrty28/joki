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
                <li><a href="index2.php">Home</a></li>
                <li><a href="about-us.php">About Us</a></li>
                <li><a href="profile.php">Akun Saya</a></li>
            </ul>

        </nav>
    </header>

    <main>
    <section id="home">
        <h2>Selamat Datang, <?= $_SESSION['username']; ?></h2>
        <p>Selamat datang di platform KESEHATANKU. Di sini Anda bisa menemukan informasi penting mengenai berbagai topik kesehatan Pada remaja Putri</p>
        <p>Website ini bertujuan untuk mengetahui pengtingnya informasi terkait masalah kesehatan yang dialami remaja putri seperti Anemia, Kesehatan reproduksi, Kesehatan Mental dan Masalah nutrisi </p>
        <p></p>
        <div class="home-hero-container">
    <div class="slideshow">
        <img src="img/hero.jpg" alt="Hero utama 1" class="slide">
        <img src="img/hero1.jpg" alt="Hero utama 2" class="slide">
        <img src="img/hero2.jpg" alt="Hero utama 3" class="slide">
        <img src="img/hero3.jpg" alt="Hero utama 4" class="slide">
    </div>
</div>

        <h1>Pilih Kategori dibawah ini untuk memulai perjalan informasi kesehatan anda</h1>
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

    <script>
const slides = document.querySelectorAll(".slide");
let currentIndex = 0;

function showNextSlide() {
    // Set semua slide ke posisi awal
    slides.forEach((slide, index) => {
        slide.style.transform = "translateX(100%)"; // Semua slide dipindahkan ke kanan
    });

    // Geser slide saat ini keluar ke kiri
    slides[currentIndex].style.transform = "translateX(-100%)";

    // Perbarui indeks
    currentIndex = (currentIndex + 1) % slides.length;

    // Tampilkan slide berikutnya
    slides[currentIndex].style.transform = "translateX(0)";
}

// Atur interval untuk slideshow
setInterval(showNextSlide, 2000); // Pindah setiap 3 detik
    </script>
    <footer>
    <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelas 2 Kelompok 8</p>
    </footer>
</body>
</html>
