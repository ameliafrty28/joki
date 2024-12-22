<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Menstruasi</title>
    <link rel="stylesheet" href="style/kalender2.css">
    
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
        <section class="hero-section">
            <h1>Kalender Menstruasi</h1>
            <p class="subtitle">
                Alat bantu untuk mencatat siklus menstruasi Anda dengan mudah dan akurat.
            </p>
        </section>

        <form id="input-form" class="form-container">
            <label for="haid-durasi">Durasi Haid (hari):</label>
            <input type="number" id="haid-durasi" name="haid_durasi" required>

            <label for="siklus-haid">Siklus Haid (hari):</label>
            <input type="number" id="siklus-haid" name="siklus_haid" required>

            <label for="haid-terakhir">Tanggal Hari Pertama Haid Terakhir:</label>
            <input type="date" id="haid-terakhir" name="haid_terakhir" required>

            <button type="submit" class="submit-btn">Hitung</button>
        </form>

        <div id="result"></div>
    </main>

    <div id="info-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modal-message"></p>
        </div>
    </div>

    <script>
        document.getElementById('input-form').addEventListener('submit', async function(event) {
            event.preventDefault();

            const haidDurasi = parseInt(document.getElementById('haid-durasi').value);
            const siklusHaid = parseInt(document.getElementById('siklus-haid').value);
            const haidTerakhir = new Date(document.getElementById('haid-terakhir').value);

            // Tampilkan keterangan siklus sebagai pop-up
            displayCycleInfo(haidDurasi, siklusHaid);

            document.getElementById('result').innerHTML = `
                <h2>Hasil Perhitungan</h2>
                <h3>Kalender</h3>
                <div id="calendar-container"></div>
            `;

            renderCalendar(haidTerakhir, haidDurasi, siklusHaid);

            const saveResult = await saveToDatabase(haidDurasi, siklusHaid, haidTerakhir);
            if (saveResult.success) {
                alert('Data berhasil disimpan ke database!');
            } else {
                alert(`Gagal menyimpan data: ${saveResult.message}`);
            }
        });

        function displayCycleInfo(haidDurasi, siklusHaid) {
            const modal = document.getElementById('info-modal');
            const modalMessage = document.getElementById('modal-message');
            const closeModal = document.querySelector('.close');

            let message = '';
            if (siklusHaid >= 21 && siklusHaid <= 35 && haidDurasi >= 2 && haidDurasi <= 7) {
                message = 
                    `Siklus menstruasi Anda masih dalam batas normal.<br>
                    Normalnya, siklus menstruasi berlangsung selama 21-35 hari, dan durasi haid 2-7 hari.`
                ;
            } else {
                message = 
                    `Siklus menstruasi Anda tidak normal.<br>
                    Normalnya, siklus menstruasi berlangsung selama 21-35 hari, dan durasi haid 2-7 hari.<br>
                    Jika siklus Anda lebih singkat atau lebih lama dari batas ini, Anda mungkin mengalami gangguan siklus menstruasi.<br>
                    Silakan berkonsultasi dengan dokter untuk mengetahui penyebab masalah siklus menstruasi Anda.`
                ;
            }
            modalMessage.innerHTML = message;
            modal.style.display = 'flex';

            closeModal.onclick = () => {
                modal.style.display = 'none';
            };

            window.onclick = (event) => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            };
        }

        async function saveToDatabase(haidDurasi, siklusHaid, haidTerakhir) {
            try {
                const response = await fetch('save-riwayat.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        id_user: 1,
                        id_kategori: 3,
                        haid_durasi: haidDurasi,
                        siklus_haid: siklusHaid,
                        haid_terakhir: haidTerakhir.toISOString().split('T')[0],
                        hasil_analisis: siklusHaid >= 21 && siklusHaid <= 35 && haidDurasi >= 2 && haidDurasi <= 7 ? 'Normal' : 'Tidak Normal',
                    }),
                });

                return await response.json();
            } catch (error) {
                console.error('Error saving to database:', error);
                return { success: false, message: 'Terjadi kesalahan saat menghubungi server.' };
            }
        }

        function renderCalendar(haidTerakhir, haidDurasi, siklusHaid, year = haidTerakhir.getFullYear(), month = haidTerakhir.getMonth()) {
            const calendarContainer = document.getElementById('calendar-container');
            calendarContainer.innerHTML = '';

            const firstDayOfMonth = new Date(year, month, 1);
            const lastDayOfMonth = new Date(year, month + 1, 0);

            const monthNames = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            const daysOfWeek = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

            let calendarHTML = `<h3>${monthNames[month]} ${year}</h3>`;
            calendarHTML += '<table><tr>';
            daysOfWeek.forEach(day => {
                calendarHTML += `<th>${day}</th>`;
            });
            calendarHTML += '</tr><tr>';

            for (let i = 0; i < firstDayOfMonth.getDay(); i++) {
                calendarHTML += '<td></td>';
            }

            for (let day = 1; day <= lastDayOfMonth.getDate(); day++) {
                const currentDate = new Date(year, month, day);

                const predictedHaidStart = new Date(haidTerakhir);
                let isHighlighted = false;
                while (predictedHaidStart <= lastDayOfMonth) {
                    if (currentDate >= predictedHaidStart && currentDate < new Date(predictedHaidStart.getTime() + haidDurasi * 24 * 60 * 60 * 1000)) {
                        calendarHTML += `<td class="highlight">${day}</td>`;
                        isHighlighted = true;
                        break;
                    }
                    predictedHaidStart.setDate(predictedHaidStart.getDate() + siklusHaid);
                }

                if (!isHighlighted) {
                    calendarHTML += `<td>${day}</td>`;
                }

                if (currentDate.getDay() === 6 && day !== lastDayOfMonth.getDate()) {
                    calendarHTML += '</tr><tr>';
                }
            }

            const remainingCells = 7 - (calendarHTML.match(/<tr>.*?<\/td>/g)?.length % 7 || 7);
            for (let i = 0; i < remainingCells; i++) {
                calendarHTML += '<td></td>';
            }

            calendarHTML += '</tr></table>';
            calendarContainer.innerHTML = `
                <button onclick="changeMonth(${year}, ${month - 1})">&lt; Sebelumnya</button>
                <button onclick="changeMonth(${year}, ${month + 1})">Berikutnya &gt;</button>
                ${calendarHTML}
            `;
        }

        function changeMonth(year, month) {
            if (month < 0) {
                month = 11;
                year -= 1;
            } else if (month > 11) {
                month = 0;
                year += 1;
            }

            const haidDurasi = parseInt(document.getElementById('haid-durasi').value);
            const siklusHaid = parseInt(document.getElementById('siklus-haid').value);
            const haidTerakhir = new Date(document.getElementById('haid-terakhir').value);

            renderCalendar(haidTerakhir, haidDurasi, siklusHaid, year, month);
        }
    </script>

    <footer>
        <p>&copy; 2024 INOVASI TEKNOLOGI KESEHATAN. Kelompok 8 Kelas 2.</p>
    </footer>
</body>
</html>
