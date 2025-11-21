<?php

namespace App\Controllers;

use App\Models\ModelSpj;

class Spj extends BaseController
{
    private function requireStaff()
    {
        // wajib login
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // hanya role staff
        if (session()->get('role') !== 'staff') {
            return redirect()->to('/'); // atau ke nzr_admin, terserah kamu
        }

        return null;
    }

    // FORM INPUT SPJ
    public function create()
    {
        if ($resp = $this->requireStaff()) return $resp;

        $data = [
            'judul'     => 'Input SPJ',
            'sub_judul' => 'Upload file SPJ (Word)',
        ];

        return view('spj/create', $data);
        // kalau kamu gak pakai $this->identitas(), pakai $data saja
    }

    // PROSES SIMPAN
    public function store()
    {
        if ($resp = $this->requireStaff()) return $resp;

        $namaSpj = $this->request->getPost('nama_spj');
        $file    = $this->request->getFile('file_spj');

        // cek input
        if (empty($namaSpj) || ! $file || ! $file->isValid()) {
            session()->setFlashdata('error', 'Nama SPJ dan file wajib diisi.');
            return redirect()->back()->withInput();
        }

        // hanya boleh .doc / .docx
        $ext = strtolower($file->getExtension());
        if (! in_array($ext, ['doc', 'docx'])) {
            session()->setFlashdata('error', 'File harus berformat .doc atau .docx.');
            return redirect()->back()->withInput();
        }

        // folder simpan file
        $targetDir = WRITEPATH . 'uploads/spj';
        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0775, true);
        }

        // nama random biar aman
        $newName = $file->getRandomName();
        $file->move($targetDir, $newName);

        // simpan ke DB
        $spjModel = new ModelSpj();
        $spjModel->insert([
            'id_user'  => session()->get('user_id'),
            'nama_spj' => $namaSpj,
            'file_spj' => $newName,
            'status'   => 'menunggu', // default
        ]);

        session()->setFlashdata('success', 'SPJ berhasil diupload.');
        return redirect()->to('/spj/list');
    }

    // LIST SPJ PUNYA STAFF INI
    public function list()
    {
        if ($resp = $this->requireStaff()) return $resp;

        $spjModel = new ModelSpj();
        $dataSpj  = $spjModel
            ->where('id_user', session()->get('user_id'))
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data = [
            'judul'     => 'Status SPJ',
            'sub_judul' => 'Daftar SPJ yang kamu upload',
            'spj'       => $dataSpj,
        ];

        return view('spj/list', $data);
    }
}
