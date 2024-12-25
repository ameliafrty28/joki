<?php
session_start();
header('Content-Type: application/json');

// Pastikan metode request adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dekode data JSON dari permintaan
    $data = json_decode(file_get_contents('php://input'), true);

    // Cek apakah pengguna sudah login
    if (!isset($_SESSION['id_user'])) {
        echo json_encode(['success' => false, 'message' => 'User tidak terautentikasi.']);
        exit;
    }

    // Ambil data pengguna dari session
    $id_user = $_SESSION['id_user'];
    $haid_durasi = $data['haid_durasi'] ?? null;
    $siklus_haid = $data['siklus_haid'] ?? null;
    $haid_terakhir = $data['haid_terakhir'] ?? null;
    $hasil_analisis = $data['hasil_analisis'] ?? null;
    $id_kategori = 3; // ID kategori untuk kesehatan reproduksi

    // Validasi data yang diperlukan
    if (is_null($haid_durasi) || is_null($siklus_haid) || is_null($haid_terakhir) || is_null($hasil_analisis)) {
        echo json_encode(['success' => false, 'message' => 'Data tidak lengkap.']);
        exit;
    }

    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'kesehatan');
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Koneksi database gagal: ' . $conn->connect_error]);
        exit;
    }

    // Persiapkan statement SQL
    $stmt = $conn->prepare(
        "INSERT INTO tb_riwayat (id_user, id_kategori, haid_durasi, siklus_haid, haid_terakhir, hasil_analisis, tanggal_cek) 
         VALUES (?, ?, ?, ?, ?, ?, NOW())"
    );

    // Bind parameter dan eksekusi query
    if ($stmt) {
        $stmt->bind_param(
            "iiisss", 
            $id_user, 
            $id_kategori, 
            $haid_durasi, 
            $siklus_haid, 
            $haid_terakhir, 
            $hasil_analisis
        );

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal mempersiapkan statement: ' . $conn->error]);
    }

    // Tutup koneksi database
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Metode tidak diizinkan.']);
}
?>
