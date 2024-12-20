<?php
header('Content-Type: application/json');

include 'koneksi.php';

if (!isset($conn)) {
    echo json_encode(['success' => false, 'message' => 'Koneksi database gagal.']);
    exit;
}

// Ambil data JSON dari request
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id_user'], $data['id_kategori'], $data['haid_durasi'], $data['siklus_haid'], $data['haid_terakhir'], $data['hasil_analisis'])) {
    echo json_encode(['success' => false, 'message' => 'Data tidak lengkap.']);
    exit;
}

$id_user = $data['id_user'];
$id_kategori = $data['id_kategori'];
$haid_durasi = $data['haid_durasi'];
$siklus_haid = $data['siklus_haid'];
$haid_terakhir = $data['haid_terakhir'];
$hasil_analisis = $data['hasil_analisis'];

// Simpan ke database
$stmt = $conn->prepare("INSERT INTO tb_riwayat_haid (id_user, id_kategori, haid_durasi, siklus_haid, haid_terakhir, hasil_analisis) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param('iiisss', $id_user, $id_kategori, $haid_durasi, $siklus_haid, $haid_terakhir, $hasil_analisis);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data: ' . $conn->error]);
}

$stmt->close();
$conn->close();
?>
