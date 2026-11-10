
<?php
$namaPengguna = session()->get('nama') ?? 'Pengguna';
$inisial = strtoupper(substr($namaPengguna, 0, 1));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - Duitly</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f7f6fb;
            color: #39364a;
        }

        .navbar {
            height: 68px;
            background: white;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            box-shadow: 0 2px 12px rgba(50,40,80,.06);
        }

        .navbar-left, .navbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .brand {
            font-size: 25px;
            font-weight: 700;
            color: #806bd0;
            text-decoration: none;
        }

        .menu-toggle {
            width: 38px;
            height: 38px;
            border: none;
            border-radius: 9px;
            background: #f0edff;
            color: #806bd0;
            font-size: 20px;
            cursor: pointer;
        }

        .add-button {
            text-decoration: none;
            background: #806bd0;
            color: white;
            padding: 10px 16px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 600;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 9px;
            text-decoration: none;
            color: #504b61;
            font-size: 12px;
            font-weight: 600;
        }

        .user-avatar {
            width: 37px;
            height: 37px;
            border-radius: 50%;
            background: #eee8ff;
            color: #806bd0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .sidebar {
            position: fixed;
            top: 68px;
            left: 0;
            bottom: 0;
            width: 250px;
            background: #30265d;
            color: white;
            z-index: 999;
            display: flex;
            flex-direction: column;
            padding: 25px 16px 20px;
            transition: transform .3s ease;
        }

        .sidebar.closed { transform: translateX(-100%); }

        .sidebar-profile {
            text-align: center;
            padding: 10px 8px 25px;
            border-bottom: 1px solid rgba(255,255,255,.12);
            margin-bottom: 20px;
        }

        .sidebar-avatar {
            width: 66px;
            height: 66px;
            margin: 0 auto 10px;
            border-radius: 50%;
            background: #e9e1ff;
            color: #806bd0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            font-weight: 700;
        }

        .sidebar-profile h3 { font-size: 13px; }
        .sidebar-profile p { font-size: 10px; color: #c7bfe4; }

        .menu-label {
            color: #aaa0d0;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 0 12px;
            margin-bottom: 10px;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 9px;
            text-decoration: none;
            color: #ddd7f1;
            font-size: 12px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #806bd0;
            color: white;
        }

        .menu-icon { width: 20px; text-align: center; }

        .sidebar-logout {
            margin-top: auto;
            padding-top: 18px;
            border-top: 1px solid rgba(255,255,255,.12);
        }

        .sidebar-logout button {
            width: 100%;
            padding: 12px 14px;
            border: none;
            border-radius: 9px;
            background: rgba(255,130,160,.15);
            color: #ffc1d0;
            text-align: left;
            font-family: inherit;
            font-size: 12px;
            cursor: pointer;
        }

        .sidebar-overlay { display: none; }

        .main-content {
            margin-left: 250px;
            padding: 100px 30px 35px;
            min-height: 100vh;
            transition: margin-left .3s ease;
        }

        .main-content.expanded { margin-left: 0; }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-heading h1 { font-size: 23px; margin-bottom: 4px; }
        .page-heading p { font-size: 12px; color: #9994aa; }

        .filter-card, .history-card {
            background: white;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(70,60,100,.04);
            margin-bottom: 20px;
        }

        .section-title { font-size: 16px; margin-bottom: 17px; }

        .filter-form {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 13px;
            align-items: end;
        }

        .filter-group label {
            display: block;
            font-size: 11px;
            color: #777187;
            margin-bottom: 7px;
        }

        .filter-group input, .filter-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #e8e4f0;
            border-radius: 8px;
            font-family: inherit;
            font-size: 11px;
        }

        .filter-actions {
            display: flex;
            gap: 9px;
            margin-top: 15px;
        }

        .filter-button {
            background: #806bd0;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-family: inherit;
            font-size: 11px;
        }

        .reset-button {
            background: #f0edff;
            color: #806bd0;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 11px;
        }

        .history-card { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; min-width: 650px; }

        th, td {
            padding: 13px 11px;
            text-align: left;
            border-bottom: 1px solid #f0eef5;
            font-size: 11px;
        }

        th { color: #9994aa; font-weight: 500; }

        .category {
            background: #f0edff;
            color: #806bd0;
            padding: 5px 9px;
            border-radius: 7px;
        }

        .amount { font-weight: 600; color: #df829b; }

        .edit-link {
            color: #806bd0;
            text-decoration: none;
            margin-right: 10px;
        }

        .delete {
            padding: 6px 10px;
            border: 1px solid #f5b7c5;
            border-radius: 7px;
            background: #fff0f3;
            color: #d94f70;
            font-family: inherit;
            font-size: 11px;
            cursor: pointer;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #aaa5b5;
        }

        .success-message, .error-message {
            padding: 12px;
            border-radius: 9px;
            margin-bottom: 15px;
            font-size: 12px;
        }

        .success-message { background: #e5f7ec; color: #328653; }
        .error-message { background: #fde8ed; color: #d34f6d; }

        @media(max-width: 900px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }

            .sidebar-overlay.active {
                display: block;
                position: fixed;
                inset: 68px 0 0;
                background: rgba(30,25,50,.35);
                z-index: 998;
            }

            .main-content { margin-left: 0; padding: 95px 22px 30px; }
            .filter-form { grid-template-columns: repeat(2, 1fr); }
        }

        @media(max-width: 600px) {
            .navbar { padding: 0 14px; }
            .brand { font-size: 21px; }
            .user-name { display: none; }
            .add-button { padding: 9px 10px; font-size: 10px; }
            .main-content { padding: 90px 14px 25px; }
            .filter-form { grid-template-columns: 1fr; }
            .filter-card, .history-card { padding: 17px; }
        }
    </style>
</head>

<body>

<header class="navbar">
    <div class="navbar-left">
        <a href="<?= site_url('pengeluaran') ?>" class="brand">Duitly.</a>
        <button type="button" class="menu-toggle" id="menuToggle">☰</button>
    </div>

    <div class="navbar-right">
        <a href="<?= site_url('pengeluaran/create') ?>" class="add-button">
            + Tambah Pengeluaran
        </a>

        <a href="<?= site_url('profil') ?>" class="user-menu">
            <div class="user-avatar"><?= esc($inisial) ?></div>
            <span class="user-name"><?= esc($namaPengguna) ?></span>
        </a>
    </div>
</header>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-profile">
        <div class="sidebar-avatar"><?= esc($inisial) ?></div>
        <h3><?= esc($namaPengguna) ?></h3>
        <p>Pengguna Duitly</p>
    </div>

    <p class="menu-label">Menu Utama</p>

    <nav class="sidebar-menu">
        <a href="<?= site_url('pengeluaran') ?>">
            <span class="menu-icon">▦</span> Dashboard
        </a>

        <a href="<?= site_url('pengeluaran/daftar') ?>" class="active">
            <span class="menu-icon">▤</span> Pengeluaran
        </a>

        <a href="<?= site_url('anggaran') ?>">
            <span class="menu-icon">◎</span> Anggaran
        </a>

        <a href="<?= site_url('profil') ?>">
            <span class="menu-icon">♙</span> Profil Saya
        </a>
    </nav>

    <div class="sidebar-logout">
        <form action="<?= site_url('logout') ?>" method="post"
              onsubmit="return confirm('Apakah kamu yakin ingin logout?')">
            <?= csrf_field() ?>
            <button type="submit">⇥ &nbsp; Logout</button>
        </form>
    </div>
</aside>

<main class="main-content">
    <div class="page-heading">
        <div>
            <h1>Daftar Pengeluaran</h1>
            <p>Kelola dan pantau seluruh transaksi pengeluaranmu.</p>
        </div>
    </div>

    <section class="filter-card">
        <h2 class="section-title">Filter dan Pencarian Pengeluaran</h2>

        <form action="<?= site_url('pengeluaran/daftar') ?>" method="get">
            <div class="filter-form">
                <div class="filter-group">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai"
                           value="<?= esc($tanggalMulai ?? '') ?>">
                </div>

                <div class="filter-group">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai"
                           value="<?= esc($tanggalSelesai ?? '') ?>">
                </div>

                <div class="filter-group">
                    <label>Kategori</label>
                    <select name="kategori">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($daftarKategori as $kategori): ?>
                            <option value="<?= esc($kategori) ?>"
                                <?= ($kategoriFilter ?? '') === $kategori ? 'selected' : '' ?>>
                                <?= esc($kategori) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Cari Keterangan</label>
                    <input type="text" name="keyword"
                           placeholder="Contoh: makan, bensin..."
                           value="<?= esc($keyword ?? '') ?>">
                </div>
            </div>

            <div class="filter-actions">
                <button type="submit" class="filter-button">Terapkan Filter</button>
                <a href="<?= site_url('pengeluaran/daftar') ?>" class="reset-button">Reset</a>
            </div>
        </form>
    </section>

    <section class="history-card">
        <h2 class="section-title">Riwayat Pengeluaran</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="success-message">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="error-message">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($pengeluaran)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($pengeluaran as $item): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($item['tanggal']) ?></td>
                            <td><span class="category"><?= esc($item['kategori']) ?></span></td>
                            <td><?= esc($item['keterangan']) ?></td>
                            <td class="amount">
                                Rp <?= number_format((float)$item['jumlah'], 0, ',', '.') ?>
                            </td>
                            <td>
                                <a href="<?= site_url('pengeluaran/edit/' . $item['id']) ?>"
                                   class="edit-link">Edit</a>

                                <form action="<?= site_url('pengeluaran/delete/' . $item['id']) ?>"
                                      method="post" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="delete"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="empty">
                            Belum ada data pengeluaran yang sesuai.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const mainContent = document.querySelector('.main-content');

    const STORAGE_KEY = 'duitlySidebarClosed';

    function sidebarIsClosed() {
        if (window.innerWidth > 900) {
            return sidebar.classList.contains('closed');
        }
        return !sidebar.classList.contains('active');
    }

    function applySidebarState(closed) {
        if (window.innerWidth > 900) {
            sidebar.classList.toggle('closed', closed);
            mainContent.classList.toggle('expanded', closed);
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
        } else {
            sidebar.classList.remove('closed');
            mainContent.classList.remove('expanded');
            sidebar.classList.toggle('active', !closed);
            sidebarOverlay.classList.toggle('active', !closed);
        }
    }

    function saveSidebarState() {
        sessionStorage.setItem(
            STORAGE_KEY,
            sidebarIsClosed() ? 'true' : 'false'
        );
    }

    const savedState = sessionStorage.getItem(STORAGE_KEY);
    const initialClosed = savedState === null
        ? window.innerWidth <= 900
        : savedState === 'true';

    applySidebarState(initialClosed);

    menuToggle.addEventListener('click', function() {
        const closed = sidebarIsClosed();
        applySidebarState(!closed);
        saveSidebarState();
    });

    document.querySelectorAll('.sidebar-menu a').forEach(function(link) {
        link.addEventListener('click', function() {
            sessionStorage.setItem(STORAGE_KEY, 'true');
        });
    });

    sidebarOverlay.addEventListener('click', function() {
        applySidebarState(true);
        saveSidebarState();
    });

    window.addEventListener('resize', function() {
        const saved = sessionStorage.getItem(STORAGE_KEY);
        const closed = saved === null
            ? window.innerWidth <= 900
            : saved === 'true';

        applySidebarState(closed);
    });
});
</script>

</body>
</html>
