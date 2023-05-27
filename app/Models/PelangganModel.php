<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table      = 'tb_pelanggan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama', 
        'no_telepon', 
        'tipe'
    ];

    // protected $useTimestamps = true;

    public function detailPelanggan($id = null)
    {
        $builder = $this->builder($this->table)->select('id, nama, no_telepon, tipe');
        if (empty($id)) {
            return $builder->get()->getResult();
        } else {
            return $builder->where('id', $id)->get(1)->getRow();
        }
    }

}
