
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Duitly</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f1ff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background: white;
            width: 100%;
            max-width: 420px;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        h2 {
            color: #7155b8;
            text-align: center;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #888;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin: 15px 0 7px;
            color: #444;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        button {
            width: 100%;
            padding: 13px;
            margin-top: 22px;
            background: #8063c9;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #694bb3;
        }

        .message {
            padding: 10px;
            border-radius: 7px;
            margin-bottom: 15px;
            background: #ffe5e5;
            color: #b42318;
        }

        .login {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        a {
            color: #7155b8;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Duitly</h2>
    <p class="subtitle">Buat akun untuk mulai mengatur keuanganmu</p>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="message">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('register/proses') ?>" method="post">
        <?= csrf_field() ?>

        <label>Nama Lengkap</label>
        <input type="text" name="nama" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required minlength="8">

        <label>Konfirmasi Password</label>
        <input type="password" name="konfirmasi_password" required minlength="8">

        <button type="submit">Daftar Sekarang</button>
    </form>

    <div class="login">
        Sudah punya akun? <a href="<?= base_url('login') ?>">Login</a>
    </div>
</div>

</body>
</html>
