<?php
include 'koneksi.php';

session_start(); // Mulai sesi PHP

// Function to calculate BMI
function calculateBMI($weight, $height) {
    $heightInMeters = $height / 100; // Convert height to meters
    return $weight / ($heightInMeters * $heightInMeters);
}

// Function to interpret BMI
function interpretBMI($bmi) {
    if ($bmi < 18.5) {
        return [
            'category' => 'Underweight',
            'advice' => 'Anda disarankan untuk meningkatkan asupan kalori harian Anda dengan makanan bergizi secara teratur, mengkonsumsi suplemen nutrisi (jika perlu), aktivitas fisik seperti berjalan kaki 30 menit atau latihan kekuatan otot dan berkonsultasi dengan ahli gizi untuk mencapai berat badan ideal.'
        ];
    } elseif ($bmi >= 18.5 && $bmi < 24.9) {
        return [
            'category' => 'Normal',
            'advice' => 'Anda berada dalam kategori berat badan ideal. Pertahankan pola makan sehat dan rutinitas olahraga Anda. Makan secara teratur, mengkonsumsi makanan seimbang, mengkonsumsi air yang cukup, menghindari makanan tinggi kalori dan lemak, aktivitas fisik seperti berjalan, yoga, pilates, dsb.'
        ];
    } elseif ($bmi >= 25 && $bmi < 29.9) {
        return [
            'category' => 'Overweight',
            'advice' => 'Anda disarankan untuk meningkatkan aktivitas fisik dan mengurangi asupan kalori berlebih. Mengatur waktu dan porsi makan yang tepat, menghindari makan sebelum tidur, menghindari makan-makanan yang tinggi kalori dan lemak, berjalan kaki secara teratur, menggunakan tangga dari pada lift atau eskalator. Konsultasikan dengan ahli gizi untuk rencana penurunan berat badan yang sehat.'
        ];
    } else {
        return [
            'category' => 'Obesitas',
            'advice' => 'Anda disarankan untuk mengatur porsi makanan yang tepat, mengatur waktu makan, menghindari makan-makanan yang tinggi kalori dan lemak, menghindari makan sebelum tidur, mengkonsumsi makanan yang kaya serat, berjalan kaki secara rutin selama 30 menit, aktivitas fisik seperti yoga, pilates, dan latihan kekuatan otot. Segera berkonsultasi dengan dokter atau ahli gizi untuk penanganan lebih lanjut guna menurunkan berat badan secara aman dan efektif. '
        ];
    }
}

// Insert result into database
function saveResult($userId, $categoryId, $bmi, $result, $weight, $height, $pdo) {
    $stmt = $pdo->prepare("INSERT INTO tb_riwayat_imt (id_user, id_kategori, tinggi_badan, berat_badan, skor_imt, hasil_keterangan, tanggal_cek) 
                           VALUES (:id_user, :id_kategori, :tinggi_badan, :berat_badan, :skor_imt, :hasil_keterangan, NOW())");
    $stmt->execute([
        'id_user' => $userId,
        'id_kategori' => $categoryId,
        'tinggi_badan' => $height,
        'berat_badan' => $weight,
        'skor_imt' => $bmi,
        'hasil_keterangan' => $result
    ]);
}


// Database connection
$dsn = 'mysql:host=localhost;dbname=kesehatan';
$username = 'root';
$password = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Check if user is logged in
if (!isset($_SESSION['id_user'])) {
    die('Anda harus login terlebih dahulu.');
}

$userId = $_SESSION['id_user']; // Ambil user_id dari sesi

// Handle user input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $weight = floatval($_POST['weight']);
    $height = floatval($_POST['height']);

    if ($weight > 0 && $height > 0) {
        $bmi = calculateBMI($weight, $height);
        $interpretation = interpretBMI($bmi);

        // Save result to database
// Save result to database
    saveResult($userId, 4, $bmi, $interpretation['category'], $weight, $height, $pdo);
    } else {
        $error = 'Masukkan berat dan tinggi badan yang valid.';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengecekan Masalah Nutrisi</title>
    <link rel="stylesheet" href="style/cek-nutrisi.css">
</head>
<body>
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

    <main>
        <h2>Cek Masalah Nutrisi Anda</h2>
        <form method="POST" action="">
            <label for="weight">Berat Badan (kg):</label>
            <input type="number" id="weight" name="weight" step="0.1" required placeholder="contoh: 70">

            <label for="height">Tinggi Badan (cm):</label>
            <input type="number" id="height" name="height" step="0.1" required placeholder="contoh: 170">

            <button type="submit">Hitung IMT</button>
        </form>

        <?php if (isset($bmi)): ?>
            <div class="result">
            <h2>Hasil</h2>
            <p>Berat Badan Anda: <?= htmlspecialchars($weight) ?> kg</p>
            <p>Tinggi Badan Anda: <?= htmlspecialchars($height) ?> cm</p>
            <p>IMT Anda: <?= number_format($bmi, 2) ?></p>
            <p>Kategori: <?= htmlspecialchars($interpretation['category']) ?></p>
            <p>Saran: <?= htmlspecialchars($interpretation['advice']) ?></p>
            </div>
        <?php elseif (isset($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelompok 8 Kelas 2.</p>
    </footer>
</body>
</html>
