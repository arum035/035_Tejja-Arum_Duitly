<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    protected $table            = 'pengeluaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';

    protected $allowedFields = [
    'tanggal',
    'kategori',
    'keterangan',
    'jumlah',
    'user_id'
];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
