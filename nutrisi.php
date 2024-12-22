<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/nutrisi.css">
    <title>Informasi Nutrisi</title>
</head>
<body>
<header>
        <nav>
            <img src="img/logo.png" alt="Logo" class="logo">
            <h1>Web Kesehatan UNRIYO</h1>
            <ul>
                <li><a href="index.php#home">Home</a></li>
                <li><a href="index.php#about">About Us</a></li>
                <li><a href="profil.php">Akun Saya</a></li>
            </ul>
        </nav>
    </header>
    <main> 
        <h1>Informasi Tentang Nutrisi</h1>
        <section> 
        <h2 class="accordion">Apa Itu Nutrisi</h2>
        <div class="content">
        <p>
            Nutrisi merupakan elemen penting dalam kehidupan manusia untuk menjaga kesehatan tubuh. 
            Pemenuhan nutrisi yang seimbang meliputi karbohidrat, protein, lemak, vitamin, mineral, 
            dan air untuk mendukung fungsi tubuh yang optimal.
        </p>
        <p>
            Kekurangan atau kelebihan nutrisi dapat menyebabkan berbagai masalah kesehatan, 
            seperti obesitas, malnutrisi, dan penyakit kronis lainnya. Oleh karena itu, penting untuk mengetahui kebutuhan nutrisi harian sesuai usia, berat badan, tinggi badan, dan aktivitas fisik.
        </p>
        <a href="cek-nutrisi.php" class="btn">Cek Kebutuhan Nutrisi Anda</a>
        </div>

        <h2 class="accordion">Tanda dan Gejala</h2>
            <div class="content">            
                <p>Kekurangan nutrisi dapat terjadi pada siapa saja, termasuk anak-anak, orang dewasa, hingga lansia. Jika tidak ditangani, gizi buruk dapat menyebabkan komplikasi seperti dehidrasi berat, hipotermia, anemia, gangguan tumbuh kembang, gangguan otak, terserang penyakit infeksi berat, dan kematian. </p>
                <ul>
                    <li>Penurunan berat badan</li>
                    <li>Mudah lelah</li>
                    <li>Kulit dan rambut kering</li>
                    <li>Pipi dan mata cekung</li>
                    <li>Konsentrasi menurun</li>
                    <li>Kehilangan selera makan</li>
                    <li>Pembengkakan dibagian tubuh tertentu, seperti di perut, wajah, atau kaki</li>
                </ul>
            </div>

            <h2 class="accordion">Dampak</h2>
            <div class="content">            
                <p>Kekurangan nutrisi atau malnutrisi dapat menyebabkan berbagai dampak dan komplikasi, di antaranya:</p>
                <ul>
                    <li><h3>Pada Anak</h3>
                        <p>Kekurangan gizi saat hamil dapat menyebabkan anemia, terutama jika tidak mengonsumsi makanan yang mengandung zat besi. </p></li>
                    <li><h3>Pada Ibu Hamil</h3>
                        <p>Pola  tidur yang kurang baik pada remaja putri yang sering tidur malam diatas jam 10 sehingga durasi tidur yang didapatkan kurang dari 8 jam. Ketika seseorang memiliki waktu tidur yang kurang maka akan mengakibatkan rasa lemas, pusing dan tidak durasi tidur yang kurang juga mengakibatkan hemoglobin menurun.</p></li>
                    <li><h3>Penyakit Yang Dapat Terjadi</h3>
                        <p>Kekurangan vitamin C dapat menyebabkan penyakit kudis, yang ditandai dengan gejala seperti gusi berdarah, penyembuhan luka yang lama, bintik-bintik pada kulit, dan peningkatan kerentanan terhadap infeksi. </p></li>
                    <li><h3>Resistensi Insulin</h3>
                        <p>Kekurangan asupan vitamin D harian dapat meningkatkan risiko terjadinya resistensi insulin, yang dapat berkembang menjadi diabetes.  </p></li>
                </ul>
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
