<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        // Kalau sudah login, langsung lempar ke halaman sesuai role
        if (session()->get('logged_in')) {
            return $this->redirectByRole(session()->get('role'));
        }

        $data = [
            'judul'      => 'Login',
            'sub_judul'  => 'Silakan masuk ke akun Anda',
        ];

        return view('login', $data);
    }

    public function auth()
    {
        if (! $this->request->getMethod('post')) {
        return redirect()->to('/login');
    }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi input sederhana
        if (empty($username) || empty($password)) {
            session()->setFlashdata('error', 'Username dan password harus diisi.');
            return redirect()->back()->withInput();
        }

        $modelUser = model('App\Models\ModelUser');

        // checkLogin di sini kita anggap sudah meng-handle cara cek password
        // (entah dia pakai md5, plain, atau password_verify)
        $user = $modelUser->checkLogin($username, $password);

        if (!$user) {
            session()->setFlashdata('error', 'Username atau password salah.');
            return redirect()->back()->withInput();
        }

        // =======================
        //  SET SESSION USER
        // =======================
        session()->set([
            'user_id'   => $user['id_user'],
            'username'  => $user['username'],
            'role'      => $user['role'],   // 'staff', 'verifikator', 'pimpinan'
            'logged_in' => true,
        ]);

        // Arahkan berdasarkan role
        return $this->redirectByRole($user['role']);
    }

    /**
     * Redirect user sesuai role, biar nggak if-else berantakan di mana-mana.
     */
    private function redirectByRole(string $role)
    {
        switch ($role) {
            case 'staff':
                // halaman input & list SPJ milik staff
                return redirect()->to('/pelaporan');      // misal Pelaporan::index

            case 'admin':
                // halaman verifikasi SPJ
                return redirect()->to('/nzr_admin/admin_home');        // misal Kuitansi::index

            case 'pimpinan':
                // halaman pimpinan lihat rekap/list SPJ
                return redirect()->to('/pimpinan');         // misal Pelaporan::rekap atau controller khusus

            default:
                // fallback kalau role-nya belum di-set rapi
                return redirect()->to('/home');
        }
    }

    public function logout()
    {
        session()->destroy();
        // kalau cookies() kepake, silakan; kalau error bisa dihapus baris ini
        // cookies()->clear();

        return redirect()->to('/login');
    }
}
