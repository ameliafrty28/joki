<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Profil</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
        header {
    background-color: #f071a6; /* Soft Pink Header */
    color: #fff;
    padding: 1rem 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 3px solid #ffb6c1;
    }

    header nav {
        display: flex;
        align-items: center;
    }

    header .logo {
        height: 50px;
        margin-right: 1rem;
    }

    header h1 {
        font-size: 1.8rem;
        color: #fff;
    }

    header ul {
        list-style: none;
        display: flex;
        margin-left: 750px; /* Adjusted for better spacing */
    }

    header ul li {
        margin-left: 1.5rem;
    }

    header ul li a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
    }

    header ul li a:hover {
        text-decoration: underline;
    }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffe4e6;
            color: #6d435a;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            background: #fff0f3;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ffc1cc;
        }

        h1 {
            text-align: center;
            color: #b5838d;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        h2 {
            color: #ff8fab;
            border-bottom: 2px solid #ffc1cc;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        table, th, td {
            border: 1px solid #ffc1cc;
        }

        th {
            background-color: #ffccd5;
            color: #fff;
            padding: 12px;
        }

        td {
            padding: 10px;
            text-align: left;
        }

        .logout {
            display: block;
            width: 100%;
            text-align: center;
            padding: 15px;
            background-color: #ff8fab;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1.2rem;
            font-weight: bold;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .logout:hover {
            background-color: #ff4d6d;
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }
        footer {
    text-align: center;
    padding: 1rem;
    background-color: #f8c8dc;
    color: #fff;
    margin-top: auto; /* Footer stays at the bottom */
}
    </style>
</head>
<body>
<header>
        <nav>
            <img src="img/logo.png" alt="Logo" class="logo">
            <h1>Web Kesehatan UNRIYO</h1>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about-us">About Us</a></li>
                <li><a href="profile.php">Akun Saya</a></li>
            </ul>
        </nav>
    </header>
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

        $queryUser = "SELECT * FROM tb_user WHERE id_user = ?";
        $stmt = $conn->prepare($queryUser);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $resultUser = $stmt->get_result()->fetch_assoc();

        $queryHasil = "SELECT tb_hasil.*, tb_kategorikesehatan.kategori FROM tb_hasil INNER JOIN tb_kategorikesehatan ON tb_hasil.id_kategori = tb_kategorikesehatan.id_kategori WHERE tb_hasil.id_user = ?";
        $stmt = $conn->prepare($queryHasil);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $resultHasil = $stmt->get_result();

        $queryHaid = "SELECT * FROM tb_riwayat_haid WHERE id_user = ?";
        $stmt = $conn->prepare($queryHaid);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $resultHaid = $stmt->get_result();
        ?>

        <h1>Profil Pengguna</h1>
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
                <?php 
                if ($resultHaid->num_rows > 0): 
                    while ($row = $resultHaid->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['haid_durasi']); ?> hari</td>
                    <td><?php echo htmlspecialchars($row['siklus_haid']); ?> hari</td>
                    <td><?php echo htmlspecialchars($row['haid_terakhir']); ?></td>
                    <td><?php echo htmlspecialchars($row['hasil_analisis']); ?></td>
                    <td><?php echo htmlspecialchars($row['tanggal_cek']); ?></td>
                </tr>
                <?php endwhile; 
                else: ?>
                <tr>
                    <td colspan="5">Tidak ada data riwayat haid.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a class="logout" href="logout.php">Logout</a>
    </div>
    </main>

    <footer>
        <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelompok 8 Kelas 2.</p>
    </footer>
</body>
</html>
