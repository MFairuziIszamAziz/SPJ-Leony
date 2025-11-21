<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class User extends BaseController
{
    /**
     * Hanya boleh diakses admin
     */
    private function requireAdmin()
    {
        if (! session()->get('logged_in') || ! session()->has('user_id')) {
            return redirect()->to('/login');
        }

        if (session()->get('role') !== 'admin') {
            return redirect()->to('/nzr_admin'); // atau lempar 404
        }

        return null;
    }

    // LIST USER
    public function index()
    {
        if ($resp = $this->requireAdmin()) return $resp;

        $userModel = new ModelUser();
        $users = $userModel->findAll();

        $data = [
            'judul'     => 'Data User',
            'sub_judul' => 'Daftar User',
            'users'     => $users,
        ];

        return view('user/index', $data);
    }

    // FORM TAMBAH
    public function create()
    {
        if ($resp = $this->requireAdmin()) return $resp;

        $data = [
            'judul'     => 'Tambah User',
            'sub_judul' => 'Form Tambah User',
        ];

        return view('user/create', $data);
    }

    // SIMPAN USER BARU
    public function store()
    {
        if ($resp = $this->requireAdmin()) return $resp;

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $role     = $this->request->getPost('role');

        if (empty($username) || empty($password) || empty($role)) {
            session()->setFlashdata('error', 'Username, password, dan role wajib diisi.');
            return redirect()->back()->withInput();
        }

        $userModel = new ModelUser();

        // CEK USERNAME DUPLIKAT
        if ($userModel->where('username', $username)->first()) {
            session()->setFlashdata('error', 'Username sudah dipakai.');
            return redirect()->back()->withInput();
        }

        // LOGIN LAMA PAKAI MD5 → samain
        $passwordHash = md5($password);

        $userModel->insert([
            'username'   => $username,
            'password'   => $passwordHash,
            'role'       => $role,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        session()->setFlashdata('success', 'User berhasil ditambahkan.');
        return redirect()->to('/user');
    }

    // FORM EDIT
    public function edit($id)
    {
        if ($resp = $this->requireAdmin()) return $resp;

        $userModel = new ModelUser();
        $user = $userModel->find($id);

        if (! $user) {
            session()->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to('/user');
        }

        $data = [
            'judul'     => 'Edit User',
            'sub_judul' => 'Form Edit User',
            'user'      => $user,
        ];

        return view('user/edit', $data);
    }

    // SIMPAN EDIT
    public function update($id)
    {
        if ($resp = $this->requireAdmin()) return $resp;

        $userModel = new ModelUser();
        $user = $userModel->find($id);

        if (! $user) {
            session()->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to('/user');
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password'); // boleh kosong
        $role     = $this->request->getPost('role');

        if (empty($username) || empty($role)) {
            session()->setFlashdata('error', 'Username dan role wajib diisi.');
            return redirect()->back()->withInput();
        }

        // Cek username duplikat (kecuali dirinya sendiri)
        $existing = $userModel->where('username', $username)
                              ->where('id_user !=', $id)
                              ->first();
        if ($existing) {
            session()->setFlashdata('error', 'Username sudah dipakai.');
            return redirect()->back()->withInput();
        }

        $dataUpdate = [
            'username'   => $username,
            'role'       => $role,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Kalau password diisi, update + md5
        if (! empty($password)) {
            $dataUpdate['password'] = md5($password);
        }

        $userModel->update($id, $dataUpdate);

        session()->setFlashdata('success', 'User berhasil diperbarui.');
        return redirect()->to('/user');
    }

    // HAPUS USER
    public function delete($id)
    {
        if ($resp = $this->requireAdmin()) return $resp;

        $userModel = new ModelUser();
        $user = $userModel->find($id);

        if (! $user) {
            session()->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to('/user');
        }

        // Opsional: jangan biarkan admin hapus dirinya sendiri
        if ((int)$id === (int)session()->get('user_id')) {
            session()->setFlashdata('error', 'Tidak bisa menghapus akun yang sedang digunakan.');
            return redirect()->to('/user');
        }

        $userModel->delete($id);

        session()->setFlashdata('success', 'User berhasil dihapus.');
        return redirect()->to('/user');
    }
}
