<?php
// Menyertakan file koneksi
include('koneksi.php');

session_start();

// Mendapatkan ID user dari session (sesuaikan dengan aplikasi Anda)
$id_user = $_SESSION['id_user'];  // Misalnya, ID user disimpan di session

// Ambil pertanyaan kategori Anemia dari database
$sql = "SELECT * FROM tb_pertanyaan_kesehatan WHERE id_kategori = 1";
$result = $conn->query($sql);

$skor = 0;
$pertanyaan = [];

if ($result->num_rows > 0) {
    // Menyimpan pertanyaan dalam array
    while ($row = $result->fetch_assoc()) {
        $pertanyaan[] = $row;
    }
} else {
    echo "Tidak ada pertanyaan ditemukan";
}

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $skor = 0;
    // Proses jawaban untuk pertanyaan anemia
    foreach ($pertanyaan as $pertanyaan_data) {
        $id_pertanyaan = $pertanyaan_data['id_pertanyaan'];
        $jawaban = isset($_POST["jawaban_$id_pertanyaan"]) ? $_POST["jawaban_$id_pertanyaan"] : 0;
        
        // Menyimpan jawaban ke database
        $stmt = $conn->prepare("INSERT INTO tb_jawaban (id_user, id_pertanyaan, jawaban) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $id_user, $id_pertanyaan, $jawaban);
        $stmt->execute();

        // Menambahkan skor
        $skor += $jawaban;
    }

    // Evaluasi hasil pengetahuan
    $pengetahuan = '';
    $skor_percentage = ($skor / 10) * 100;
    if ($skor_percentage > 75) {
        $pengetahuan = 'Baik';
    } elseif ($skor_percentage >= 60) {
        $pengetahuan = 'Cukup';
    } else {
        $pengetahuan = 'Kurang';
    }

    // Proses pertanyaan lainnya: Menstruasi, Tablet Tambah Darah, dan Makanan
    // Menstruasi
    $siklus_haid = $_POST['siklus_haid']; // Misalnya siklus_haid adalah input user
    $durasi_haid = $_POST['durasi_haid']; // Durasi menstruasi

    $pola_menstruasi = ($siklus_haid == 1) ? 'Teratur' : 'Tidak Teratur';
    $lama_menstruasi = ($durasi_haid >= 3 && $durasi_haid <= 7) ? 'Normal' : 'Tidak Normal';

    // Konsumsi makanan
    $makanan = $_POST['makanan']; // Konsumsi tempe/udang

    // Tablet tambah darah
    $tdd_haid = $_POST['tdd_haid']; // Konsumsi TTD saat haid
    $tdd_non_haid = $_POST['tdd_non_haid']; // Konsumsi TTD saat non haid

    // Evaluasi konsumsi makanan dan TTD
    $konsumsi_makanan = ($makanan == 'tempe') ? 'Sering' : ($makanan == 'ayam goreng' ? 'Jarang' : 'Tidak Mengkonsumsi');
    $konsumsi_ttd = ($tdd_haid && $tdd_non_haid) ? 'Teratur' : ($tdd_haid || $tdd_non_haid ? 'Tidak Teratur' : 'Tidak Pernah');

    // Menggabungkan hasil analisis
    $hasil_analisis = '';
    $result_risiko = '';
    $saran = '';

// Evaluasi kondisi risiko anemia
if ($skor_percentage < 50) {
    $result_risiko = 'Berisiko';
    $saran = "Saran untuk remaja putri berisiko mengalami anemia:
    - Makan makanan kaya zat besi seperti daging, sayuran hijau (bayam, kangkung, dan buah kering).
    - Pertimbangkan suplemen sesuai anjuran dokter.
    - Lakukan pemeriksaan kadar hemoglobin secara berkala.
    
    Sumber:
    - Peningkatan Kadar Hemoglobin melalui Pemeriksaan dan Pemberian Tablet Fe Terhadap Remaja yang mengalami Anemia Melalui 'Gerakan Jumat Pintar' https://jurnal.ugm.ac.id/jpkm/article/download/40570/25068
    - Pencegahan Anemia Pada Remaja https://pkgm.fk.ugm.ac.id/2022/05/18/pencegahan-anemia-pada-remaja/
    - World Health Organization (WHO). 'Nutritional Anemia.'
    - Centers for Disease Control and Prevention (CDC). 'Iron Deficiency Anemia.'";
} else {
    $result_risiko = 'Tidak Berisiko';
    $saran = "
    - Konsumsi makanan kaya zat besi
    - Tambahkan vitamin C
    - Hindari kafein berlebihan 
    - Penuhi kebutuhan asam folat dan vitamin B12
    - Minum tablet tambah darah
    - Jaga pola makan seimbang 
    - Rutin Olahraga";
}

$id_kategori = 1; // ID kategori anemia

// Menyimpan hasil analisis ke dalam tb_riwayat_anemia
$stmt_riwayat = $conn->prepare("INSERT INTO tb_riwayat_anemia (id_user, id_kategori, hasil_analisis, pola_menstruasi, lama_menstruasi, konsumsi_makanan, mengkonsumsi_ttd, pengetahuan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt_riwayat->bind_param("iissssss", $id_user, $id_kategori, $result_risiko, $pola_menstruasi, $lama_menstruasi, $konsumsi_makanan, $konsumsi_ttd, $pengetahuan);
$stmt_riwayat->execute();

}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Anemia</title>
    <link rel="stylesheet" href="style/cek-anemia.css">
</head>
    <header>
        <nav>
            <img src="img/logo.png" alt="Logo" class="logo">
            <h1>KesehatanKu</h1>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about-us.php">About Us</a></li>
                <li><a href="profile.php">Akun Saya</a></li>
            </ul>
        </nav>
    </header>
    <body>
    <main>
        <h1>Pemeriksaan Risiko Anemia</h1>

        <div class="container">  <!-- Menambahkan container di sini -->
            <form action="cek-anemia.php" method="POST">
                <h2>A. PENGETAHUAN</h2>
                <?php foreach ($pertanyaan as $pertanyaan_data): ?>
                    <div class="question">
                        <label for="jawaban_<?php echo $pertanyaan_data['id_pertanyaan']; ?>">
                            <?php echo $pertanyaan_data['pertanyaan']; ?>
                        </label><br>
                        <input type="radio" name="jawaban_<?php echo $pertanyaan_data['id_pertanyaan']; ?>" value="1" required> Benar
                        <input type="radio" name="jawaban_<?php echo $pertanyaan_data['id_pertanyaan']; ?>" value="0"> Salah
                    </div>
                <?php endforeach; ?>

                <h2>B. MENSTRUASI</h2>
                <label for="siklus_haid">Pola Menstruasi:</label>
                <select name="siklus_haid">
                    <option value="1">Teratur (1 kali dalam 1 bulan)</option>
                    <option value="2">Tidak Teratur (2 kali atau lebih dalam sebulan, atau 2 bulan sekali atau lebih)</option>
                </select><br>

                <label for="durasi_haid">Durasi Menstruasi:</label>
                <select name="durasi_haid">
                    <option value="3">3-7 Hari</option>
                    <option value="8">Lebih dari 7 Hari</option>
                </select><br>

                <h2>C. TABLET TAMBAH DARAH (TTD)</h2>
                <label for="tdd_haid">Apakah anda mengkonsumsi tablet tambah darah setiap hari saat menstruasi?</label>
                <input type="radio" name="tdd_haid" value="1"> Ya
                <input type="radio" name="tdd_haid" value="0"> Tidak<br>

                <label for="tdd_non_haid">Apakah anda mengkonsumsi tablet tambah darah satu kali setiap minggu saat tidak menstruasi?</label>
                <input type="radio" name="tdd_non_haid" value="1"> Ya
                <input type="radio" name="tdd_non_haid" value="0"> Tidak<br>

                <h2>D. MAKANAN</h2>
                <label for="makanan">Varian Menu yang Anda Makan Setiap Hari:</label>
                <select name="makanan">
                    <option value="1">Makanan pokok dan sayur</option>
                    <option value="2">Makanan pokok, sayur, dan lauk</option>
                    <option value="3">Makanan pokok, sayur, lauk, dan buah</option>
                    <option value="4">Makanan pokok, sayur, lauk, buah, dan susu</option>
                </select><br>

                <label for="konsumsi_zat_besi">Seberapa sering Anda mengkonsumsi tempe atau udang?</label>
                <select name="konsumsi_zat_besi">
                    <option value="1">Satu minggu sekali</option>
                    <option value="2">Dua minggu sekali</option>
                    <option value="3">Satu bulan sekali</option>
                    <option value="4">Tidak pernah</option>
                </select><br>

                <button type="submit">Kirim</button>
            </form>
        </div> <!-- Tutup container -->

        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <div class="popup-overlay">
                <div class="popup-content">
                    <h2>Hasil Pemeriksaan Risiko Anemia</h2>
                    <p><strong>Hasil:</strong> <?php echo $result_risiko; ?></p>
                    <p><strong>Saran:</strong><br><?php echo nl2br($saran); ?></p>
                    <a href="anemia.php"><button class="close-button">Tutup</button></a>
                </div>
            </div>
        <?php endif; ?>

    </main>
    <footer>
        <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelas 2 Kelompok 8</p>
    </footer>

</body>

</html>

<?php
// Menutup koneksi setelah penggunaan
$conn->close();
?>
