<?php

namespace App\Controllers;

use App\Models\ModelSpj;
use App\Models\ModelUser;

class Pimpinan extends BaseController
{
    private function requirePimpinan()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session()->get('role') !== 'pimpinan') {
            return redirect()->to('/'); // atau ke route lain
        }

        return null;
    }

    public function index()
    {
        if ($resp = $this->requirePimpinan()) return $resp;

        $spjModel  = new ModelSpj();
        $userModel = new ModelUser();

        // total, menunggu, diverifikasi
        $total     = $spjModel->countAllResults();
        $menunggu  = $spjModel->where('status', 'menunggu')->countAllResults();
        $diverif   = $total - $menunggu;

        // ambil spj terbaru
        $spjTerbaru = $spjModel
            ->orderBy('created_at', 'DESC')
            ->findAll(20);

        foreach ($spjTerbaru as &$row) {
            $user = $userModel->find($row['id_user']);
            $row['username'] = $user['username'] ?? '-';
        }

        $data = $this->identitas([
            'judul'        => 'Dashboard Pimpinan',
            'sub_judul'    => 'Ringkasan Status SPJ',
            'total_spj'    => $total,
            'spj_menunggu' => $menunggu,
            'spj_verif'    => $diverif,
            'spj_terbaru'  => $spjTerbaru,
        ]);

        return view('pimpinan/index', $data);
    }
}
