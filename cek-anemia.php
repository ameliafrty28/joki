<?php
// Mulai sesi PHP
session_start();

// Sertakan file koneksi ke database
include 'koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    die("Anda harus login untuk mengakses halaman ini.");
}

// Cek apakah form dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $usia = isset($_POST['usia']) ? intval($_POST['usia']) : 0;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $hb = isset($_POST['hb']) ? floatval($_POST['hb']) : 0.0;

    // Validasi data input
    if (empty($nama) || $usia <= 0 || empty($gender) || $hb <= 0) {
        echo "Semua data harus diisi dengan benar.";
        exit;
    }

    // Logika cek anemia
    $kategori = '';
    if ($gender === 'L') { // Laki-laki
        if ($hb < 13) {
            $kategori = 'Anemia';
        } else {
            $kategori = 'Normal';
        }
    } elseif ($gender === 'P') { // Perempuan
        if ($hb < 12) {
            $kategori = 'Anemia';
        } else {
            $kategori = 'Normal';
        }
    }

    // Simpan hasil ke database
    $stmt = $conn->prepare("INSERT INTO hasil_cek_anemia (nama, usia, gender, hb, kategori) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $nama, $usia, $gender, $hb, $kategori);

    if ($stmt->execute()) {
        echo "Hasil cek anemia berhasil disimpan.";
    } else {
        echo "Gagal menyimpan hasil cek: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Anemia</title>
</head>
<body>
    <h1>Form Cek Anemia</h1>
    <form action="cek-anemia.php" method="POST">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="usia">Usia:</label><br>
        <input type="number" id="usia" name="usia" required><br><br>

        <label for="gender">Jenis Kelamin:</label><br>
        <select id="gender" name="gender" required>
            <option value="">--Pilih--</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select><br><br>

        <label for="hb">Kadar Hb (g/dL):</label><br>
        <input type="number" id="hb" name="hb" step="0.1" required><br><br>

        <button type="submit">Cek</button>
    </form>
</body>
</html>
