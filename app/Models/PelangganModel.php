<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table      = 'tb_pelanggan';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'nama', 
        'no_telepon', 
        'tipe'
    ];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

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
