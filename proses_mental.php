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

        // Simpan hasil ke dalam tb_hasil, termasuk kondisi mental
        $stmt_hasil = $conn->prepare("INSERT INTO tb_hasil (id_user, id_kategori, skor, hasil, saran) VALUES (?, ?, ?, ?, ?)");
        $id_kategori = 2; // Karena kita tahu ini adalah tes kesehatan mental (id_kategori = 2)
        $stmt_hasil->bind_param("iiiss", $id_user, $id_kategori, $total_skor, $hasil, $saran);
        $stmt_hasil->execute();
        $stmt_hasil->close();

        // Tampilkan hasil tes
        echo "<html>\n<head>\n    <title>Hasil Tes Kesehatan Mental (Tingkat Stres)</title>\n    <link rel='stylesheet' href='style/hasil-tes.css'>\n</head>\n<body>\n<div class='result-container'>\n    <h1>Hasil Tes Kesehatan Mental</h1>\n    <p>Total skor Anda: <span class='score'>$total_skor</span></p>\n    <p class='result'>$hasil</p>\n    <a href='kesehatan_mental.php' class='back-button'>Kembali ke Beranda</a>\n</div>\n</body>\n</html>";
    } else {
        echo "<p>Data tidak valid. Harap isi semua pertanyaan.</p>";
    }
} else {
    echo "<p>Metode pengiriman tidak valid.</p>";
}

$conn->close();
?>
