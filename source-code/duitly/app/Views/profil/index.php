
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil - Duitly</title>

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
        }

        .page {
            max-width: 1150px;
            margin: 35px auto;
            padding: 0 22px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            gap: 15px;
        }

        .brand {
            color: #8875d9;
            font-size: 27px;
            font-weight: 700;
        }

        .back-button {
            text-decoration: none;
            color: #806bd0;
            background: #f0edff;
            padding: 10px 17px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
        }

        .page-heading {
            margin-bottom: 25px;
        }

        .page-heading h1 {
            font-size: 27px;
            color: #39364a;
            margin-bottom: 5px;
        }

        .page-heading p {
            color: #9994aa;
            font-size: 13px;
        }

        .settings-container {
            display: grid;
            grid-template-columns: 245px 1fr;
            gap: 22px;
            align-items: start;
        }

        /* MENU PENGATURAN */
        .settings-menu {
            background: white;
            border-radius: 16px;
            padding: 18px;
            box-shadow: 0 5px 25px rgba(70, 60, 100, 0.04);
        }

        .menu-title {
            font-size: 12px;
            color: #aaa5b5;
            font-weight: 600;
            margin: 5px 10px 15px;
            text-transform: uppercase;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 13px 12px;
            border: none;
            background: transparent;
            border-radius: 10px;
            text-align: left;
            color: #777187;
            font-family: inherit;
            font-size: 12px;
            cursor: pointer;
            margin-bottom: 6px;
            transition: 0.2s;
        }

        .menu-item:hover {
            background: #f8f6ff;
            color: #806bd0;
        }

        .menu-item.active {
            background: #f0edff;
            color: #806bd0;
            font-weight: 600;
        }

        .menu-icon {
            font-size: 17px;
        }

        /* KONTEN PENGATURAN */
        .settings-content {
            background: white;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 5px 25px rgba(70, 60, 100, 0.04);
            min-width: 0;
        }

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .section-heading {
            border-bottom: 1px solid #eeeaf4;
            padding-bottom: 18px;
            margin-bottom: 22px;
        }

        .section-heading h2 {
            color: #39364a;
            font-size: 19px;
            margin-bottom: 5px;
        }

        .section-heading p {
            color: #9994aa;
            font-size: 12px;
        }

        /* FOTO / AVATAR */
        .profile-picture {
            margin-bottom: 28px;
        }

        .profile-picture h3 {
            font-size: 13px;
            margin-bottom: 15px;
        }

        .picture-content {
            display: flex;
            align-items: center;
            gap: 17px;
            flex-wrap: wrap;
        }

        .avatar {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            background: #eee8ff;
            color: #806bd0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 29px;
            font-weight: 700;
        }

        .picture-info strong {
            font-size: 13px;
            display: block;
            margin-bottom: 4px;
        }

        .picture-info p {
            color: #9994aa;
            font-size: 11px;
        }

        .info-label {
            color: #9994aa;
            font-size: 11px;
            margin-bottom: 5px;
        }

        /* FORM */
        .form-section {
            margin-bottom: 25px;
        }

        .form-section h3 {
            font-size: 14px;
            margin-bottom: 17px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        .form-group label {
            display: block;
            color: #5e596e;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #e8e4f0;
            border-radius: 9px;
            font-family: inherit;
            font-size: 12px;
            color: #39364a;
            outline: none;
            background: white;
        }

        .form-group input:focus {
            border-color: #8875d9;
            box-shadow: 0 0 0 3px rgba(136, 117, 217, 0.08);
        }

        .form-group input:disabled {
            background: #f7f6fa;
        }

        .form-note {
            color: #9994aa;
            font-size: 11px;
            margin-top: 7px;
        }

        /* TOMBOL */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            border-top: 1px solid #eeeaf4;
            padding-top: 20px;
            margin-top: 25px;
        }

        .btn {
            padding: 11px 20px;
            border-radius: 9px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
        }

        .btn-cancel {
            color: #806bd0;
            border: 1px solid #b9a9e7;
            background: white;
        }

        .btn-save {
            background: #806bd0;
            color: white;
        }

        .btn-save:hover {
            background: #6c58bc;
        }

        .btn-cancel:hover {
            background: #f8f6ff;
        }

        /* NOTIFIKASI */
        .alert {
            padding: 13px 16px;
            border-radius: 9px;
            font-size: 12px;
            margin-bottom: 18px;
        }

        .alert-success {
            background: #e5f7ec;
            color: #328653;
        }

        .alert-error {
            background: #fde8ed;
            color: #d34f6d;
        }

        .security-note {
            background: #f8f6ff;
            color: #7664b7;
            padding: 15px;
            border-radius: 10px;
            font-size: 11px;
            line-height: 1.7;
            margin-bottom: 22px;
        }

        /* RESPONSIVE */
        @media(max-width: 750px) {
            .settings-container {
                grid-template-columns: 1fr;
            }

            .settings-menu {
                display: flex;
                gap: 8px;
                padding: 12px;
                overflow-x: auto;
            }

            .menu-title {
                display: none;
            }

            .menu-item {
                min-width: max-content;
                margin: 0;
            }

            .settings-content {
                padding: 20px;
            }

            .page {
                margin-top: 20px;
            }
        }

        @media(max-width: 450px) {
            .page-heading h1 {
                font-size: 23px;
            }

            .topbar {
                align-items: flex-start;
            }

            .action-buttons {
                flex-direction: column-reverse;
            }

            .action-buttons .btn {
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <!-- HEADER -->
    <div class="topbar">
        <div class="brand">Duitly.</div>

        <a href="<?= site_url('pengeluaran') ?>" class="back-button">
            ← Kembali ke Dashboard
        </a>
    </div>

    <div class="page-heading">
        <h1>Pengaturan</h1>
        <p>Kelola informasi dan keamanan akun Duitly Anda.</p>
    </div>

    <div class="settings-container">

        <!-- MENU SAMPING -->
        <aside class="settings-menu">

            <p class="menu-title">Pengaturan Akun</p>

            <button
                type="button"
                class="menu-item active"
                data-target="general"
            >
                <span class="menu-icon">ⓘ</span>
                General Information
            </button>

            <button
                type="button"
                class="menu-item"
                data-target="security"
            >
                <span class="menu-icon">🛡</span>
                Security
            </button>

        </aside>

        <!-- KONTEN -->
        <main class="settings-content">

            <!-- NOTIFIKASI UMUM -->
            <?php if ($success = session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= esc($success) ?>
                </div>
            <?php endif; ?>

            <?php if ($error = session()->getFlashdata('error')): ?>
                <div class="alert alert-error">
                    <?= esc($error) ?>
                </div>
            <?php endif; ?>

            <!-- GENERAL INFORMATION -->
            <section class="content-section active" id="general">

                <div class="section-heading">
                    <h2>General Information</h2>
                    <p>Perbarui informasi dasar akun Duitly Anda.</p>
                </div>

                <!-- PROFIL PENGGUNA -->
                <div class="profile-picture">

                    <h3>Profile Information</h3>

                    <div class="picture-content">

                        <div class="avatar">
                            <?= esc(strtoupper(substr($user['nama'], 0, 1))) ?>
                        </div>

                        <div class="picture-info">
                            <strong><?= esc($user['nama']) ?></strong>
                            <p><?= esc($user['email']) ?></p>
                            <p>Pengguna Duitly</p>
                        </div>

                    </div>

                </div>

                <!-- FORM EDIT PROFIL -->
                <form action="<?= site_url('profil/update') ?>" method="post">

                    <?= csrf_field() ?>

                    <div class="form-section">
                        <h3>Informasi Pribadi</h3>

                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>

                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                value="<?= esc($user['nama']) ?>"
                                placeholder="Masukkan nama lengkap"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="email">Alamat Email</label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="<?= esc($user['email']) ?>"
                                placeholder="Masukkan alamat email"
                                required
                            >
                        </div>

                    </div>

                    <div class="action-buttons">

                        <a
                            href="<?= site_url('pengeluaran') ?>"
                            class="btn btn-cancel"
                        >
                            Batal
                        </a>

                        <button type="submit" class="btn btn-save">
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </section>

            <!-- SECURITY -->
            <section class="content-section" id="security">

                <div class="section-heading">
                    <h2>Security</h2>
                    <p>Kelola password untuk menjaga keamanan akun Anda.</p>
                </div>

                <?php if ($successPassword = session()->getFlashdata('success_password')): ?>
                    <div class="alert alert-success">
                        <?= esc($successPassword) ?>
                    </div>
                <?php endif; ?>

                <?php if ($errorPassword = session()->getFlashdata('error_password')): ?>
                    <div class="alert alert-error">
                        <?= esc($errorPassword) ?>
                    </div>
                <?php endif; ?>

                <div class="security-note">
                    🔒 Untuk menjaga keamanan akun, masukkan password lama
                    sebelum menggantinya dengan password baru. Gunakan
                    password minimal 8 karakter.
                </div>

                <form action="<?= site_url('profil/password') ?>" method="post">

                    <?= csrf_field() ?>

                    <div class="form-section">

                        <h3>Ubah Password</h3>

                        <div class="form-group">
                            <label for="password_lama">Password Lama</label>

                            <input
                                type="password"
                                id="password_lama"
                                name="password_lama"
                                placeholder="Masukkan password lama"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="password_baru">Password Baru</label>

                            <input
                                type="password"
                                id="password_baru"
                                name="password_baru"
                                minlength="8"
                                placeholder="Masukkan password baru"
                                required
                            >

                            <p class="form-note">
                                Password baru minimal 8 karakter.
                            </p>
                        </div>

                        <div class="form-group">
                            <label for="konfirmasi_password">
                                Konfirmasi Password Baru
                            </label>

                            <input
                                type="password"
                                id="konfirmasi_password"
                                name="konfirmasi_password"
                                minlength="8"
                                placeholder="Ulangi password baru"
                                required
                            >
                        </div>

                    </div>

                    <div class="action-buttons">

                        <button
                            type="reset"
                            class="btn btn-cancel"
                        >
                            Batal
                        </button>

                        <button type="submit" class="btn btn-save">
                            Simpan Password
                        </button>

                    </div>

                </form>

            </section>

        </main>

    </div>

</div>

<!-- JAVASCRIPT MENU PENGATURAN -->
<script>
    const menuItems = document.querySelectorAll('.menu-item');
    const sections = document.querySelectorAll('.content-section');

    menuItems.forEach(function(item) {

        item.addEventListener('click', function() {

            const target = this.getAttribute('data-target');

            menuItems.forEach(function(menu) {
                menu.classList.remove('active');
            });

            sections.forEach(function(section) {
                section.classList.remove('active');
            });

            this.classList.add('active');

            document.getElementById(target).classList.add('active');

        });

    });
</script>

</body>
</html>
