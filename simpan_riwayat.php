<?php
include 'koneksi.php';

session_start(); // Memulai sesi untuk mengakses data login

// Pastikan pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    die("Anda harus login untuk mengakses fitur ini.");
}


// Ambil data dari form
$id_user = $_SESSION['id_user'];
$id_kategori = 3; // Misalnya kategori untuk "Kesehatan Reproduksi"
$haid_durasi = isset($_POST['haid_durasi']) ? intval($_POST['haid_durasi']) : null;
$siklus_haid = isset($_POST['siklus_haid']) ? intval($_POST['siklus_haid']) : null;
$haid_terakhir = isset($_POST['haid_terakhir']) ? $_POST['haid_terakhir'] : null;

// Validasi input
if (!$haid_durasi || !$siklus_haid || !$haid_terakhir) {
    die("Semua data harus diisi.");
}

// Analisis hasil
$hasil_analisis = ($siklus_haid >= 21 && $siklus_haid <= 35 && $haid_durasi >= 2 && $haid_durasi <= 7)
    ? "Siklus menstruasi Anda normal."
    : "Siklus menstruasi Anda tidak normal. Konsultasikan dengan dokter.";


    $sql = "INSERT INTO tb_riwayat_haid (id_user, id_kategori, haid_durasi, siklus_haid, haid_terakhir, hasil_analisis, tanggal_cek)
    VALUES (?, ?, ?, ?, ?, ?, NOW())";  // Gunakan NOW() untuk tanggal dan waktu saat ini
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiisss", $id_user, $id_kategori, $haid_durasi, $siklus_haid, $haid_terakhir, $hasil_analisis);

// Eksekusi perintah
if ($stmt->execute()) {
echo "Data berhasil disimpan.";
} else {
echo "Gagal menyimpan data: " . $conn->error;
}


// Tutup koneksi
$stmt->close();
$conn->close();
?>
