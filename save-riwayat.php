<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Ambil id_user dari sesi
    if (!isset($_SESSION['id_user'])) {
        echo json_encode(['success' => false, 'message' => 'User tidak terautentikasi.']);
        exit;
    }

    $id_user = $_SESSION['id_user'];
    $haid_durasi = $data['haid_durasi'];
    $siklus_haid = $data['siklus_haid'];
    $haid_terakhir = $data['haid_terakhir'];
    $hasil_analisis = $data['hasil_analisis'];
    $id_kategori = 3; // Kategori kesehatan reproduksi

    $conn = new mysqli('localhost', 'root', '', 'kesehatan'); // Sesuaikan koneksi database.

    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Koneksi database gagal.']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO tb_riwayat_haid (id_user, id_kategori, haid_durasi, siklus_haid, haid_terakhir, hasil_analisis, tanggal_cek) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param('iiisss', $id_user, $id_kategori, $haid_durasi, $siklus_haid, $haid_terakhir, $hasil_analisis);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Metode tidak diizinkan.']);
}
?>
