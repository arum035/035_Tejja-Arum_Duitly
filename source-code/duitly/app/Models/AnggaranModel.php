<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggaranModel extends Model
{
    protected $table            = 'anggaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';

    
protected $allowedFields = [
    'bulan',
    'tahun',
    'jumlah_anggaran',
    'user_id'
];


    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}