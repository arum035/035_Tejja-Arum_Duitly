
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - Duitly</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f7fc;
            color: #39364a;
            padding: 35px;
        }

        .container {
            max-width: 650px;
            margin: 40px auto;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: #8875d9;
            margin-bottom: 5px;
        }

        .subtitle {
            color: #9994aa;
            font-size: 13px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 5px 25px rgba(70, 60, 100, 0.05);
        }

        h2 {
            font-size: 20px;
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #e9e6f0;
            border-radius: 10px;
            font-family: inherit;
            margin-bottom: 20px;
            outline: none;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #8875d9;
        }

        textarea {
            resize: vertical;
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 10px;
            background: #8875d9;
            color: white;
            border: none;
            text-decoration: none;
            font-family: inherit;
            cursor: pointer;
        }

        .back {
            background: #f0edff;
            color: #806bd0;
            margin-right: 8px;
        }
    </style>
</head>

<body>
<div class="container">

    <div class="logo">Duitly.</div>
    <p class="subtitle">Catatan Keuangan Mahasiswa</p>

    <div class="card">
        <h2>Edit Pengeluaran</h2>

        <form action="<?= site_url('pengeluaran/update/' . $item['id']) ?>" method="post">

            <?= csrf_field() ?>

            <label>Tanggal Pengeluaran</label>
            <input type="date" name="tanggal"
                   value="<?= esc($item['tanggal']) ?>" required>

            <label>Kategori</label>
            <select name="kategori" required>
                <option value="Makanan" <?= $item['kategori'] == 'Makanan' ? 'selected' : '' ?>>Makanan</option>
                <option value="Transportasi" <?= $item['kategori'] == 'Transportasi' ? 'selected' : '' ?>>Transportasi</option>
                <option value="Kebutuhan Kuliah" <?= $item['kategori'] == 'Kebutuhan Kuliah' ? 'selected' : '' ?>>Kebutuhan Kuliah</option>
                <option value="Hiburan" <?= $item['kategori'] == 'Hiburan' ? 'selected' : '' ?>>Hiburan</option>
                <option value="Belanja" <?= $item['kategori'] == 'Belanja' ? 'selected' : '' ?>>Belanja</option>
                <option value="Lainnya" <?= $item['kategori'] == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
            </select>

            <label>Keterangan</label>
            <textarea name="keterangan" rows="3"><?= esc($item['keterangan']) ?></textarea>

            <label>Jumlah Pengeluaran (Rp)</label>
            <input type="number" name="jumlah" min="1" step="0.01"
                   value="<?= esc($item['jumlah']) ?>" required>

            <a href="<?= site_url('pengeluaran') ?>" class="button back">
                Kembali
            </a>

            <button type="submit" class="button">
                Simpan Perubahan
            </button>

        </form>
    </div>

</div>
</body>
</html>
