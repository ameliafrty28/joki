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
                <li><a href="index2.php">Home</a></li>
                <li><a href="about-us.php">About Us</a></li>
                <li><a href="profile.php">Akun Saya</a></li>
            </ul>

        </nav>
    </header>

    <main>
        
    <section id="about-us" class="about-us">
    <button class="back-button" onclick="window.location.href='index2.php';">
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
                <p>Dampak anemia pada remaja putri yaitu pertumbuhan terhambat, sering merasa sakit kepala di sertai pusing, mata berkunang-kunang, sulit berkonsentrasi dalam mengerjakan sesuatu, konsentrasi belajar menurun dan aktifitas fisik menurun, kelopak mata bibir, kulit, dan kuku tampak pucat, dan tubuh mudah terinfeksi.</p>
                <br><p>Anemia yang tidak segera ditangani, dapat menyebabkan komplikasi yang cukup fatal. Komplikasi anemia dapat menyebabkan pendarah saat bersalin, kelahiran prematur pada bayi dan berat badan bayi rendah (BBLR), ataupun gangguan tumbuh kembang pada bayi yang telah dilahirkan. Selain itu, anemia berat dapat dapat menimbulkan letargi, konfusi, serta komplikasi seperti gagal jantung, aritmia, infark miokard, dan angina.</p>
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
                    <a href="https://wnj.westscience-press.com/index.php/jmws/article/view/817" target="_blank" class="references-link">
                    Izzara, W. A., Yulastri, A., Erianti, Z., Putri, M. Y., & Yuliana, Y. (2023). Penyebab, Pencegahan dan Penanggulangan Anemia pada Remaja Putri (Studi Literatur). Jurnal Multidisiplin West Science, 2(12), 1051-1064.                    
                    </a>
                </li>
                <li class="references-item">
                    <a href="http://www.jurnalmedikahutama.com/index.php/JMH/article/view/266 " target="_blank" class="references-link">
                    Kusnadi, F. N. (2021). Hubungan Tingkat Pengetahuan Tentang Anemia dengan Kejadian Anemia pada Remaja Putri. Jurnal Medika Hutama, 3(01 Oktober), 1293-1298.                    
                    </a>
                </li>
                <li class="references-item">
                    <a href="http://114.7.227.163:6643/repository/repository/LTA_VINNA.pdf" target="_blank" class="references-link">
                    Meliana, Vinna. (2018). Gambaran Faktor Risiko Anemia Pada Remaja Putri Kelas X di SMAN 3 Kabupaten Tangerang.                
                    </a>
                </li>
                <li class="references-item">
                    <a href="https://scholar.archive.org/work/f4kijofrb5blteeri73gomg3yi/access/wayback/http://e-abdimas.unw.ac.id/index.php/jhhs/article/download/74/66" target="_blank" class="references-link">
                    Nafisah, N. M., & Safalas, Eti. (2021). Literature Review: Hubungan Pola Makan Dengan Kejadian Anemia Pada Remaja Putri. Journal of Holistics and Health Sciences, 3(2).                
                    </a>
                </li>
                <li class="references-item">
                    <a href="https://journal.ugm.ac.id/jpkm/article/view/40570" target="_blank" class="references-link">
                    Nuraeni, R., Sari, P., Martini, N., Astuti, S., & Rahmiati, L. (2019). Peningkatan Kadar Hemoglobin melalui Pemeriksaan dan Pemberian Tablet Fe Terhadap Remaja yang Mengalami Anemia Melalui “Gerakan Jumat Pintar”. Jurnal Pengabdian Kepada Masyarakat (Indonesian Journal of Community Engagement), 5(2), 200-221.
                </a>
                </li>
                <li class="references-item">
                    <a href="https://ejournal.stikku.ac.id/index.php/nnc/article/view/870" target="_blank" class="references-link">
                    Sukmanawati, D., Badriah, D. L., & Setiayu, Y. (2023, October). HUBUNGAN PENGETAHUAN DAN SIKAP TENTANG MANFAAT KONSUMSI TABLET FE DENGAN KADAR HEMOGLOBIN PADA REMAJA PUTRI DI SMAN 1 DARMA. In National Nursing Conference (Vol. 1, No. 2, pp. 165-176).                     
                    </a>
                </li>
                <li class="references-item">
                    <a href="https://search.ebscohost.com/login.aspx?direct=true&profile=ehost&scope=site&authtype=crawler&jrnl=16937228&AN=172337303&h=5DTWst5IuOfhalpG%2B1ek6A7sH5hy3svmoqyQU7%2B1kcpF250PvJcIz%2FmOnc0GDq0CLvdfcnR4AHiJMagNS5lEJQ%3D%3D&crl=c" target="_blank" class="references-link">
                    Suryani, D., & Nugroho, A. (2023). PENGARUH KOMBINASI ASUPAN PROTEIN, VITAMIN C DAN TABLET TAMBAH DARAH TEHADAP KADAR HEMOGLOBIN REMAJA PUTRI. National Nutrition Journal/Media Gizi Indonesia, 18.                 
                    </a>
                </li>
                <li class="references-item">
                    <a href="https://pesquisa.bvsalud.org/portal/resource/pt/sea-203912" target="_blank" class="references-link">
                    Vaidya, S. S., Nakate, D. P., Gaikwad, S. Y., Patil, R. S., & Ghogare, M. S. (2019). Nutritional anaemia: Clinical and haematological presentation in children.                
                    </a>
                </li>
                <li class="references-item">
                    <a href="https://www.who.int/data/gho/data/themes/topics/anaemia_in_women_and_children" target="_blank" class="references-link">
                    WHO. 2021. Anaemia in women and children. Retrieved 12 November 2024                
                    </a>
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
