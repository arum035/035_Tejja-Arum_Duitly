<?php

namespace App\Controllers;

use App\Models\AnggaranModel;

class Anggaran extends BaseController
{
    public function index()
    {
        $model = new AnggaranModel();

        // Mengambil ID pengguna yang sedang login
        $userId = session()->get('user_id');

        $bulan = date('n');
        $tahun = date('Y');

        // Mengambil anggaran milik pengguna
        $anggaran = $model
            ->where('user_id', $userId)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->first();

        $data = [
            'anggaran' => $anggaran,
            'bulan'    => $bulan,
            'tahun'    => $tahun
        ];

        return view('anggaran/index', $data);
    }

    public function simpan()
    {
        $model = new AnggaranModel();

        // Mengambil ID pengguna yang sedang login
        $userId = session()->get('user_id');

        $jumlah = $this->request->getPost('jumlah_anggaran');

        if (!is_numeric($jumlah) || $jumlah <= 0) {
            return redirect()->to('/anggaran')
                ->with('error', 'Masukkan jumlah anggaran yang valid.');
        }

        $bulan = date('n');
        $tahun = date('Y');

        // Memeriksa anggaran milik pengguna
        $anggaran = $model
            ->where('user_id', $userId)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->first();

        if ($anggaran) {
            // Memperbarui anggaran milik pengguna
            $model->update($anggaran['id'], [
                'jumlah_anggaran' => $jumlah
            ]);
        } else {
            // Menyimpan anggaran baru
            $model->insert([
                'user_id'         => $userId,
                'bulan'           => $bulan,
                'tahun'            => $tahun,
                'jumlah_anggaran' => $jumlah
            ]);
        }

        return redirect()->to('/anggaran')
            ->with('success', 'Anggaran bulanan berhasil disimpan.');
    }
}
