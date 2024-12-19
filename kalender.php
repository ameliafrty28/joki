<?php
// Menentukan apakah siklus menstruasi normal
function isCycleNormal($cycleLength) {
    return $cycleLength >= 21 && $cycleLength <= 35;
}

// Menangani pengiriman formulir
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dates = isset($_POST['dates']) ? array_map('trim', explode(',', $_POST['dates'])) : [];
    $cycles = [];
    $isNormal = true;

    for ($i = 0; $i < count($dates) - 1; $i++) {
        $startDate = new DateTime($dates[$i]);
        $nextDate = new DateTime($dates[$i + 1]);
        $cycleLength = $startDate->diff($nextDate)->days;
        $cycles[] = $cycleLength;
        if (!isCycleNormal($cycleLength)) {
            $isNormal = false;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Siklus Menstruasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #f071a6;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background: #e9f7ef;
            border: 1px solid #d4edda;
            color: #155724;
            border-radius: 5px;
        }
        .error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kalkulator Siklus Menstruasi</h1>
        <p>Masukkan hari pertama haid setiap bulan (format: YYYY-MM-DD), pisahkan dengan koma:</p>
        <form method="POST">
            <textarea name="dates" rows="4" cols="50" placeholder="Contoh: 2024-01-01, 2024-02-02, 2024-03-03"></textarea><br><br>
            <button type="submit">Hitung Siklus</button>
        </form>

        <?php if (isset($cycles)): ?>
            <div class="result">
                <h2>Hasil Perhitungan:</h2>
                <ul>
                    <?php foreach ($cycles as $index => $cycle): ?>
                        <li>Siklus ke-<?= $index + 1 ?>: <?= $cycle ?> hari <?= isCycleNormal($cycle) ? "(Normal)" : "(Tidak Normal)" ?></li>
                    <?php endforeach; ?>
                </ul>
                <p>
                    <?php if ($isNormal): ?>
                        Semua siklus menstruasi dalam rentang normal (21-35 hari).
                    <?php else: ?>
                        Beberapa siklus menstruasi tidak normal. Disarankan untuk berkonsultasi dengan dokter.
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
