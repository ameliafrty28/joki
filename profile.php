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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = htmlspecialchars($_POST['nama']);
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $umur = (int)$_POST['umur'];
        
            // Cek apakah username atau email sudah ada di database
            $checkQuery = "SELECT id_user FROM tb_user WHERE (username = ? OR email = ?) AND id_user != ?";
            $stmt = $conn->prepare($checkQuery);
            $stmt->bind_param("ssi", $username, $email, $id_user);
            $stmt->execute();
            $existingUser = $stmt->get_result()->fetch_assoc();
        
            if ($existingUser) {
                // Jika username atau email sudah ada, tampilkan peringatan
                $error = "Username atau email sudah digunakan oleh pengguna lain. Silakan gunakan yang lain.";
            } else {
                // Update data user jika username dan email unik
                $updateQuery = "UPDATE tb_user SET nama = ?, username = ?, email = ?, umur = ? WHERE id_user = ?";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bind_param("sssii", $nama, $username, $email, $umur, $id_user);
        
                if ($stmt->execute()) {
                    // Redirect kembali ke halaman profil setelah berhasil mengupdate data
                    header("Location: profile.php");
                    exit;
                } else {
                    $error = "Gagal memperbarui data. Silakan coba lagi.";
                }
            }
        }
        
        
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
            <p><strong>Nama:</strong> <span id="nama"><?php echo htmlspecialchars($resultUser['nama']); ?></span></p>
            <p><strong>Username:</strong> <span id="username"><?php echo htmlspecialchars($resultUser['username']); ?></span></p>
            <p><strong>Email:</strong> <span id="email"><?php echo htmlspecialchars($resultUser['email']); ?></span></p>
            <p><strong>Umur:</strong> <span id="umur"><?php echo htmlspecialchars($resultUser['umur']); ?></span> tahun</p>

            <button id="edit-button">Ubah Data</button>

            <form id="edit-form" style="display: none;" method="POST" action="">
            <?php if (!empty($error)): ?>
                <div class="error-message" style="color: red; margin-bottom: 20px;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <label for="edit-nama">Nama:</label>
            <input type="text" id="edit-nama" name="nama" value="<?php echo htmlspecialchars($resultUser['nama']); ?>" required>

            <label for="edit-username">Username:</label>
            <input type="text" id="edit-username" name="username" value="<?php echo htmlspecialchars($resultUser['username']); ?>" required>

            <label for="edit-email">Email:</label>
            <input type="email" id="edit-email" name="email" value="<?php echo htmlspecialchars($resultUser['email']); ?>" readonly>

            <label for="edit-umur">Umur:</label>
            <input type="number" id="edit-umur" name="umur" value="<?php echo htmlspecialchars($resultUser['umur']); ?>" required>

            <button type="submit">Simpan Perubahan</button>
        </form>



        <h2>Hasil Pemeriksaan Kesehatan Mental</h2>
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

        <h2>Hasil Pemeriksan Anemia</h2>
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

        <h2>Hasil Pemeriksaa Indeks Massa Tubuh (IMT)</h2>
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

        <h2>Hasil Pemeriksa Menstruasi</h2>
        <table>
            <thead>
                <tr>
                    <th>Durasi Menstruasi</th>
                    <th>Siklus Menstruasi</th>
                    <th>Menstruasi Terakhir</th>
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

        <a class="logout" href="tampilanawal.php">Logout</a>
    </div>
    </main>

    <footer>
    <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelas 2 Kelompok 8</p>
    </footer>

    <script>
        const editButton = document.getElementById('edit-button');
        const editForm = document.getElementById('edit-form');

        editButton.addEventListener('click', () => {
            editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
        });
    </script>
</body>
</html>
