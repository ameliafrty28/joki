<?php
include 'koneksi.php';

// Simulasikan mendapatkan id_user dari sesi atau input manual
session_start();
if (!isset($_SESSION['id_user'])) {
    die("Anda harus login untuk mengakses halaman ini.");
}
$id_user = $_SESSION['id_user']; // Ambil ID pengguna dari sesi

// Proses form jika ada data dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pertanyaan = $_POST['id_pertanyaan'];  // Array ID pertanyaan
    $jawaban = $_POST['jawaban'];  // Array jawaban

    if (!empty($id_user) && !empty($id_pertanyaan) && is_array($id_pertanyaan) && !empty($jawaban) && is_array($jawaban)) {
        $total_skor = 0;

        // Siapkan query untuk menyimpan jawaban
        $stmt = $conn->prepare("INSERT INTO tb_jawaban (id_user, id_pertanyaan, jawaban) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $id_user, $id_pertanyaan_single, $jawaban_single);

        foreach ($id_pertanyaan as $id_pertanyaan_single) {
            if (isset($jawaban[$id_pertanyaan_single])) {
                $jawaban_single = $jawaban[$id_pertanyaan_single];
                $total_skor += (int)$jawaban_single;
                $stmt->execute();
            }
        }
        $stmt->close();

        // Tentukan hasil
        if ($total_skor <= 13) {
            $hasil = 'Stres Ringan';
            $saran = 'Untuk mengurangi stres, coba lakukan meditasi, olahraga, atau latihan pernapasan, ubah pola pikir menjadi lebih positif, dan jalani gaya hidup sehat dengan makan bergizi, cukup tidur, serta luangkan waktu untuk hobi dan kegiatan menyenangkan.';
        } elseif ($total_skor >= 14 && $total_skor <= 26) {
            $hasil = 'Stres Sedang';
            $saran = 'Untuk mengurangi stres, coba lakukan hal-hal sederhana seperti meditasi, olahraga, atau latihan pernapasan. Cobalah juga untuk berpikir lebih positif, makan makanan sehat, tidur cukup, dan luangkan waktu untuk hobi atau hal-hal yang kamu suka. Jangan ragu berbagi cerita dengan teman, keluarga, atau orang yang kamu percaya. Selain itu, atur waktu dengan baik, fokus pada hal yang penting, dan hindari terlalu banyak tugas. Jika stres terasa sulit diatasi atau tidak kunjung hilang, mungkin ini saatnya untuk berbicara dengan seorang profesional yang bisa membantu.';
        } else {
            $hasil = 'Stres Berat';
            $saran = 'Jika stres yang Anda rasakan mulai mengganggu aktivitas sehari-hari atau sulit diatasi meskipun sudah mencoba berbagai cara, penting untuk mempertimbangkan mendapatkan bantuan dari seorang profesional seperti psikolog atau konselor. Mereka dapat membantu Anda memahami dan mengelola apa yang Anda alami dengan lebih baik.';
        }

        // Simpan hasil ke database
        $stmt_hasil = $conn->prepare("INSERT INTO tb_hasil (id_user, id_kategori, skor, hasil, saran) VALUES (?, ?, ?, ?, ?)");
        $id_kategori = 2;
        $stmt_hasil->bind_param("iiiss", $id_user, $id_kategori, $total_skor, $hasil, $saran);
        $stmt_hasil->execute();
        $stmt_hasil->close();

        // Kirimkan hasil untuk ditampilkan sebagai popup
        echo "<div class='popup-overlay'>
                <div class='popup-content'>
                    <h2>Hasil Tes Kesehatan Mental</h2>
                    <p><strong>Total Skor:</strong> $total_skor</p>
                    <p><strong>Hasil:</strong> $hasil</p>
                    <p><strong>Saran:</strong><br>$saran</p>
                    <a href='kesehatan_mental.php'><button class='close-button'>Tutup</button></a>
                </div>
            </div>";
    } else {
        echo "<script>alert('Data tidak valid. Harap isi semua pertanyaan.');</script>";
    }
}

// Ambil pertanyaan untuk ditampilkan
$sql = "SELECT id_pertanyaan, pertanyaan FROM tb_pertanyaan_kesehatan WHERE id_kategori = 2";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Kesehatan Mental</title>
    <link rel="stylesheet" href="style/cek-mental.css">
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
                <li><a href="index2.php">Home</a></li>
                <li><a href="about-us.php">About Us</a></li>
                <li><a href="profile.php">Akun Saya</a></li>
            </ul>

        </nav>
    </header>
<main>
    <h1>Tes Tingkat Stres</h1>
    <form method="POST">
        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
        <ol>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <li>
                    <p><?php echo $row['pertanyaan']; ?></p>
                    <input type="hidden" name="id_pertanyaan[]" value="<?php echo $row['id_pertanyaan']; ?>">
                    <label>
                        <input type="radio" name="jawaban[<?php echo $row['id_pertanyaan']; ?>]" value="0" required> Tidak Pernah (0)
                    </label>
                    <label>
                        <input type="radio" name="jawaban[<?php echo $row['id_pertanyaan']; ?>]" value="1"> Hampir Tidak Pernah (1)
                    </label>
                    <label>
                        <input type="radio" name="jawaban[<?php echo $row['id_pertanyaan']; ?>]" value="2"> Kadang-kadang (2)
                    </label>
                    <label>
                        <input type="radio" name="jawaban[<?php echo $row['id_pertanyaan']; ?>]" value="3"> Cukup Sering (3)
                    </label>
                    <label>
                        <input type="radio" name="jawaban[<?php echo $row['id_pertanyaan']; ?>]" value="4"> Sangat Sering (4)
                    </label>
                </li>
            <?php } ?>
        </ol>
        <button type="submit">Submit</button>
    </form>
</main>
<script src="hamburger.js" defer></script>
<footer>
    <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelas 2 Kelompok 8</p>
</footer>
</body>
</html>
<?php
} else {
    echo "<p>Tidak ada pertanyaan untuk kategori ini.</p>";
}
$conn->close();
?>
