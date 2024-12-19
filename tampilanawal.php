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
</head>
<body>
    <header>
        <nav>
            <img src="img/logo.png" alt="Logo" class="logo">
            <h1>Kesehatanku</h1>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about-us">About Us</a></li>
                <li><a href="#team">Team</a></li>
            </ul>
        </nav>
    </header>

    <main>
    <section id="home">
        <div class="home-text">
            <h2>Selamat Datang di KESEHATANKU</h2>
            <p>Platform ini menyediakan informasi mengenai kesehatan Anda.</p>
            <p>Platform ini menyediakan informasi yang berguna tentang kesehatan remaja putri.</p>
            <a href="login.php" class="btn-login">Login</a>
            <a href="register.php" class="btn-register">Daftar Akun</a>

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
                    <div class="image-container">
                        <img tabindex="0" src="img/kesehatan.png" alt="Foto Sharon Saully A.B">
                    </div>
                    <h3 tabindex="0">Sharon Saully A.B</h3>
                    <p tabindex="0">[22130022] Prodi. Keperawatan</p>
                </div>
                <div class="team-member">
                    <div class="image-container">
                        <img tabindex="0" src="img/kesehatan.png" alt="Foto Yulaikha Handayani">
                    </div>
                    <h3 tabindex="0">Yulaikha Handayani</h3>
                    <p tabindex="0">[22130023] Prodi. Keperawatan</p>
                </div>
                <div class="team-member">
                    <div class="image-container">
                        <img tabindex="0" src="img/kesehatan.png" alt="Foto Nasya Aulina">
                    </div>
                    <h3 tabindex="0">Nasya Aulina</h3>
                    <p tabindex="0">[22110015] Prodi. Kesehatan Masyarakat</p>
                </div>
            </div>
            <div class="team-grid">
                <div class="team-member">
                    <div class="image-container">
                        <img tabindex="0" src="img/kesehatan.png" alt="Foto Arya Jaya Pradana">
                    </div>
                    <h3 tabindex="0">Arya Jaya Pradana</h3>
                    <p tabindex="0">[22110016] Prodi. Kesehatan Masyarakat</p>
                </div>
                <div class="team-member">
                    <div class="image-container">
                        <img tabindex="0" src="img/kesehatan.png" alt="Maria Karlina Lero">
                    </div>
                    <h3 tabindex="0">Maria Karlina Lero</h3>
                    <p tabindex="0">[22180014] Prodi. Kebidanan</p>
                </div>
                <div class="team-member">
                    <div class="image-container">
                        <img tabindex="0" src="img/kesehatan.png" alt="Foto Amanda Amelia Geli">
                    </div>
                    <h3 tabindex="0">Amanda Amelia Geli</h3>
                    <p tabindex="0">[22180015] Prodi. Kebidanan</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelompok 8 Kelas 2.</p>
    </footer>
</body>
</html>
