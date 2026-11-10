
<?php
$namaPengguna = session()->get('nama') ?? 'Pengguna';
$inisial = strtoupper(substr($namaPengguna, 0, 1));

$namaBulan = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
    4 => 'April', 5 => 'Mei', 6 => 'Juni',
    7 => 'Juli', 8 => 'Agustus', 9 => 'September',
    10 => 'Oktober', 11 => 'November', 12 => 'Desember'
];

$bulanSekarang = (int) date('n');
$sudahMelebihi = $jumlahAnggaran > 0 && $sisaAnggaran < 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - Duitly</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f7f6fb;
            color: #39364a;
        }

        /* NAVBAR */
        .navbar {
            height: 68px;
            background: #fff;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            box-shadow: 0 2px 12px rgba(50, 40, 80, .06);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .brand {
            font-size: 25px;
            font-weight: 700;
            color: #806bd0;
            text-decoration: none;
        }

        .menu-toggle {
            border: none;
            background: #f0edff;
            color: #806bd0;
            border-radius: 9px;
            width: 38px;
            height: 38px;
            font-size: 20px;
            cursor: pointer;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
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

        .add-button:hover {
            background: #6d59bd;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
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
            font-size: 15px;
            font-weight: 700;
        }

        /* SIDEBAR */
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

        .sidebar.closed {
            transform: translateX(-100%);
        }

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

        .sidebar-profile h3 {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 4px;
            overflow-wrap: anywhere;
        }

        .sidebar-profile p {
            font-size: 10px;
            color: #c7bfe4;
        }

        .menu-label {
            color: #aaa0d0;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
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
            transition: .2s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #806bd0;
            color: white;
        }

        .menu-icon {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

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
            background: rgba(255, 130, 160, .15);
            color: #ffc1d0;
            text-align: left;
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .sidebar-logout button:hover {
            background: rgba(255, 130, 160, .27);
        }

        .sidebar-overlay {
            display: none;
        }

        /* KONTEN UTAMA */
        .main-content {
            margin-left: 250px;
            padding: 100px 30px 35px;
            min-height: 100vh;
            transition: margin-left .3s ease;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-heading h1 {
            font-size: 23px;
            color: #39364a;
            margin-bottom: 4px;
        }

        .page-heading p {
            font-size: 12px;
            color: #9994aa;
        }

        /* RINGKASAN */
        .summary {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 22px;
        }

        .summary-card {
            background: white;
            padding: 23px;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(70,60,100,.04);
            border-left: 4px solid #a99ae8;
        }

        .summary-card.transaction {
            border-left-color: #e9a0b3;
        }

        .summary-card p {
            color: #9994aa;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .summary-card h2 {
            font-size: 23px;
            color: #806bd0;
        }

        .summary-card.transaction h2 {
            color: #df829b;
        }

        /* ANGGARAN DAN GRAFIK */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .budget-card,
        .chart-card,
        .filter-card,
        .history-card {
            background: white;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(70,60,100,.04);
            min-width: 0;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 17px;
        }

        .budget-header {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 18px;
        }

        .budget-header p {
            color: #9994aa;
            font-size: 11px;
        }

        .budget-link {
            color: #806bd0;
            text-decoration: none;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .budget-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 9px;
            margin-bottom: 20px;
        }

        .budget-item {
            background: #f8f6fc;
            padding: 12px 9px;
            border-radius: 9px;
            min-width: 0;
        }

        .budget-item p {
            color: #9994aa;
            font-size: 10px;
            margin-bottom: 7px;
        }

        .budget-item h3 {
            color: #806bd0;
            font-size: 13px;
            overflow-wrap: anywhere;
        }

        .budget-item.used h3 {
            color: #df829b;
        }

        .budget-item.remaining h3 {
            color: #53a98b;
        }

        .budget-item.remaining h3.over {
            color: #df829b;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: #9994aa;
            margin-bottom: 8px;
        }

        .progress-track {
            height: 10px;
            background: #eeeaf5;
            border-radius: 20px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #a99ae8;
            border-radius: 20px;
        }

        .progress-fill.over {
            background: #e17b91;
        }

        .budget-note {
            color: #9994aa;
            font-size: 11px;
            line-height: 1.6;
            margin-top: 12px;
        }

        .chart-container {
            position: relative;
            height: 270px;
            width: 100%;
        }

        .chart-empty {
            text-align: center;
            color: #aaa5b5;
            padding: 50px 10px;
            font-size: 12px;
        }

        /* NOTIFIKASI */
        .alert-anggaran {
            padding: 13px 17px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 11px;
            line-height: 1.7;
        }

        .alert-anggaran strong {
            display: block;
            margin-bottom: 3px;
        }

        .alert-aman {
            background: #e5f7ec;
            color: #328653;
        }

        .alert-peringatan {
            background: #fff4d9;
            color: #a87519;
        }

        .alert-bahaya {
            background: #fde8ed;
            color: #d34f6d;
        }

        /* FILTER */
        .filter-card {
            margin-bottom: 20px;
        }

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

        .filter-group input,
        .filter-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #e8e4f0;
            border-radius: 8px;
            font-family: inherit;
            font-size: 11px;
            color: #39364a;
            background: white;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: #8875d9;
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

        /* RIWAYAT */
        .history-card {
            overflow-x: auto;
        }

        .history-card table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        .history-card th,
        .history-card td {
            padding: 13px 11px;
            text-align: left;
            border-bottom: 1px solid #f0eef5;
            font-size: 11px;
        }

        .history-card th {
            color: #9994aa;
            font-weight: 500;
        }

        .category {
            background: #f0edff;
            color: #806bd0;
            padding: 5px 9px;
            border-radius: 7px;
        }

        .amount {
            font-weight: 600;
            color: #df829b;
        }

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

        .delete:hover {
            background: #fbd5df;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #aaa5b5;
        }

        .success-message {
            background: #e5f7ec;
            color: #328653;
            padding: 12px;
            border-radius: 9px;
            margin-bottom: 15px;
            font-size: 12px;
        }

        /* RESPONSIVE */
        @media(max-width: 900px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .sidebar-overlay.active {
                display: block;
                position: fixed;
                inset: 68px 0 0;
                background: rgba(30,25,50,.35);
                z-index: 998;
            }

            .main-content {
                margin-left: 0;
                padding: 95px 22px 30px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .filter-form {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 600px) {
            .navbar {
                padding: 0 14px;
            }

            .brand {
                font-size: 21px;
            }

            .navbar-right {
                gap: 9px;
            }

            .add-button {
                padding: 9px 10px;
                font-size: 10px;
            }

            .user-name {
                display: none;
            }

            .main-content {
                padding: 90px 14px 25px;
            }

            .page-heading h1 {
                font-size: 20px;
            }

            .summary {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .summary-card {
                padding: 18px;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }

            .budget-info {
                grid-template-columns: repeat(3, 1fr);
                gap: 6px;
            }

            .budget-item {
                padding: 10px 7px;
            }

            .budget-item h3 {
                font-size: 11px;
            }

            .budget-item p {
                font-size: 9px;
            }

            .budget-card,
            .chart-card,
            .filter-card,
            .history-card {
                padding: 17px;
            }

            .chart-container {
                height: 230px;
            }
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<header class="navbar">
    <div class="navbar-left">
        <a href="<?= site_url('pengeluaran') ?>" class="brand">Duitly.</a>

        <button
            type="button"
            class="menu-toggle"
            id="menuToggle"
            aria-label="Buka atau tutup sidebar"
        >
            ☰
        </button>
    </div>

    <div class="navbar-right">
        <a href="<?= site_url('pengeluaran/create') ?>" class="add-button">
            + Tambah Pengeluaran
        </a>

        <a href="<?= site_url('profil') ?>" class="user-menu">
            <div class="user-avatar"><?= esc($inisial) ?></div>
            <span class="user-name"><?= esc($namaPengguna) ?></span>
            <span>⌄</span>
        </a>
    </div>
</header>

<!-- OVERLAY UNTUK HP -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">

    <div class="sidebar-profile">
        <div class="sidebar-avatar"><?= esc($inisial) ?></div>
        <h3><?= esc($namaPengguna) ?></h3>
        <p>Pengguna Duitly</p>
    </div>

    <p class="menu-label">Menu Utama</p>

    <nav class="sidebar-menu">
        <a href="<?= site_url('pengeluaran') ?>" class="active">
            <span class="menu-icon">▦</span>
            Dashboard
        </a>

        <a href="<?= site_url('pengeluaran/daftar') ?>">
            <span class="menu-icon">▤</span>
            Pengeluaran
        </a>

        <a href="<?= site_url('anggaran') ?>">
            <span class="menu-icon">◎</span>
            Anggaran
        </a>

        <a href="<?= site_url('profil') ?>">
            <span class="menu-icon">♙</span>
            Profil Saya
        </a>
    </nav>

    <div class="sidebar-logout">
        <form
            action="<?= site_url('logout') ?>"
            method="post"
            onsubmit="return confirm('Apakah kamu yakin ingin logout?')"
        >
            <?= csrf_field() ?>
            <button type="submit">
                ⇥ &nbsp; Logout
            </button>
        </form>
    </div>

</aside>

<!-- KONTEN UTAMA -->
<main class="main-content">

    <div class="page-heading">
        <div>
            <h1>Dashboard</h1>
            <p>Selamat datang kembali, <?= esc($namaPengguna) ?>! Berikut ringkasan keuanganmu.</p>
        </div>
    </div>

    <!-- RINGKASAN -->
    <section class="summary">
        <div class="summary-card">
            <p>Total Pengeluaran</p>
            <h2>
                Rp <?= number_format((float)$totalPengeluaran, 0, ',', '.') ?>
            </h2>
        </div>

        <div class="summary-card transaction">
            <p>Jumlah Transaksi</p>
            <h2>
                <?= number_format((int)$jumlahTransaksi, 0, ',', '.') ?> Transaksi
            </h2>
        </div>
    </section>

    <!-- ANGGARAN DAN GRAFIK -->
    <section class="dashboard-grid">

        <div class="budget-card">
            <div class="budget-header">
                <div>
                    <h2 class="section-title" style="margin-bottom:4px;">
                        Anggaran Bulanan
                    </h2>
                    <p><?= $namaBulan[$bulanSekarang] ?> <?= date('Y') ?></p>
                </div>

                <a href="<?= site_url('anggaran') ?>" class="budget-link">
                    Atur Anggaran →
                </a>
            </div>

            <?php if ($jumlahAnggaran > 0): ?>

                <div class="budget-info">
                    <div class="budget-item">
                        <p>Total Anggaran</p>
                        <h3>
                            Rp <?= number_format($jumlahAnggaran, 0, ',', '.') ?>
                        </h3>
                    </div>

                    <div class="budget-item used">
                        <p>Digunakan</p>
                        <h3>
                            Rp <?= number_format($totalPengeluaranBulanan, 0, ',', '.') ?>
                        </h3>
                    </div>

                    <div class="budget-item remaining">
                        <p><?= $sudahMelebihi ? 'Kelebihan' : 'Sisa Anggaran' ?></p>
                        <h3 class="<?= $sudahMelebihi ? 'over' : '' ?>">
                            Rp <?= number_format(abs($sisaAnggaran), 0, ',', '.') ?>
                        </h3>
                    </div>
                </div>

                <div class="progress-label">
                    <span>Penggunaan Anggaran</span>
                    <strong>
                        <?= number_format(($totalPengeluaranBulanan / $jumlahAnggaran) * 100, 1, ',', '.') ?>%
                    </strong>
                </div>

                <div class="progress-track">
                    <div
                        class="progress-fill <?= $sudahMelebihi ? 'over' : '' ?>"
                        style="width: <?= min(100, max(0, $persentaseAnggaran)) ?>%">
                    </div>
                </div>

                <p class="budget-note">
                    <?= $sudahMelebihi
                        ? 'Pengeluaranmu sudah melebihi batas anggaran bulan ini.'
                        : 'Pantau pengeluaranmu agar tetap sesuai anggaran.' ?>
                </p>

            <?php else: ?>

                <p class="budget-note">
                    Kamu belum mengatur anggaran untuk bulan ini.
                    Silakan tentukan batas pengeluaranmu.
                </p>

                <a href="<?= site_url('anggaran') ?>" class="budget-link">
                    + Buat Anggaran Sekarang
                </a>

            <?php endif; ?>
        </div>

        <!-- GRAFIK -->
        <div class="chart-card">
            <h2 class="section-title">Pengeluaran Berdasarkan Kategori</h2>

            <?php if (!empty($pengeluaranPerKategori)): ?>
                <div class="chart-container">
                    <canvas id="kategoriChart"></canvas>
                </div>
            <?php else: ?>
                <div class="chart-empty">
                    Belum ada data untuk ditampilkan dalam diagram.
                </div>
            <?php endif; ?>
        </div>

    </section>

    <!-- NOTIFIKASI ANGGARAN -->
    <?php if ($jumlahAnggaran > 0): ?>

        <?php if ($persentaseAnggaran >= 100): ?>
            <div class="alert-anggaran alert-bahaya">
                <strong>Anggaran Terlampaui!</strong>
                Pengeluaran bulan ini sudah mencapai atau melebihi batas anggaran.
                Yuk, kurangi pengeluaran yang tidak perlu.
            </div>

        <?php elseif ($persentaseAnggaran >= 80): ?>
            <div class="alert-anggaran alert-peringatan">
                <strong>Hati-hati, Anggaran Hampir Habis!</strong>
                Pengeluaran sudah mencapai
                <?= number_format($persentaseAnggaran, 1, ',', '.') ?>%
                dari anggaran bulanan.
            </div>

        <?php else: ?>
            <div class="alert-anggaran alert-aman">
                <strong>Anggaran Masih Aman</strong>
                Pengeluaran masih dalam batas anggaran bulanan.
                Tetap kelola keuangan dengan baik!
            </div>
        <?php endif; ?>

    <?php endif; ?>

    <!-- FILTER DAN PENCARIAN -->
    <section class="filter-card">
        <h2 class="section-title">Filter dan Pencarian Pengeluaran</h2>

        <form action="<?= site_url('pengeluaran') ?>" method="get">
            <div class="filter-form">

                <div class="filter-group">
                    <label>Tanggal Mulai</label>
                    <input
                        type="date"
                        name="tanggal_mulai"
                        value="<?= esc($tanggalMulai ?? '') ?>"
                    >
                </div>

                <div class="filter-group">
                    <label>Tanggal Selesai</label>
                    <input
                        type="date"
                        name="tanggal_selesai"
                        value="<?= esc($tanggalSelesai ?? '') ?>"
                    >
                </div>

                <div class="filter-group">
                    <label>Kategori</label>
                    <select name="kategori">
                        <option value="">Semua Kategori</option>

                        <?php foreach ($daftarKategori as $kategori): ?>
                            <option
                                value="<?= esc($kategori) ?>"
                                <?= ($kategoriFilter ?? '') === $kategori ? 'selected' : '' ?>
                            >
                                <?= esc($kategori) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Cari Keterangan</label>
                    <input
                        type="text"
                        name="keyword"
                        placeholder="Contoh: makan, bensin..."
                        value="<?= esc($keyword ?? '') ?>"
                    >
                </div>

            </div>

            <div class="filter-actions">
                <button type="submit" class="filter-button">
                    Terapkan Filter
                </button>

                <a href="<?= site_url('pengeluaran') ?>" class="reset-button">
                    Reset
                </a>
            </div>
        </form>
    </section>

    <!-- RIWAYAT PENGELUARAN -->
    <section class="history-card" id="riwayat">
        <h2 class="section-title">Riwayat Pengeluaran</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="success-message">
                <?= esc(session()->getFlashdata('success')) ?>
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

                            <td>
                                <span class="category">
                                    <?= esc($item['kategori']) ?>
                                </span>
                            </td>

                            <td><?= esc($item['keterangan']) ?></td>

                            <td class="amount">
                                Rp <?= number_format((float)$item['jumlah'], 0, ',', '.') ?>
                            </td>

                            <td>
                                <a
                                    href="<?= site_url('pengeluaran/edit/' . $item['id']) ?>"
                                    class="edit-link"
                                >
                                    Edit
                                </a>

                                <form
                                    action="<?= site_url('pengeluaran/delete/' . $item['id']) ?>"
                                    method="post"
                                    style="display:inline;"
                                >
                                    <?= csrf_field() ?>

                                    <button
                                        type="submit"
                                        class="delete"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    >
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php else: ?>
                    <tr>
                        <td colspan="6" class="empty">
                            Tidak ada data pengeluaran yang sesuai dengan pencarian atau filter.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>

</main>

<!-- JAVASCRIPT GRAFIK -->
<?php if (!empty($pengeluaranPerKategori)): ?>
<script>
    const kategori = <?= json_encode(array_keys($pengeluaranPerKategori)) ?>;
    const jumlah = <?= json_encode(array_values($pengeluaranPerKategori)) ?>;

    const ctx = document.getElementById('kategoriChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: kategori,
            datasets: [{
                label: 'Total Pengeluaran (Rp)',
                data: jumlah,
                backgroundColor: [
                    '#a99ae8',
                    '#f2a6b5',
                    '#91c9b7',
                    '#f4c77e',
                    '#91b9e8',
                    '#c6a3df'
                ],
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.raw.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>
<?php endif; ?>

<!-- JAVASCRIPT SIDEBAR -->
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
</script>

</body>
</html>
