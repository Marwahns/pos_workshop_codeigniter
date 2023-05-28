<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionItem extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'transaction_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['transaction_id', 'product_id', 'price', 'quantity'];

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

    ######################################## Detail Produk ########################################
    public function detailTransaksi($id = null)
    {
        $builder = $this->builder($this->table)->select(
            'transaction_items.price, transaction_items.quantity, 
            transactions.code, transactions.customer, transactions.total_amount, transactions.tendered, 
            tb_spareparts.spareparts'
        )

            ->join('tb_spareparts', 'tb_spareparts.id=transaction_items.product_id')
            ->join('transactions', 'transactions.id=transaction_items.transaction_id');
        if (empty($id)) {
            return $builder->get()->getResult(); // tampilkan semua data
        } else {
            // tampilkan data sesuai id/barcode
            return $builder->where('transaction_id', $id)->orWhere('transactions.code', $id)->get(1)->getRow();
        }
    }
}
