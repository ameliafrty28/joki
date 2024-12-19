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
    <title>Informasi Anemia</title>
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
        <h1>Informasi Anemia</h1>
        <section>
            <h2>Apa itu Anemia?</h2>
            <p>Anemia adalah kondisi dimana jumlah sel darah merah atau kadar hemaglobin di dalam darah lebih rendah dari batas normal yaitu 12-15g/dl untuk remaja putri. Hemoglobin adalah protein dalam sel darah merah yang berfungsi mengangkut oksigen dari paru-paru ke seluruh tubuh. Ketika seseorang mengalami anemia, tubuh kekurangan oksigen yang dibutuhkan untuk menjalankan fungsi normal.</p>

            <h2>Tanda dan Gejala</h2>
            <p>Tanda gejala yang sering terjadi pada remaja putri yang mengalami anemia biasanya mengalami  5L(Lemah, Letih, Lesu, Lunglai, dan Lelah) </p>
            <ul>
                <li>Lemah: Merasa tidak bertenaga dan mudah lelah.</li>
                <li>Letih: Merasa sangat capek dan ingin selalu beristirahat.</li>
                <li>Lesu: Tubuh terasa sangat berat dan malas bergerak.</li>
                <li>Lunglai: Sulit berkonsentrasi dan mudah lupa.</li>
                <li>Lelah: Kondisi di mana tubuh terasa sangat letih dan tidak bersemangat.</li>
            </ul>

            <h2>Dampak dan Komplikasi</h2>
            <p>Dampak anemia pada remaja putri yaitu pertumbuhan terhambat, sering merasa sakit kepala di sertai pusing,mata berkunang-kunang,sulit berkonsentrasi dalam mengerjakan sesuatu,konsentrasi belajar menurun dan aktifitas fisik menurun,kelopak mata bibir, kulit, dan kuku tampak pucat,tubuh mudah terinfeksi. Komplikasi, pada saat persalinan yaitu terjadi pendarah saat bersalin, Komplikasi pada kehamilan,kelahiran prematur pada bayi dan berat badan bayi rendah(BBLR), Gangguan tumbuh kembang pada bayi yang dilahirkan</p>
            <p>Jika tidak ditangani, anemia dapat menyebabkan komplikasi seperti kerusakan organ, gangguan kehamilan, dan lain-lain.</p>

            <h2>Penyebab</h2>
            <p>Anemia dapat disebabkan oleh pola makan, pola tidur, atau menstruasi.</p>
            <ul>
                <li><h3>Pola Makan</h3>
                    <p>Remaja putri yang mengalami anemia dikarenakan pola makan yang kurang sehat seperti kurang mengkonsumsi makanan yang bergizi yang kaya akan zat besi. kurangnya asupan makanan bergizi seperti protein hewani, sayuran hijau dan makanan lain yang merupakan sumber zat besi.pemilihan makan yang kurang tepat seperti mengonsumsi makan cepat saji,menjadi pemicu terjadinya anemia pada remaja putri.</p></li>
                <li><h3>Pola Tidur</h3>
                    <p>Pola  tidur yang kurang baik pada remaja putri yang sering tidur malam diatas jam 10 sehingga durasi tidur yang didapatkan kurang dari 8 jam. Ketika seseorang memiliki waktu tidur yang kurang maka akan mengakibatkan rasa lemas, pusing dan tidak durasi tidur yang kurang juga mengakibatkan hemoglobin menurun.</p></li>
                <li><h3>Menstruasi</h3>
                    <p>Anemia lebih banyak terjadi akibat pola menstruasi yang tidak normal. Anemia lebih banyak terjadi pada wanita, hal ini disebabkan karena wanita perlu melalui masa menstruasi secara teratur setiap bulan. Ketika menstruasi jumlah darah yang keluar terbilang cukup banyak sehingga tentunya mempengaruhi kadar hemoglobin dalam tubuh. Semakin banyak dan lama seseorang menstruasi tentu semakin besar kemungkinan seseorang itu mengalami anemia atau kekurangan hemoglobin.</p></li>
            </ul>
            <h2>Pencegahan</h2>
            <ul>
                <li><h3>Mengatur Pola Makan</h3>
                    <p>Untuk mencegah anemia dengan meningkatkan konsumsi makanan bergizi seperti makanan hewani (daging, ikan, ayam, hati dan telur) dan bahan makanan nabati (sayuran berwarna hijau tua, kacanng-kacangan, dan tempe), mengkonsumsi sayuran dan buah yang mengandung vitamin C seperti daun katuk, daun singkong, bayam, jambu yang dapat membantu porses penyerapan zat besi dalam usus, dan menambah kadar zat besi.dan hindari mengonsumsi makanan cepat saji secara berlebihan.</p></li>
                <li><h3>Mengatur Pola Tidur dan Jam Istirahat</h3>
                    <p>Untuk mencegah terjadinya anemia dapat dilakukan dengan mengatur pola tidur yang cukup yaitu 7-8 jam pada malam hari,dan hindari tidur diatas jam 10 malam.</p></li>
            </ul>
            <h2>Pengobatan</h2>
            <p>Salah satu cara yang dapat dilakukan untuk mengobati anemia pada remaja putri yaitu dengan mengkonsumsi tablet tambah darah (FE).Remaja putri di anjurkan untuk meminum tablet tabah darah(FE) 1 kali dalam seminggu pada saat menstruasi untuk, membantu meningkatkan kadar hemoglobin dalam darah sehingga dapat mengatasi gejala anemia.
            <h3>Cara meminum tablet tambah darah
            <ul>
                <li>Satu tablet seminggu sekali di hari yang sama
                <li>Diminum setelah makan
                <li>Diminum dengan air putih atau jus jeruk
                <li>Hindari diminum bersamaan dengan teh, susu, atau kopi
                <li>Setelah minum tablet tambah darah ,anjurkan untuk makan buah yang mengandung vitamin C untuk meningkatkan penyerapan zat besi
            </ul>
        </section>

        <section>
            <h2>Ingin Mengetahui Lebih Lanjut?</h2>
            <p>Ikuti tes kesehatan anemia untuk mengetahui kondisi Anda lebih lanjut.</p>
            <form action="pengetesan_anemia.php" method="GET">
                <button type="submit">Mulai Tes</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelompok 8 Kelas 2.</p>
    </footer>
</body>
</html>
