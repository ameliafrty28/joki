<?php
include 'koneksi.php';

// Simulasikan mendapatkan id_user dari sesi atau input manual
// Sesuaikan implementasi berikut dengan sistem login Anda
session_start();
if (!isset($_SESSION['id_user'])) {
    die("Anda harus login untuk mengakses halaman ini.");
}
$id_user = $_SESSION['id_user']; // Ambil ID pengguna dari sesi

// Ambil pertanyaan dari kategori kesehatan mental (id_kategori = 2)
$sql = "SELECT id_pertanyaan, pertanyaan FROM tb_pertanyaan_kesehatan WHERE id_kategori = 2";
$result = $conn->query($sql);

// Periksa apakah ada pertanyaan
if ($result->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Kesehatan Mental</title>
    <link rel="stylesheet" href="style/mental.css">
</head>
<body>
    <header>
        <nav>
            <img src="img/logo.png" alt="Logo" class="logo">
            <h1>Web Kesehatan UNRIYO</h1>
            <ul>
                <li><a href="index.php#home">Home</a></li>
                <li><a href="index.php#about">About Us</a></li>
                <li><a href="profile.php">Akun Saya</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Tes Kesehatan Mental</h1>
        <form action="proses_mental.php" method="POST">
            <!-- Kirimkan id_user sebagai field hidden -->
            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
            <ol>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <li>
                        <p><?php echo $row['pertanyaan']; ?></p>
                        <input type="hidden" name="id_pertanyaan[]" value="<?php echo $row['id_pertanyaan']; ?>">
                        <label>
                            <input type="radio" name="jawaban[<?php echo $row['id_pertanyaan']; ?>]" value="0" required> Tidak Pernah (0)
                        </label>
                        <label>
                            <input type="radio" name="jawaban[<?php echo $row['id_pertanyaan']; ?>]" value="1"> Hampir Tidak Pernah (1)
                        </label>
                        <label>
                            <input type="radio" name="jawaban[<?php echo $row['id_pertanyaan']; ?>]" value="2"> Kadang-kadang (2)
                        </label>
                        <label>
                            <input type="radio" name="jawaban[<?php echo $row['id_pertanyaan']; ?>]" value="3"> Cukup Sering (3)
                        </label>
                        <label>
                            <input type="radio" name="jawaban[<?php echo $row['id_pertanyaan']; ?>]" value="4"> Sangat Sering (4)
                        </label>
                    </li>
                <?php } ?>
            </ol>
            <button type="submit">Submit</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelompok 8 Kelas 2.</p>
    </footer>
</body>
</html>

<?php
} else {
    echo "Tidak ada pertanyaan untuk kategori ini.";
}
$conn->close();
?>
