<?php

namespace App\Controllers;

use App\Models\ModelSpj;
use App\Models\ModelUser;

class SpjAdmin extends BaseController
{
    private function requireAdminOrVerifikator()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (! in_array(session()->get('role'), ['admin', 'verifikator'])) {
            return redirect()->to('/'); // atau lempar ke /nzr_admin, terserah
        }

        return null;
    }

    // LIST semua SPJ
    public function index()
    {
        if ($resp = $this->requireAdminOrVerifikator()) return $resp;

        $spjModel  = new ModelSpj();
        $userModel = new ModelUser();

        // ambil semua spj
        $spj = $spjModel->orderBy('created_at', 'DESC')->findAll();

        // join manual username biar bisa ditampilkan
        foreach ($spj as &$row) {
            $user = $userModel->find($row['id_user']);
            $row['username'] = $user['username'] ?? '-';
        }

        $data = $this->identitas([
            'judul'     => 'Verifikasi SPJ',
            'sub_judul' => 'Daftar SPJ dari Staff',
            'spj'       => $spj,
        ]);

        return view('admin/spj/index', $data);
    }

    // FORM verifikasi SPJ tertentu
    public function edit($id)
    {
        if ($resp = $this->requireAdminOrVerifikator()) return $resp;

        $spjModel  = new ModelSpj();
        $userModel = new ModelUser();

        $spj = $spjModel->find($id);
        if (! $spj) {
            session()->setFlashdata('error', 'Data SPJ tidak ditemukan.');
            return redirect()->to('/spj-admin');
        }

        $user = $userModel->find($spj['id_user']);
        $spj['username'] = $user['username'] ?? '-';

        $data = $this->identitas([
            'judul'     => 'Verifikasi SPJ',
            'sub_judul' => 'Form Verifikasi SPJ',
            'spj'       => $spj,
        ]);

        return view('admin/spj/edit', $data);
    }

    // SIMPAN hasil verifikasi
    public function update($id)
    {
        if ($resp = $this->requireAdminOrVerifikator()) return $resp;

        $status = $this->request->getPost('status');

        if (! in_array($status, ['menunggu', 'lengkap', 'belum lengkap'])) {
            session()->setFlashdata('error', 'Status tidak valid.');
            return redirect()->back();
        }

        $spjModel = new ModelSpj();
        $spj = $spjModel->find($id);

        if (! $spj) {
            session()->setFlashdata('error', 'Data SPJ tidak ditemukan.');
            return redirect()->to('/spj-admin');
        }

        $spjModel->update($id, [
            'status' => $status,
        ]);

        session()->setFlashdata('success', 'Status SPJ berhasil diperbarui.');
        return redirect()->to('/spj-admin');
    }
}
