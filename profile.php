<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Profil</title>
    <link rel="stylesheet" href="style/profil.css">
    <link rel="icon" href="favicon.png" type="image/png">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
<header>
        <nav>
            <img src="img/logo.png" alt="Logo" class="logo">
            <h1>KesehatanKu</h1>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul id="main-menu" class="nav-menu">
                <li><a href="index2.php">Home</a></li>
                <li><a href="about-us.php">About Us</a></li>
                <li><a href="profile.php">Akun Saya</a></li>
            </ul>

        </nav>
    </header>

    <button class="back-button" onclick="window.location.href='index2.php';">
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $umur = (int)$_POST['umur'];
        
            $checkQuery = "SELECT id_user FROM tb_user WHERE (username = ? OR email = ?) AND id_user != ?";
            $stmt = $conn->prepare($checkQuery);
            $stmt->bind_param("ssi", $username, $email, $id_user);
            $stmt->execute();
            $existingUser = $stmt->get_result()->fetch_assoc();
        
            if ($existingUser) {
                $error = "Username atau email sudah digunakan oleh pengguna lain. Silakan gunakan yang lain.";
            } else {
                $updateQuery = "UPDATE tb_user SET nama = ?, username = ?, email = ?, umur = ? WHERE id_user = ?";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bind_param("sssii", $nama, $username, $email, $umur, $id_user);
        
                if ($stmt->execute()) {
                    header("Location: profile.php");
                    exit;
                } else {
                    $error = "Gagal memperbarui data. Silakan coba lagi.";
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
                $password_error = "Semua bidang harus diisi.";
            } elseif ($new_password !== $confirm_password) {
                $password_error = "Password baru dan konfirmasi tidak cocok.";
            } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/', $new_password)) {
                $password_error = "Password baru harus minimal 8 karakter dan terdiri dari huruf besar, huruf kecil, angka, dan karakter khusus.";
            } else {
                $queryPassword = "SELECT password FROM tb_user WHERE id_user = ?";
                $stmt = $conn->prepare($queryPassword);
                $stmt->bind_param("i", $id_user);
                $stmt->execute();
                $resultPassword = $stmt->get_result()->fetch_assoc();

                if ($resultPassword && $resultPassword['password'] === $old_password) {
                    $updatePasswordQuery = "UPDATE tb_user SET password = ? WHERE id_user = ?";
                    $stmt = $conn->prepare($updatePasswordQuery);
                    $stmt->bind_param("si", $new_password, $id_user);

                    if ($stmt->execute()) {
                        $password_success = "Password berhasil diubah.";
                    } else {
                        $password_error = "Gagal mengubah password. Silakan coba lagi.";
                    }
                } else {
                    $password_error = "Password lama salah.";
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
        $queryHaid = "SELECT tb_riwayat_haid.*, tb_kategorikesehatan.kategori FROM tb_riwayat_haid INNER JOIN tb_kategorikesehatan ON tb_riwayat_haid.id_kategori = tb_kategorikesehatan.id_kategori  WHERE tb_riwayat_haid.id_user = ?";
        $stmt = $conn->prepare($queryHaid);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $resultHaid = $stmt->get_result();

        // Ambil data riwayat anemia
        $queryAnemia = " SELECT tb_riwayat_anemia.*, tb_kategorikesehatan.kategori FROM tb_riwayat_anemia INNER JOIN tb_kategorikesehatan ON tb_riwayat_anemia.id_kategori = tb_kategorikesehatan.id_kategori WHERE tb_riwayat_anemia.id_user = ?";
        $stmt = $conn->prepare($queryAnemia);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $resultAnemia = $stmt->get_result();

        // Ambil data riwayat IMT
        $queryIMT = "SELECT tb_riwayat_imt.*, tb_kategorikesehatan.kategori FROM tb_riwayat_imt INNER JOIN tb_kategorikesehatan ON tb_riwayat_imt.id_kategori = tb_kategorikesehatan.id_kategori WHERE tb_riwayat_imt.id_user = ?";
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

        <button id="edit-button">Ubah Data</button>

        <form id="edit-form" style="display: none;" method="POST" action="">
            <input type="hidden" name="update_profile" value="1">
            <?php if (!empty($error)): ?>
                <div style="color: red;"> <?php echo htmlspecialchars($error); ?> </div>
            <?php endif; ?>
            <label>Nama:</label>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($resultUser['nama']); ?>" required>

            <label>Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($resultUser['username']); ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($resultUser['email']); ?>" readonly>

            <label>Umur:</label>
            <input type="number" name="umur" value="<?php echo htmlspecialchars($resultUser['umur']); ?>" required>

            <button type="submit">Simpan Perubahan</button>
        </form>

        <form id="password-form" style="display: none;" method="POST" action="">
            <input type="hidden" name="change_password" value="1">
            <?php if (!empty($password_error)): ?>
                <div style="color: red;"> <?php echo htmlspecialchars($password_error); ?> </div>
            <?php elseif (!empty($password_success)): ?>
                <div style="color: green;"> <?php echo htmlspecialchars($password_success); ?> </div>
            <?php endif; ?>
            <label>Password Lama:</label>
            <input type="password" name="old_password" required>

            <label>Password Baru:</label>
            <input type="password" name="new_password" required>

            <label>Konfirmasi Password Baru:</label>
            <input type="password" name="confirm_password" required>

            <button type="submit">Simpan Password Baru</button>
        </form>

        <button id="toggle-password-form">Ubah Password</button>


        <h2 style="color:rgb(96, 81, 88); "><br>Hasil Pengecekan Tingkat Stres</h2>
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
                    <td><?php echo htmlspecialchars(string: $row['kategori']); ?></td>
                    <td><?php echo htmlspecialchars($row['skor']); ?></td>
                    <td><?php echo htmlspecialchars($row['hasil']); ?></td>
                    <td><?php echo htmlspecialchars($row['tanggal_cek']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
<br>
        <h2 style="color:rgb(96, 81, 88);">Hasil Pengecekan Risiko Anemia</h2>
        <table>
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Hasil Analisis</th>
                    <th>Pola Menstruasi</th>
                    <th>Lama Menstruasi</th>
                    <th>Konsumsi Zat Besi</th>
                    <th>Konsumsi TTD</th>
                    <th>Penngetahuan</th>
                    <th>Tanggal Cek</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultAnemia->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars(string: $row['kategori']); ?></td>
                    <td><?php echo htmlspecialchars($row['hasil_analisis']); ?></td>
                    <td><?php echo htmlspecialchars($row['pola_menstruasi']); ?></td>
                    <td><?php echo htmlspecialchars($row['lama_menstruasi']); ?></td>
                    <td><?php echo htmlspecialchars($row['konsumsi_makanan']); ?></td>
                    <td><?php echo htmlspecialchars($row['mengkonsumsi_ttd']); ?></td>
                    <td><?php echo htmlspecialchars($row['pengetahuan']); ?></td>
                    <td><?php echo htmlspecialchars($row['tanggal_cek']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
<br>
        <h2 style="color:rgb(96, 81, 88);">Hasil Pengecekan Indeks Massa Tubuh (IMT)</h2>
        <table>
            <thead>
                <tr>
                    <th>Kategori</th>
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
                    <td><?php echo htmlspecialchars(string: $row['kategori']); ?></td>
                    <td><?php echo htmlspecialchars($row['tinggi_badan']); ?></td>
                    <td><?php echo htmlspecialchars($row['berat_badan']); ?></td>
                    <td><?php echo htmlspecialchars($row['skor_imt']); ?></td>
                    <td><?php echo htmlspecialchars($row['hasil_keterangan']); ?></td>
                    <td><?php echo htmlspecialchars($row['tanggal_cek']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
<br>
        <h2 style="color:rgb(96, 81, 88);">Hasil Pengecekan Siklus Menstruasi</h2>
        <table>
            <thead>
                <tr>
                    <th>Kategori</th>
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
                    <td><?php echo htmlspecialchars(string: $row['kategori']); ?></td>
                    <td><?php echo htmlspecialchars($row['haid_durasi']); ?> hari</td>
                    <td><?php echo htmlspecialchars($row['siklus_haid']); ?> hari</td>
                    <td><?php echo htmlspecialchars($row['haid_terakhir']); ?></td>
                    <td><?php echo htmlspecialchars($row['hasil_analisis']); ?></td>
                    <td><?php echo htmlspecialchars($row['tanggal_cek']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a class="logout" href="index.php">Logout</a>
    </div>
    </main>
    <script src="hamburger.js" defer></script>

    <footer>
    <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelas 2 Kelompok 8</p>
    </footer>

    <script>
            const editButton = document.getElementById('edit-button');
            const editForm = document.getElementById('edit-form');
            const togglePasswordForm = document.getElementById('toggle-password-form');
            const passwordForm = document.getElementById('password-form');

            editButton.addEventListener('click', () => {
                editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
            });

            togglePasswordForm.addEventListener('click', () => {
                passwordForm.style.display = passwordForm.style.display === 'none' ? 'block' : 'none';
            });
        </script>
</body>
</html>
