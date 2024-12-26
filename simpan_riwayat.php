<?php
session_start();
include('koneksi.php'); // File koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan pengguna login
    if (!isset($_SESSION['id_user'])) {
        echo json_encode(['status' => 'error', 'message' => 'Pengguna tidak login']);
        exit;
    }

    $id_user = $_SESSION['id_user']; // Ambil id_user dari sesi
    $id_kategori = 3; // Misalnya kategori untuk menstruasi
    $haid_durasi = $_POST['haid_durasi'];
    $siklus_haid = $_POST['siklus_haid'];
    $haid_terakhir = $_POST['haid_terakhir'];
    $hasil_analisis = $_POST['hasil_analisis']; // Pastikan ini dihasilkan dari logika di JavaScript
    $tanggal_cek = date('Y-m-d H:i:s'); // Tanggal saat ini

    $query = "INSERT INTO tb_riwayat_haid (id_user, id_kategori, haid_durasi, siklus_haid, haid_terakhir, hasil_analisis, tanggal_cek) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiissss", $id_user, $id_kategori, $haid_durasi, $siklus_haid, $haid_terakhir, $hasil_analisis, $tanggal_cek);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data']);
    }
}
?>
