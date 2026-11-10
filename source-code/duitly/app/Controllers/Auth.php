<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }

    public function prosesRegister()
    {
        $userModel = new UserModel();

        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $konfirmasi = $this->request->getPost('konfirmasi_password');

        if ($password !== $konfirmasi) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Konfirmasi password tidak sesuai.');
        }

        if ($userModel->where('email', $email)->first()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email sudah terdaftar.');
        }

        $userModel->insert([
            'nama' => $nama,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/login')
            ->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function prosesLogin()
    {
        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email atau password salah.');
        }

        session()->set([
            'user_id' => $user['id'],
            'nama' => $user['nama'],
            'email' => $user['email'],
            'logged_in' => true
        ]);

        return redirect()->to('/pengeluaran');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')
            ->with('success', 'Anda berhasil logout.');
    }
}
