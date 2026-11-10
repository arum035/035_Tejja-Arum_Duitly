<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profil extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        return view('profil/index', [
            'user' => $user
        ]);
    }

    // Memperbarui nama dan email profil
    public function update()
    {
        $userId = session()->get('user_id');

        $nama = trim($this->request->getPost('nama'));
        $email = trim($this->request->getPost('email'));

        if (empty($nama) || empty($email)) {
            return redirect()->to('/profil')
                ->with('error', 'Nama dan email wajib diisi.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->to('/profil')
                ->with('error', 'Format email tidak valid.');
        }

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        // Memeriksa apakah email sudah digunakan akun lain
        $emailLain = $userModel
            ->where('email', $email)
            ->where('id !=', $userId)
            ->first();

        if ($emailLain) {
            return redirect()->to('/profil')
                ->with('error', 'Email sudah digunakan akun lain.');
        }

        $userModel->update($userId, [
            'nama' => $nama,
            'email' => $email
        ]);

        return redirect()->to('/profil')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    // Mengganti password akun
    public function updatePassword()
    {
        $userId = session()->get('user_id');

        $passwordLama = $this->request->getPost('password_lama');
        $passwordBaru = $this->request->getPost('password_baru');
        $konfirmasiPassword = $this->request->getPost('konfirmasi_password');

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        // Memeriksa password lama
        if (!password_verify($passwordLama, $user['password'])) {
            return redirect()->to('/profil')
                ->with('error_password', 'Password lama yang Anda masukkan salah.');
        }

        // Memeriksa panjang password baru
        if (strlen($passwordBaru) < 8) {
            return redirect()->to('/profil')
                ->with('error_password', 'Password baru minimal 8 karakter.');
        }

        // Memeriksa konfirmasi password
        if ($passwordBaru !== $konfirmasiPassword) {
            return redirect()->to('/profil')
                ->with('error_password', 'Konfirmasi password tidak cocok.');
        }

        // Menyimpan password baru dalam bentuk hash
        $userModel->update($userId, [
            'password' => password_hash($passwordBaru, PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/profil')
            ->with('success_password', 'Password berhasil diperbarui.');
    }
}
