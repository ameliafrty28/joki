<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require 'koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kesehatan Mental</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <header>
        <nav>
            <img src="img/logo.png" alt="Logo" class="logo">
            <h1>Web Kesehatan UNRIYO</h1>
            <ul>
                <li><a href="index.php#home">Home</a></li>
                <li><a href="index.php#about">About Us</a></li>
                <li><a href="profile.php">Akun Saya</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="info">
            <h2>Tingkat Stres pada Remaja Putri</h2>
            <p>Kesehatan mental adalah aspek penting dalam kehidupan, terutama bagi remaja putri yang sering menghadapi berbagai tantangan emosional dan sosial. Tingkat stres yang tinggi dapat berdampak pada kesehatan mental dan kualitas hidup secara keseluruhan.</p>
            <p>Dengan memahami tingkat stres yang dialami, langkah-langkah pencegahan dan pengelolaan stres dapat dilakukan untuk mendukung kesehatan mental yang lebih baik.</p>
        </section>

        <section id="action">
            <h3>Tes Kesehatan Mental</h3>
            <p>Klik tombol di bawah ini untuk melakukan tes kesehatan mental dan mengetahui tingkat stres Anda. Pertanyaan dalam tes ini akan membantu mengidentifikasi faktor-faktor yang mungkin memengaruhi kesehatan mental Anda.</p>
            <a href="tes_kesehatan_mental.php" class="btn">Mulai Tes Kesehatan Mental</a>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelompok 8 Kelas 2.</p>
    </footer>
</body>
</html>
