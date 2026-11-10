<?php

namespace App\Controllers;

use App\Models\PengeluaranModel;
use App\Models\AnggaranModel;

class Pengeluaran extends BaseController
{
    protected $pengeluaranModel;

    public function __construct()
    {
        $this->pengeluaranModel = new PengeluaranModel();
    }

    // Menampilkan daftar pengeluaran dan ringkasan
    public function index()
    {
        $userId = session()->get('user_id');

        $tanggalMulai = $this->request->getGet('tanggal_mulai');
        $tanggalSelesai = $this->request->getGet('tanggal_selesai');
        $kategoriFilter = $this->request->getGet('kategori');
        $keyword = $this->request->getGet('keyword');

        // Mengambil pengeluaran milik pengguna
        $builder = $this->pengeluaranModel->builder();
        $builder->where('user_id', $userId);

        if (!empty($tanggalMulai)) {
            $builder->where('tanggal >=', $tanggalMulai);
        }

        if (!empty($tanggalSelesai)) {
            $builder->where('tanggal <=', $tanggalSelesai);
        }

        if (!empty($kategoriFilter)) {
            $builder->where('kategori', $kategoriFilter);
        }

        if (!empty($keyword)) {
            $builder->like('keterangan', $keyword);
        }

        $dataPengeluaran = $builder
            ->orderBy('tanggal', 'DESC')
            ->get()
            ->getResultArray();

        // Menghitung total pengeluaran
        $totalPengeluaran = 0;
        $pengeluaranPerKategori = [];

        foreach ($dataPengeluaran as $item) {
            $totalPengeluaran += $item['jumlah'];

            $kategori = $item['kategori'];

            if (!isset($pengeluaranPerKategori[$kategori])) {
                $pengeluaranPerKategori[$kategori] = 0;
            }

            $pengeluaranPerKategori[$kategori] += $item['jumlah'];
        }

        // Mengambil kategori milik pengguna
        $semuaKategori = $this->pengeluaranModel
            ->distinct()
            ->select('kategori')
            ->where('user_id', $userId)
            ->findAll();

        $daftarKategori = array_column($semuaKategori, 'kategori');

        // Mengambil anggaran bulan ini
        $bulan = (int) date('n');
        $tahun = (int) date('Y');

        $anggaranModel = new AnggaranModel();

        $anggaran = $anggaranModel
            ->where('user_id', $userId)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->first();

        $jumlahAnggaran = $anggaran
            ? (float) $anggaran['jumlah_anggaran']
            : 0;

        // Menghitung total pengeluaran bulan ini
        $awalBulan = date('Y-m-01');
        $akhirBulan = date('Y-m-t');

        $pengeluaranBulanan = $this->pengeluaranModel
            ->where('user_id', $userId)
            ->where('tanggal >=', $awalBulan)
            ->where('tanggal <=', $akhirBulan)
            ->selectSum('jumlah', 'total')
            ->first();

        $totalPengeluaranBulanan =
            (float) ($pengeluaranBulanan['total'] ?? 0);

        $sisaAnggaran = $jumlahAnggaran - $totalPengeluaranBulanan;

        $persentaseAnggaran = 0;

        if ($jumlahAnggaran > 0) {
            $persentaseAnggaran = min(
                100,
                ($totalPengeluaranBulanan / $jumlahAnggaran) * 100
            );
        }

        $data = [
            'title' => 'Data Pengeluaran',
            'pengeluaran' => $dataPengeluaran,
            'totalPengeluaran' => $totalPengeluaran,
            'jumlahTransaksi' => count($dataPengeluaran),
            'pengeluaranPerKategori' => $pengeluaranPerKategori,
            'daftarKategori' => $daftarKategori,
            'tanggalMulai' => $tanggalMulai,
            'tanggalSelesai' => $tanggalSelesai,
            'kategoriFilter' => $kategoriFilter,
            'keyword' => $keyword,

            'anggaran' => $anggaran,
            'jumlahAnggaran' => $jumlahAnggaran,
            'totalPengeluaranBulanan' => $totalPengeluaranBulanan,
            'sisaAnggaran' => $sisaAnggaran,
            'persentaseAnggaran' => $persentaseAnggaran
        ];

        return view('pengeluaran/index', $data);
    }
    
// Menampilkan halaman khusus daftar pengeluaran
public function daftar()
{
    $userId = session()->get('user_id');

    $tanggalMulai = $this->request->getGet('tanggal_mulai');
    $tanggalSelesai = $this->request->getGet('tanggal_selesai');
    $kategoriFilter = $this->request->getGet('kategori');
    $keyword = $this->request->getGet('keyword');

    $builder = $this->pengeluaranModel->builder();
    $builder->where('user_id', $userId);

    if (!empty($tanggalMulai)) {
        $builder->where('tanggal >=', $tanggalMulai);
    }

    if (!empty($tanggalSelesai)) {
        $builder->where('tanggal <=', $tanggalSelesai);
    }

    if (!empty($kategoriFilter)) {
        $builder->where('kategori', $kategoriFilter);
    }

    if (!empty($keyword)) {
        $builder->like('keterangan', $keyword);
    }

    $dataPengeluaran = $builder
        ->orderBy('tanggal', 'DESC')
        ->get()
        ->getResultArray();

    $semuaKategori = $this->pengeluaranModel
        ->distinct()
        ->select('kategori')
        ->where('user_id', $userId)
        ->findAll();

    $daftarKategori = array_column($semuaKategori, 'kategori');

    return view('pengeluaran/daftar', [
        'title' => 'Daftar Pengeluaran',
        'pengeluaran' => $dataPengeluaran,
        'daftarKategori' => $daftarKategori,
        'tanggalMulai' => $tanggalMulai,
        'tanggalSelesai' => $tanggalSelesai,
        'kategoriFilter' => $kategoriFilter,
        'keyword' => $keyword
    ]);
}

    // Menampilkan form tambah pengeluaran
    public function create()
    {
        return view('pengeluaran/create', [
            'title' => 'Tambah Pengeluaran'
        ]);
    }

    // Menyimpan pengeluaran baru
    public function store()
    {
        $userId = session()->get('user_id');

        $data = [
            'user_id' => $userId,
            'tanggal' => $this->request->getPost('tanggal'),
            'kategori' => $this->request->getPost('kategori'),
            'keterangan' => $this->request->getPost('keterangan'),
            'jumlah' => $this->request->getPost('jumlah')
        ];

        if (
            empty($data['tanggal']) ||
            empty($data['kategori']) ||
            !is_numeric($data['jumlah']) ||
            $data['jumlah'] <= 0
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Data pengeluaran tidak valid.');
        }

        $this->pengeluaranModel->insert($data);

        return redirect()->to('/pengeluaran')
            ->with('success', 'Pengeluaran berhasil ditambahkan!');
    }

    // Menampilkan form edit milik pengguna
    public function edit($id)
    {
        $userId = session()->get('user_id');

        $item = $this->pengeluaranModel
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$item) {
            return redirect()->to('/pengeluaran')
                ->with('error', 'Data pengeluaran tidak ditemukan.');
        }

        return view('pengeluaran/edit', [
            'title' => 'Edit Pengeluaran',
            'item' => $item
        ]);
    }

    // Memperbarui pengeluaran milik pengguna
    public function update($id)
    {
        $userId = session()->get('user_id');

        $item = $this->pengeluaranModel
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$item) {
            return redirect()->to('/pengeluaran')
                ->with('error', 'Data pengeluaran tidak ditemukan.');
        }

        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'kategori' => $this->request->getPost('kategori'),
            'keterangan' => $this->request->getPost('keterangan'),
            'jumlah' => $this->request->getPost('jumlah')
        ];

        if (
            empty($data['tanggal']) ||
            empty($data['kategori']) ||
            !is_numeric($data['jumlah']) ||
            $data['jumlah'] <= 0
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Data pengeluaran tidak valid.');
        }

        $this->pengeluaranModel->update($id, $data);

        return redirect()->to('/pengeluaran')
            ->with('success', 'Pengeluaran berhasil diperbarui!');
    }

    // Menghapus pengeluaran milik pengguna
    public function delete($id)
    {
        $userId = session()->get('user_id');

        $item = $this->pengeluaranModel
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$item) {
            return redirect()->to('/pengeluaran')
                ->with('error', 'Data pengeluaran tidak ditemukan.');
        }

        $this->pengeluaranModel->delete($id);

        return redirect()->to('/pengeluaran')
            ->with('success', 'Pengeluaran berhasil dihapus!');
    }
}
