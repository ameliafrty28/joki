
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Menstruasi</title>
    <link rel="stylesheet" href="style/kalender.css">

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
    <main>
        <div class="container">
            <h1>Kalender Menstruasi</h1>
            <p class="subtitle">
                Alat bantu untuk mencatat siklus menstruasi Anda dengan mudah dan akurat.
            </p>
            <label for="durasiHaid">Durasi Haid (hari):</label>
            <input type="number" id="durasiHaid" placeholder="Masukkan durasi haid">

            <label for="siklusHaid">Siklus Haid (hari):</label>
            <input type="number" id="siklusHaid" placeholder="Masukkan siklus haid">

            <label for="tanggalHaid">Tanggal Hari Pertama Haid:</label>
            <input type="date" id="tanggalHaid">

            <button onclick="hitungMenstruasi()">Hitung</button>

            <div class="output" id="hasil"></div>

            <div id="calendar-container" style="display: none;">
                <div id="calendar-navigation">
                    <button class="nav-btn small-btn" onclick="changeMonth(-1)">&lt; Sebelumnya</button>
                    <span id="calendar-title"></span>
                    <button class="nav-btn small-btn" onclick="changeMonth(1)">Berikutnya &gt;</button>
                </div>

                <div class="calendar" id="calendar"></div>
            </div>

            <div class="popup" id="popup">
                <div id="popupMessage"></div>
                <button onclick="closePopup()">Tutup</button>
            </div>

            <div class="mental-health-button">
            <a href="kesehatan_reproduksi.php" class="btn">Kunjungi Halaman Kesehatan Reproduksi</a>
        </div>
        </main>
    <script>
    let currentYear;
    let currentMonth;

    function hitungMenstruasi() {
        const durasiHaid = parseInt(document.getElementById('durasiHaid').value);
        const siklusHaid = parseInt(document.getElementById('siklusHaid').value);
        const tanggalHaid = document.getElementById('tanggalHaid').value;

        if (!durasiHaid || !siklusHaid || !tanggalHaid) {
            document.getElementById('hasil').innerText = 'Harap isi semua data dengan benar.';
            return;
        }

        const tanggalPertama = new Date(tanggalHaid);
        const hariBerikutnya = new Date(tanggalPertama);
        hariBerikutnya.setDate(tanggalPertama.getDate() + siklusHaid +1);

        const tanggalBerikutnya = hariBerikutnya.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });

        let hasilAnalisis = '';
        if (siklusHaid >= 21 && siklusHaid <= 35 && durasiHaid >= 2 && durasiHaid <= 7) {
            hasilAnalisis = `Siklus menstruasi Anda masih dalam batas normal.Normalnya, siklus menstruasi berlangsung selama 21-35 hari, dan durasi haid 2-7 hari.`;
        } else {
            hasilAnalisis = `Siklus menstruasi Anda tidak normal.<br>
                    Normalnya, siklus menstruasi berlangsung selama 21-35 hari, dan durasi haid 2-7 hari.<br>
                    Jika siklus Anda lebih singkat atau lebih lama dari batas ini, Anda mungkin mengalami gangguan siklus menstruasi.<br>
                    Silakan berkonsultasi dengan dokter untuk mengetahui penyebab masalah siklus menstruasi Anda.`;
        }

        showPopup(hasilAnalisis);

        fetch('simpan_riwayat.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                haid_durasi: durasiHaid,
                siklus_haid: siklusHaid,
                haid_terakhir: tanggalHaid,
                hasil_analisis: hasilAnalisis
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Data berhasil disimpan');
                } else {
                    alert('Gagal menyimpan data: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));

        document.getElementById('hasil').innerHTML = `
            <strong>Perkiraan Haid Berikutnya:</strong><br>
            ${tanggalBerikutnya}<br>
        `;

        // Set kalender ke bulan haid berikutnya
        currentYear = hariBerikutnya.getFullYear();
        currentMonth = hariBerikutnya.getMonth();

        window.calendarData = { tanggalPertama, durasiHaid, siklusHaid };
    }

    function renderCalendar(startDate, duration, cycle) {
        const calendar = document.getElementById('calendar');
        calendar.innerHTML = '';

        const firstDayOfMonth = new Date(currentYear, currentMonth, -1);
        const lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);

        const calendarTitle = document.getElementById('calendar-title');
        calendarTitle.textContent = new Date(currentYear, currentMonth).toLocaleString('id-ID', {
            month: 'long', year: 'numeric'
        });

        for (let i = 0; i <= lastDayOfMonth.getDate() - 1; i++) {
            const currentDate = new Date(currentYear, currentMonth, i + 1);

            const dayDiv = document.createElement('div');
            dayDiv.textContent = currentDate.getDate();

            const diff = Math.floor((currentDate - startDate) / (1000 * 60 * 60 * 24)) % cycle;
            if (diff >= 0 && diff < duration) {
                dayDiv.classList.add('highlight');
            }

            calendar.appendChild(dayDiv);
        }
    }

    function showPopup(message) {
        const popup = document.getElementById('popup');
        document.getElementById('popupMessage').innerHTML = message;
        popup.classList.add('active');
    }

    function closePopup() {
        const popup = document.getElementById('popup');
        popup.classList.remove('active');

        const { tanggalPertama, durasiHaid, siklusHaid } = window.calendarData;
        renderCalendar(tanggalPertama, durasiHaid, siklusHaid);
        document.getElementById('calendar-container').style.display = 'block';
    }

    function changeMonth(direction) {
        currentMonth += direction;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        } else if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }

        const { tanggalPertama, durasiHaid, siklusHaid } = window.calendarData;
        renderCalendar(tanggalPertama, durasiHaid, siklusHaid);
    }
</script>

<footer>
        <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelas 2 Kelompok 8</p>
    </footer>
</body>
</html>
