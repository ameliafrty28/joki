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
    <link rel="stylesheet" href="style/kesehatan_mental.css">
</head>
<body>
    <header>
        <nav>
            <img src="img/logo.png" alt="Logo" class="logo">
            <h1>Web Kesehatan UNRIYO</h1>
            <ul>
                <li><a href="index.php#home">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="profil.php">Akun Saya</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Informasi Kesehatan Mental</h1>
        <img src="img/kesehatan_mental.jpg" alt="hero" class="hero">
        <section id="info">
            <h2 class="accordion">Tingkat Stres pada Remaja Putri</h2>
            <div class="content">
            <p>Kesehatan mental adalah aspek penting dalam kehidupan, terutama bagi remaja putri yang sering menghadapi berbagai tantangan emosional dan sosial. Tingkat stres yang tinggi dapat berdampak pada kesehatan mental dan kualitas hidup secara keseluruhan.</p>
            <p>Dengan memahami tingkat stres yang dialami, langkah-langkah pencegahan dan pengelolaan stres dapat dilakukan untuk mendukung kesehatan mental yang lebih baik.</p>
            </div>
        </section>

        <section id="action">
            <h2 class="accordion">Tes Kesehatan Mental</h2>
            <div class="content">
            <p>Klik tombol di bawah ini untuk melakukan tes kesehatan mental dan mengetahui tingkat stres Anda. Pertanyaan dalam tes ini akan membantu mengidentifikasi faktor-faktor yang mungkin memengaruhi kesehatan mental Anda.</p>
            <a href="tes_kesehatan_mental.php" class="btn">Mulai Tes Kesehatan Mental</a>
            </div>
        </section>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const accordions = document.querySelectorAll('.accordion');

        accordions.forEach(accordion => {
            accordion.addEventListener('click', function () {
                // Toggle class "show" pada konten di bawahnya
                const content = this.nextElementSibling;
                content.classList.toggle('show');

                // Tambahkan animasi jika diperlukan
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        });
    });
    </script>

    <footer>
        <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelompok 8 Kelas 2.</p>
    </footer>
</body>
</html>
