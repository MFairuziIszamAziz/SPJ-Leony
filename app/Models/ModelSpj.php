<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSpj extends Model
{
    protected $table      = 't_spj';
    protected $primaryKey = 'id_spj';

    protected $allowedFields = [
        'id_user',
        'nama_spj',
        'file_spj',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
