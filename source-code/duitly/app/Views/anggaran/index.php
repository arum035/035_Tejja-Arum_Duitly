
<![CDATA[
<?php
$namaBulan = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
    4 => 'April', 5 => 'Mei', 6 => 'Juni',
    7 => 'Juli', 8 => 'Agustus', 9 => 'September',
    10 => 'Oktober', 11 => 'November', 12 => 'Desember'
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggaran Bulanan - Duitly</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 35px 20px;
            background: #f8f6fc;
            font-family: 'Poppins', sans-serif;
            color: #37304a;
        }

        .container {
            max-width: 850px;
            margin: auto;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0 0 8px;
            font-size: 27px;
        }

        .header p {
            color: #898398;
            margin: 0;
            font-size: 14px;
        }

        .card {
            background: white;
            padding: 28px;
            border-radius: 18px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(60, 40, 90, 0.05);
        }

        .card h3 {
            margin-top: 0;
            font-size: 17px;
        }

        .period {
            color: #8b79b5;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .amount {
            font-size: 30px;
            font-weight: 700;
            color: #8063b5;
            margin: 10px 0;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 9px;
        }

        input {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #e5deef;
            border-radius: 10px;
            font-family: inherit;
            font-size: 14px;
            outline: none;
        }

        input:focus {
            border-color: #a78bda;
        }

        button {
            margin-top: 16px;
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 10px;
            background: #9275c5;
            color: white;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        button:hover {
            background: #8063b5;
        }

        .message {
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .success {
            background: #e8f7ed;
            color: #287744;
        }

        .error {
            background: #fff0f0;
            color: #b53d3d;
        }

        .note {
            color: #9991a5;
            font-size: 12px;
            margin-top: 14px;
        }

        .back {
            display: inline-block;
            margin-top: 8px;
            color: #8063b5;
            text-decoration: none;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            body {
                padding: 22px 14px;
            }

            .card {
                padding: 21px;
            }

            .amount {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <h1>Anggaran Bulanan</h1>
        <p>Atur batas pengeluaran agar keuanganmu lebih terkontrol.</p>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="message success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="message error">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <h3>Anggaran Saat Ini</h3>

        <div class="period">
            <?= esc($namaBulan[$bulan]) ?> <?= esc($tahun) ?>
        </div>

        <?php if ($anggaran): ?>
            <div class="amount">
                Rp <?= number_format($anggaran['jumlah_anggaran'], 0, ',', '.') ?>
            </div>
            <p class="note">Anggaran yang telah kamu tetapkan untuk bulan ini.</p>
        <?php else: ?>
            <div class="amount">Belum diatur</div>
            <p class="note">Kamu belum menentukan anggaran untuk bulan ini.</p>
        <?php endif; ?>
    </div>

    <div class="card">
        <h3>Atur Anggaran Bulan Ini</h3>

        <form action="<?= base_url('anggaran/simpan') ?>" method="post">
            <?= csrf_field() ?>

            <label for="jumlah_anggaran">Jumlah Anggaran (Rp)</label>

            <input
                type="number"
                id="jumlah_anggaran"
                name="jumlah_anggaran"
                min="1"
                step="1"
                placeholder="Contoh: 1000000"
                value="<?= esc($anggaran['jumlah_anggaran'] ?? '') ?>"
                required
            >

            <button type="submit">Simpan Anggaran</button>
        </form>

        <p class="note">
            Kamu bisa mengubah anggaran kapan saja selama bulan berjalan.
        </p>
    </div>

    <a href="<?= base_url('pengeluaran') ?>" class="back">
        ← Kembali ke Dashboard Duitly
    </a>

</div>
</body>
</html>
]]>
