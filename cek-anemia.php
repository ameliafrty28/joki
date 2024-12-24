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

    // Menyimpulkan hasil
    if ($skor > 0) {
        $pesan = "Anda memiliki risiko terkena anemia, disarankan untuk melakukan pengecekan ke dokter untuk kepastiannya.";
        $id_kategori = 1; // Misalkan kategori 1 adalah Anemia
    } else {
        $pesan = "Skor Anda menunjukkan tidak ada risiko anemia.";
        $id_kategori = 1; // Misalkan kategori 1 adalah Anemia
    }

    // Menyimpan hasil analisis ke tabel riwayat_anemia
    $stmt_riwayat = $conn->prepare("INSERT INTO tb_riwayat_anemia (id_user, id_kategori, hasil_analisis) VALUES (?, ?, ?)");
    $stmt_riwayat->bind_param("iis", $id_user, $id_kategori, $pesan);
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
    <script>
        // Fungsi untuk menampilkan pop-up
        function showPopup(message) {
            var popup = document.createElement("div");
            popup.style.position = "fixed";
            popup.style.left = "50%";
            popup.style.top = "50%";
            popup.style.transform = "translate(-50%, -50%)";
            popup.style.padding = "20px";
            popup.style.backgroundColor = "#fff";
            popup.style.border = "1px solid #ccc";
            popup.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.2)";
            popup.style.zIndex = "1000";
            popup.style.textAlign = "center";
            popup.innerHTML = "<h2>Hasil Pemeriksaan</h2><p>" + message + "</p><button onclick='closePopup()'>Tutup</button>";

            document.body.appendChild(popup);
        }

        // Fungsi untuk menutup pop-up dan mengarahkan kembali ke halaman utama
        function closePopup() {
            var popup = document.querySelector("div");
            popup.remove();
            window.location.href = "anemia.php"; // Arahkan ke halaman utama setelah menutup pop-up
        }
    </script>
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

    <form action="cek-anemia.php" method="POST">
        <?php if (!empty($pertanyaan)): ?>
            <?php foreach ($pertanyaan as $pertanyaan_data): ?>
                <div class="question">
                    <label for="jawaban_<?php echo $pertanyaan_data['id_pertanyaan']; ?>">
                        <?php echo $pertanyaan_data['pertanyaan']; ?>
                    </label><br>
                    <input type="radio" id="jawaban_<?php echo $pertanyaan_data['id_pertanyaan']; ?>" name="jawaban_<?php echo $pertanyaan_data['id_pertanyaan']; ?>" value="5" required> YA
                    <input type="radio" id="jawaban_<?php echo $pertanyaan_data['id_pertanyaan']; ?>" name="jawaban_<?php echo $pertanyaan_data['id_pertanyaan']; ?>" value="0"> TIDAK
                </div>
            <?php endforeach; ?>
            <button type="submit">Kirim</button>
        <?php endif; ?>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <script>
            // Menampilkan pop-up hasil setelah form disubmit
            var message = "<?php echo $pesan; ?>";
            showPopup(message);
        </script>
    <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelompok 8 Kelas 2.</p>
    </footer>

</body>
</html>

<?php
// Menutup koneksi setelah penggunaan
$conn->close();
?>
