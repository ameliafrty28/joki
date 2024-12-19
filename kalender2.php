<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Menstruasi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 10px;
        }
        .highlight {
            background-color: #ffcccc;
        }
    </style>
</head>
<body>
    <h1>Kalender Menstruasi</h1>
    <form method="POST" id="input-form">
        <label for="haid-durasi">Durasi Haid (hari):</label>
        <input type="number" id="haid-durasi" name="haid_durasi" required><br><br>

        <label for="siklus-haid">Siklus Haid (hari):</label>
        <input type="number" id="siklus-haid" name="siklus_haid" required><br><br>

        <label for="haid-terakhir">Tanggal Hari Pertama Haid Terakhir:</label>
        <input type="date" id="haid-terakhir" name="haid_terakhir" required><br><br>

        <button type="submit">Hitung</button>
    </form>

    <div id="result"></div>

    <script>
        document.getElementById('input-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const haidDurasi = parseInt(document.getElementById('haid-durasi').value);
            const siklusHaid = parseInt(document.getElementById('siklus-haid').value);
            const haidTerakhir = new Date(document.getElementById('haid-terakhir').value);

            const haidBerikutnyaDate = new Date(haidTerakhir);
            haidBerikutnyaDate.setDate(haidBerikutnyaDate.getDate() + siklusHaid);

            const haidBerakhirDate = new Date(haidBerikutnyaDate);
            haidBerakhirDate.setDate(haidBerakhirDate.getDate() + haidDurasi);

            const hariMenujuHaid = Math.max(0, Math.ceil((haidBerikutnyaDate - new Date()) / (1000 * 60 * 60 * 24)));

            document.getElementById('result').innerHTML = `
                <h2>Hasil Perhitungan</h2>
                <p>Haid berikutnya dalam <strong>${hariMenujuHaid} hari</strong>, yaitu pada tanggal <strong>${haidBerikutnyaDate.toISOString().split('T')[0]}</strong>.</p>
                <h3>Kalender</h3>
                <div id="calendar-container"></div>
            `;

            renderCalendar(haidBerikutnyaDate, haidBerakhirDate);
        });

        function renderCalendar(haidStartDate, haidEndDate, year = haidStartDate.getFullYear(), month = haidStartDate.getMonth()) {
            const calendarContainer = document.getElementById('calendar-container');
            calendarContainer.innerHTML = '';

            const firstDayOfMonth = new Date(year, month, 1);
            const lastDayOfMonth = new Date(year, month + 1, 0);

            const daysOfWeek = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

            let calendarHTML = '<table><tr>';
            daysOfWeek.forEach(day => {
                calendarHTML += `<th>${day}</th>`;
            });
            calendarHTML += '</tr><tr>';

            for (let i = 0; i < firstDayOfMonth.getDay(); i++) {
                calendarHTML += '<td></td>';
            }

            for (let day = 1; day <= lastDayOfMonth.getDate(); day++) {
                const currentDate = new Date(year, month, day);
                const isHaidDay = currentDate >= haidStartDate && currentDate < haidEndDate;
                calendarHTML += `<td class="${isHaidDay ? 'highlight' : ''}">${day}</td>`;

                if (currentDate.getDay() === 6) {
                    calendarHTML += '</tr><tr>';
                }
            }

            calendarHTML += '</tr></table>';
            calendarContainer.innerHTML = `
                <button onclick="changeMonth(${year}, ${month - 1})">&lt; Sebelumnya</button>
                <button onclick="changeMonth(${year}, ${month + 1})">Berikutnya &gt;</button>
                ${calendarHTML}
            `;
        }

        function changeMonth(year, month) {
            const haidDurasi = parseInt(document.getElementById('haid-durasi').value);
            const siklusHaid = parseInt(document.getElementById('siklus-haid').value);
            const haidTerakhir = new Date(document.getElementById('haid-terakhir').value);

            const haidStartDate = new Date(haidTerakhir);
            haidStartDate.setDate(haidStartDate.getDate() + siklusHaid);

            const haidEndDate = new Date(haidStartDate);
            haidEndDate.setDate(haidEndDate.getDate() + haidDurasi);

            renderCalendar(haidStartDate, haidEndDate, year, month);
        }
    </script>
</body>
</html>
