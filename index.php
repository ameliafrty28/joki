<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Kesehatan UNRIYO</title>
    <link rel="stylesheet" href="style/tampilanawal.css">
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
                <li><a href="#home">Home</a></li>
                <li><a href="#about-us">About Us</a></li>
                <li><a href="#team">Team</a></li>
            </ul>
        </nav>
    </header>

    <main>
    <section id="home">
        <div class="home-text">
            <h2>Jaga Kesehatan Anda dengan <span class="highlight">KesehatanKu</span></h2>
            <p>Temukan informasi kesehatan remaja putri yang relevan dan bermanfaat untuk hidup sehat dan bahagia.</p>
            <p><strong>Login</strong> sekarang untuk mengakses panduan kesehatan eksklusif dan tips menarik!</p>
            <a href="login.php" class="btn-login">Login</a>
            <a href="register.php" class="btn-register">Daftar Akun</a>
            <a href="login.php" class="btn-login">Cek Kesehatan Anda</a>
        </div>
        <div class="home-image">
            <img tabindex="0" src="img/kesehatan.png" alt="Gambar Icon">
        </div>
    </section>

    <section id="about-us" class="about-us">
        <div>
          <img tabindex="0" src="img/tentang.jpg" alt="Logo">
        </div>
        <div>
          <h2 tabindex="0">Tentang Platform Ini</h2>
          <p tabindex="0">
          Adanya platform KESEHATANKU ini yang bertujuan untuk membantu, Remaja putri dapat dengan mudah mengakses informasi kesehatan yang relevan dan terkini kapan saja dan dimana saja melalui internet. Website ini menyediakan informasi yang mudah dipahami dan relevan untuk remaja putri, seperti Anemia, Kesehatan Reproduksi, Kesehatan Mental, dan Nutrisi.          </p>
          <p tabindex="0">
          Dalam website ini terdapat beberapa topik permasalahan untuk remaja putri. informasi yaitu, pengertian, tanda gejala, dampak, pengobatan dan penyakit.  Website ini dapat meningkatkan kesadaran dan pengetahuan remaja putri tentang pentingnya menjaga kesehatan.
          </p>
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
