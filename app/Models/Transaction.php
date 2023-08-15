<?php

namespace App\Models;

use CodeIgniter\Model;

class Transaction extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'transactions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'code', 'customer', 'total_amount', 'tendered', 'discount'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function invoice()
    {
        // // ambil invoice terakhir sesuai tanggal hari ini
        // $builder = $this->builder($this->table)->selectMax('code')->where('created_at', date('Y-m-d'))->get(1)->getRow();
        // // buat format invoice baru
        // if (empty($builder->invoice)) {
        //     $no = '0001';
        // } else {
        //     $data = substr($builder->invoice, -4); // ambil 4 angka ke belakang
        //     $angka = ((int) $data) + 1;
        //     $no = sprintf("%'.04d", $angka);
        // }
        // return "INV" . date('ymd') . $no;

        $builder = $this->db->table('transactions');
        $query = $builder->get();
        $query = $builder->select('RIGHT(code,4) as code');
        $queryId = $builder->select('max(id)');
        $builder->orderBy('code', "DESC");
        $builder->limit(1);
        $query   = $builder->get();
        $queryId = $builder->get();

        if ($queryId->getNumRows() != 0) {
            $data       = $queryId->getLastRow(); // ambil satu baris data terakhir
            $invoice  = intval($data->id) + 1;
        } else {
            $builder = $this->db->query('alter table transactions AUTO_INCREMENT = 1');
            $builder = $this->db->table('transactions');
            $queryFirst = $builder->select('max(id)');
            $queryFirst->orderBy('code', "DESC");
            $queryFirst->limit(1);
            $queryFirst = $builder->get();

            // print_r($queryFirst);
            // die();
            // $invoice  = $queryFirst->id + 1;
            $invoice = 1;
        }

        $lastKode = str_pad($invoice, 4, "0", STR_PAD_LEFT);
        $tahun    = date("ymd");
        $transaksi = "INV";

        $newKode  = $transaksi . $tahun . $lastKode;

        return $newKode;
    }

}
