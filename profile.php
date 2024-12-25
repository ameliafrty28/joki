<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Profil</title>
    <link rel="stylesheet" href="style/profil.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

   <button class="back-button" onclick="window.history.back();">
        <i class="fas fa-arrow-left"></i> 
    </button>

    <main>
    <div class="container">
        <?php
        session_start();
        require 'koneksi.php';

        if (!isset($_SESSION['id_user'])) {
            header("Location: login.php");
            exit;
        }

        $id_user = $_SESSION['id_user'];

        // Ambil data user
        $queryUser = "SELECT * FROM tb_user WHERE id_user = ?";
        $stmt = $conn->prepare($queryUser);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $resultUser = $stmt->get_result()->fetch_assoc();

        // Ambil data hasil kesehatan
        $queryHasil = "SELECT tb_hasil.*, tb_kategorikesehatan.kategori FROM tb_hasil INNER JOIN tb_kategorikesehatan ON tb_hasil.id_kategori = tb_kategorikesehatan.id_kategori WHERE tb_hasil.id_user = ?";
        $stmt = $conn->prepare($queryHasil);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $resultHasil = $stmt->get_result();

        // Ambil data riwayat haid
        $queryHaid = "SELECT * FROM tb_riwayat_haid WHERE id_user = ?";
        $stmt = $conn->prepare($queryHaid);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $resultHaid = $stmt->get_result();

        // Ambil data riwayat anemia
        $queryAnemia = "SELECT * FROM tb_riwayat_anemia WHERE id_user = ?";
        $stmt = $conn->prepare($queryAnemia);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $resultAnemia = $stmt->get_result();

        // Ambil data riwayat IMT
        $queryIMT = "SELECT * FROM tb_riwayat_imt WHERE id_user = ?";
        $stmt = $conn->prepare($queryIMT);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $resultIMT = $stmt->get_result();
        ?>

        <h2>Profil Pengguna</h2>
        <p><strong>Nama:</strong> <?php echo htmlspecialchars($resultUser['nama']); ?></p>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($resultUser['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($resultUser['email']); ?></p>
        <p><strong>Umur:</strong> <?php echo htmlspecialchars($resultUser['umur']); ?> tahun</p>

        <h2>Riwayat Pemeriksaan</h2>
        <table>
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Skor</th>
                    <th>Hasil</th>
                    <th>Tanggal Cek</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultHasil->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['kategori']); ?></td>
                    <td><?php echo htmlspecialchars($row['skor']); ?></td>
                    <td><?php echo htmlspecialchars($row['hasil']); ?></td>
                    <td><?php echo htmlspecialchars($row['tanggal_cek']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2>Riwayat Anemia</h2>
        <table>
            <thead>
                <tr>
                    <th>Hasil Analisis</th>
                    <th>Tanggal Cek</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultAnemia->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['hasil_analisis']); ?></td>
                    <td><?php echo htmlspecialchars($row['tanggal_cek']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2>Riwayat IMT</h2>
        <table>
            <thead>
                <tr>
                    <th>Tinggi Badan (cm)</th>
                    <th>Berat Badan (kg)</th>
                    <th>IMT</th>
                    <th>Keterangan</th>
                    <th>Tanggal Cek</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultIMT->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['tinggi_badan']); ?></td>
                    <td><?php echo htmlspecialchars($row['berat_badan']); ?></td>
                    <td><?php echo htmlspecialchars($row['skor_imt']); ?></td>
                    <td><?php echo htmlspecialchars($row['hasil_keterangan']); ?></td>
                    <td><?php echo htmlspecialchars($row['tanggal_cek']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2>Riwayat Haid</h2>
        <table>
            <thead>
                <tr>
                    <th>Durasi Haid</th>
                    <th>Siklus Haid</th>
                    <th>Haid Terakhir</th>
                    <th>Hasil Analisis</th>
                    <th>Tanggal Cek</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultHaid->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['haid_durasi']); ?> hari</td>
                    <td><?php echo htmlspecialchars($row['siklus_haid']); ?> hari</td>
                    <td><?php echo htmlspecialchars($row['haid_terakhir']); ?></td>
                    <td><?php echo htmlspecialchars($row['hasil_analisis']); ?></td>
                    <td><?php echo htmlspecialchars($row['tanggal_cek']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a class="logout" href="logout.php">Logout</a>
    </div>
    </main>

    <footer>
    <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelas 2 Kelompok 8</p>
    </footer>
</body>
</html>
