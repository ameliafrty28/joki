<?php
include 'koneksi.php';

// Query untuk mengambil pertanyaan terkait Anemia
$sql = "SELECT pertanyaan FROM tb_pertanyaan_kesehatan WHERE id_kategori = 1";
$result = $conn->query($sql);
$questions = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row['pertanyaan'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/anemia.css">
    <link rel="icon" href="favicon.png" type="image/png">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Informasi Anemia</title>
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

        <h1>Informasi Anemia</h1>
        <img src="img/Mengatasi-anemia.jpeg" alt="hero" class="hero">
        <section>
            <h2 class="accordion">Apa itu Anemia?</h2>
            <div class="content">
                <p>Anemia adalah kondisi dimana jumlah sel darah merah atau kadar hemaglobin di dalam darah lebih rendah dari batas normal yaitu 12-15g/dl untuk remaja putri. Hemoglobin adalah protein dalam sel darah merah yang berfungsi mengangkut oksigen dari paru-paru ke seluruh tubuh. Ketika seseorang mengalami anemia, tubuh kekurangan oksigen yang dibutuhkan untuk menjalankan fungsi normal.</p>
            </div>

            <h2 class="accordion">Tanda dan Gejala</h2>
            <div class="content">            
                <p>Tanda gejala yang sering terjadi pada remaja putri yang mengalami anemia biasanya mengalami  5L(Lemah, Letih, Lesu, Lunglai, dan Lelah) </p>
                <ul>
                    <li>Lemah: Merasa tidak bertenaga dan mudah lelah.</li>
                    <li>Letih: Merasa sangat capek dan ingin selalu beristirahat.</li>
                    <li>Lesu: Tubuh terasa sangat berat dan malas bergerak.</li>
                    <li>Lunglai: Sulit berkonsentrasi dan mudah lupa.</li>
                    <li>Lelah: Kondisi di mana tubuh terasa sangat letih dan tidak bersemangat.</li>
                </ul>
            </div>

            <h2 class="accordion">Dampak dan Komplikasi</h2>
            <div class="content">            
                <p>Dampak anemia pada remaja putri yaitu pertumbuhan terhambat, sering merasa sakit kepala di sertai pusing,mata berkunang-kunang,sulit berkonsentrasi dalam mengerjakan sesuatu,konsentrasi belajar menurun dan aktifitas fisik menurun,kelopak mata bibir, kulit, dan kuku tampak pucat,tubuh mudah terinfeksi. Komplikasi, pada saat persalinan yaitu terjadi pendarah saat bersalin, Komplikasi pada kehamilan,kelahiran prematur pada bayi dan berat badan bayi rendah(BBLR), Gangguan tumbuh kembang pada bayi yang dilahirkan</p>
                <p>Jika tidak ditangani, anemia dapat menyebabkan komplikasi seperti kerusakan organ, gangguan kehamilan, dan lain-lain.</p>
            </div>

            <h2 class="accordion">Penyebab</h2>
            <div class="content">            
                <p>Anemia dapat disebabkan oleh pola makan, pola tidur, atau menstruasi.</p>
                <ul>
                    <li><h3>Pola Makan</h3>
                        <p>Remaja putri yang mengalami anemia dikarenakan pola makan yang kurang sehat seperti kurang mengkonsumsi makanan yang bergizi yang kaya akan zat besi. kurangnya asupan makanan bergizi seperti protein hewani, sayuran hijau dan makanan lain yang merupakan sumber zat besi.pemilihan makan yang kurang tepat seperti mengonsumsi makan cepat saji,menjadi pemicu terjadinya anemia pada remaja putri.</p></li>
                    <li><h3>Pola Tidur</h3>
                        <p>Pola  tidur yang kurang baik pada remaja putri yang sering tidur malam diatas jam 10 sehingga durasi tidur yang didapatkan kurang dari 8 jam. Ketika seseorang memiliki waktu tidur yang kurang maka akan mengakibatkan rasa lemas, pusing dan tidak durasi tidur yang kurang juga mengakibatkan hemoglobin menurun.</p></li>
                    <li><h3>Menstruasi</h3>
                        <p>Anemia lebih banyak terjadi akibat pola menstruasi yang tidak normal. Anemia lebih banyak terjadi pada wanita, hal ini disebabkan karena wanita perlu melalui masa menstruasi secara teratur setiap bulan. Ketika menstruasi jumlah darah yang keluar terbilang cukup banyak sehingga tentunya mempengaruhi kadar hemoglobin dalam tubuh. Semakin banyak dan lama seseorang menstruasi tentu semakin besar kemungkinan seseorang itu mengalami anemia atau kekurangan hemoglobin.</p></li>
                </ul>
            </div>

            <h2 class="accordion">Pencegahan</h2>
            <div class="content">            
                <ul>
                    <li><h3>Mengatur Pola Makan</h3>
                        <p>Untuk mencegah anemia dengan meningkatkan konsumsi makanan bergizi seperti makanan hewani (daging, ikan, ayam, hati dan telur) dan bahan makanan nabati (sayuran berwarna hijau tua, kacanng-kacangan, dan tempe), mengkonsumsi sayuran dan buah yang mengandung vitamin C seperti daun katuk, daun singkong, bayam, jambu yang dapat membantu porses penyerapan zat besi dalam usus, dan menambah kadar zat besi.dan hindari mengonsumsi makanan cepat saji secara berlebihan.</p></li>
                    <li><h3>Mengatur Pola Tidur dan Jam Istirahat</h3>
                        <p>Untuk mencegah terjadinya anemia dapat dilakukan dengan mengatur pola tidur yang cukup yaitu 7-8 jam pada malam hari,dan hindari tidur diatas jam 10 malam.</p></li>
                </ul>
            </div>

            <h2 class="accordion">Pengobatan</h2>
            <div class="content">            
                <p>Salah satu cara yang dapat dilakukan untuk mengobati anemia pada remaja putri yaitu dengan mengkonsumsi tablet tambah darah (FE).Remaja putri di anjurkan untuk meminum tablet tabah darah(FE) 1 kali dalam seminggu pada saat menstruasi untuk, membantu meningkatkan kadar hemoglobin dalam darah sehingga dapat mengatasi gejala anemia.
                <h3>Cara meminum tablet tambah darah
                <ul>
                    <li>Satu tablet seminggu sekali di hari yang sama
                    <li>Diminum setelah makan
                    <li>Diminum dengan air putih atau jus jeruk
                    <li>Hindari diminum bersamaan dengan teh, susu, atau kopi
                    <li>Setelah minum tablet tambah darah ,anjurkan untuk makan buah yang mengandung vitamin C untuk meningkatkan penyerapan zat besi
                </ul>
            </div>
        </section>
        <section>
            <h2>Ingin Mengetahui Lebih Lanjut?</h2>
            <p>Ikuti tes kesehatan anemia untuk mengetahui kondisi Anda lebih lanjut.</p>
            <form action="cek-anemia.php" method="GET">
                <button type="submit" class="btn-tes">Mulai Tes</button>
            </form>
        </section>
        <section class="references">
            <h2 class="references-title">Referensi</h2>
            <ul class="references-list">
                <li class="references-item">
                    <a href="https://jurnal.ugm.ac.id/jpkm/article/download/40570/25068" target="_blank" class="references-link">
                        Peningkatan Kadar Hemoglobin melalui Pemeriksaan dan Pemberian Tablet Fe Terhadap Remaja yang mengalami Anemia Melalui "Gerakan Jumat Pintar"
                    </a>
                </li>
                <li class="references-item">
                    <a href="https://pkgm.fk.ugm.ac.id/2022/05/18/pencegahan-anemia-pada-remaja/" target="_blank" class="references-link">
                        Pencegahan Anemia Pada Remaja
                    </a>
                </li>
                <li class="references-item">
                    <a href="https://ejournal.stikku.ac.id/index.php/nnc/article/view/870" target="_blank" class="references-link">
                    Sukmanawati, D., Badriah, D. L., & Setiayu, Y. (2023, October). HUBUNGAN PENGETAHUAN DAN SIKAP TENTANG MANFAAT KONSUMSI TABLET FE DENGAN KADAR HEMOGLOBIN PADA REMAJA PUTRI DI SMAN 1 DARMA. In National Nursing Conference (Vol. 1, No. 2, pp. 165-176)."
                    </a>
                </li>
                <li class="references-item">
                    <a href="https://www.who.int/data/gho/data/themes/topics/anaemia_in_women_and_children " target="_blank" class="references-link">
                    WHO. 2021. Anaemia in women and children. Retrieved 12 November 2024
                    </a>
                </li>
                <li class="references-item">
                    <p class="references-text">World Health Organization (WHO). "Nutritional Anemia."</p>
                </li>
                <li class="references-item">
                    <p class="references-text">Centers for Disease Control and Prevention (CDC). "Iron Deficiency Anemia."</p>
                </li>
                <li class="references-item">
                    <p class="references-text">Meiliana, V. (2018). Gambaran faktor risiko anemia pada remaja putri kelas X di SMAN 3 Kabupaten Tangerang tahun 2018 (Laporan Tugas Akhir). Kementerian Kesehatan Republik Indonesia, Politeknik Kesehatan Jakarta III, Jurusan Kebidanan, Program Studi D.III Kebidanan."</p>
                </li>
            </ul>
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
<script src="hamburger.js" defer></script>


    <footer>
    <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelas 2 Kelompok 8</p>
    </footer>
</body>
</html>
