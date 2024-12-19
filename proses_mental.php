<?php
include 'koneksi.php';

// Ambil data yang dikirimkan melalui form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];  // Ambil id_user dari form
    $id_pertanyaan = $_POST['id_pertanyaan'];  // Array ID pertanyaan
    $jawaban = $_POST['jawaban'];  // Array jawaban

    // Validasi data
    if (!empty($id_user) && !empty($id_pertanyaan) && is_array($id_pertanyaan) && !empty($jawaban) && is_array($jawaban)) {
        $total_skor = 0;
        
        // Siapkan query untuk menyimpan jawaban
        $stmt = $conn->prepare("INSERT INTO tb_jawaban (id_user, id_pertanyaan, jawaban) VALUES (?, ?, ?)");

        // Bind parameter untuk query
        $stmt->bind_param("iis", $id_user, $id_pertanyaan_single, $jawaban_single);

        // Loop untuk setiap pertanyaan dan jawaban
        foreach ($id_pertanyaan as $id_pertanyaan_single) {
            if (isset($jawaban[$id_pertanyaan_single])) {
                $jawaban_single = $jawaban[$id_pertanyaan_single];
                $total_skor += (int)$jawaban_single;

                // Eksekusi query untuk menyimpan jawaban
                $stmt->execute();
            }
        }

        $stmt->close();

        // Tentukan kriteria kondisi mental berdasarkan total skor
        if ($total_skor <= 10) {
            $hasil = "Kondisi mental Anda baik.";
        } elseif ($total_skor <= 20) {
            $hasil = "Kondisi mental Anda perlu perhatian.";
        } else {
            $hasil = "Kondisi mental Anda memerlukan bantuan profesional.";
        }

        // Simpan hasil ke dalam tb_hasil, termasuk kondisi mental
        $stmt_hasil = $conn->prepare("INSERT INTO tb_hasil (id_user, id_kategori, skor, hasil) VALUES (?, ?, ?, ?)");
        $id_kategori = 2; // Karena kita tahu ini adalah tes kesehatan mental (id_kategori = 2)
        $stmt_hasil->bind_param("iiis", $id_user, $id_kategori, $total_skor, $hasil);
        $stmt_hasil->execute();
        $stmt_hasil->close();

        // Tampilkan hasil tes
        echo "<h1>Hasil Tes Kesehatan Mental</h1>";
        echo "<p>Total skor Anda: $total_skor</p>";
        echo "<p>$hasil</p>";
    } else {
        echo "<p>Data tidak valid. Harap isi semua pertanyaan.</p>";
    }
} else {
    echo "<p>Metode pengiriman tidak valid.</p>";
}

$conn->close();
?>
