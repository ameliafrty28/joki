<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Kesehatan UNRIYO</title>
    <link rel="stylesheet" href="style/about.css">
    <link rel="icon" href="favicon.png" type="image/png">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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
    <section id="about-us" class="about-us">
    <button class="back-button" onclick="window.location.href='index.php';">
        <i class="fas fa-arrow-left"></i>
    </button>

 
    <div class="about-grid">
        <div class="image-container">
            <img tabindex="0" src="img/medis.jpg" alt="Ilustrasi tentang platform KesehatanKu">
        </div>
        <div class="text-container">
            <h2 tabindex="0">Tentang Platform <span class="highlight">KESEHATANKU</span></h2>
            <p tabindex="0" class="intro-text">KESEHATANKU adalah platform digital yang didedikasikan untuk membantu remaja putri memahami dan menjaga kesehatan mereka. Kami percaya bahwa kesehatan adalah fondasi penting untuk masa depan yang cerah. Dengan informasi yang terpercaya, relevan, dan mudah diakses, kami hadir sebagai solusi untuk menjawab berbagai tantangan kesehatan yang sering dihadapi remaja putri.</p>
            <p tabindex="0">Website ini menyediakan informasi lengkap mengenai topik seperti anemia, kesehatan reproduksi, kesehatan mental, dan masalah nutrisi, serta solusi terkait tanda gejala, pengobatan, dan pencegahan.</p>

            <div class="topics-list">
                <p><strong>Anemia:</strong> Informasi tentang pencegahan, tanda gejala, dan cara pengobatan.</p>
                <p><strong>Kesehatan Reproduksi:</strong> Pentingnya menjaga kesehatan reproduksi dengan cara yang benar.</p>
                <p><strong>Kesehatan Mental:</strong> Pentingnya menjaga keseimbangan emosi dan mental.</p>
                <p><strong>Masalah Nutrisi:</strong> Pentingnya pola makan sehat.</p>
            </div>

            <p class="closing-text">Melalui KESEHATANKU, kami ingin memberikan dampak positif bagi generasi muda dengan meningkatkan kesadaran dan pengetahuan tentang kesehatan.</p>
            <h2>Misi Kami</h2>
            <ol class="mission-list">
                <li>Menyediakan informasi kesehatan terpercaya dan relevan.</li>
                <li>Meningkatkan kesadaran akan pentingnya menjaga kesehatan secara holistik.</li>
                <li>Menjadi mitra edukasi bagi remaja putri dalam menjalani hidup sehat dan bahagia.</li>
            </ol>
            <h2>Komitmen Kami</h2>
            <p>Kami berkomitmen untuk terus menyempurnakan layanan kami, agar platform KESEHATANKU menjadi sumber informasi utama yang dapat diandalkan oleh setiap remaja putri di Indonesia.</p>
        </div>
    </div>
</section>


        <section id="team" class="team">
            <h2 tabindex="0">Anggota Kelompok Kami</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img tabindex="0" src="img/sharon.png" alt="Foto Sharon Saully A.B">
                    <h3 tabindex="0">Sharon Saully A.B</h3>
                    <p tabindex="0">[22130022] Prodi. Keperawatan</p>
                </div>
                <div class="team-member">
                    <img tabindex="0" src="img/yulaikha.png" alt="Foto Yulaikha Handayani">
                    <h3 tabindex="0">Yulaikha Handayani</h3>
                    <p tabindex="0">[22130023] Prodi. Keperawatan</p>
                </div>
                <div class="team-member">
                    <img tabindex="0" src="img/nasya.png" alt="Foto Nasya Aulina">
                    <h3 tabindex="0">Nasya Aulina</h3>
                    <p tabindex="0">[22110015] Prodi. Kesehatan Masyarakat</p>
                </div>
                <div class="team-member">
                    <img tabindex="0" src="img/arya.png" alt="Foto Arya Jaya Pradana">
                    <h3 tabindex="0">Arya Jaya Pradana</h3>
                    <p tabindex="0">[22110016] Prodi. Kesehatan Masyarakat</p>
                </div>
                <div class="team-member">
                    <img tabindex="0" src="img/maria.png" alt="Foto Maria Karlina Lero">
                    <h3 tabindex="0">Maria Karlina Lero</h3>
                    <p tabindex="0">[22180014] Prodi. Kebidanan</p>
                </div>
                <div class="team-member">
                    <img tabindex="0" src="img/amanda2.png" alt="Foto Amanda Amelia Geli">
                    <h3 tabindex="0">Amanda Amelia Geli</h3>
                    <p tabindex="0">[22180015] Prodi. Kebidanan</p>
                </div>

            </div>
        </section>
    </main>
    <script src="hamburger.js" defer></script>

    <footer>
    <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelas 2 Kelompok 8</p>
    </footer>
</body>
</html>
