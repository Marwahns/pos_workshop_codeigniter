<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionItem extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'transaction_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
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
        $builder = $this->builder($this->table)
            ->select('transaction_items.price As price, transaction_items.quantity As quantity, 
            transactions.*, 
            IF(transactions.discount > 0, 
           (transactions.total_amount - transactions.total_amount * transactions.discount / 100),
           transactions.total_amount) As grand_total,
            tb_spareparts.spareparts As spareparts, tb_spareparts.kode_spareparts')
            ->join('tb_spareparts', " transaction_items.product_id = tb_spareparts.id ", 'inner')
            ->join('transactions', 'transactions.id=transaction_items.transaction_id')
            ->where('transaction_items.deleted_at IS NULL');
        if (empty($id)) {
            return $builder->get()->getResult(); // tampilkan semua data
        } else {
            // tampilkan data sesuai id/barcode
            return $builder->where('transaction_id', $id)->orWhere('transactions.code', $id)->get(1)->getRow();
        }
    }

    ######################################## Detail Produk ########################################
    // public function detailTransaksi($id = null)
    // {
    //     $builder = $this->builder($this->table)
    //         ->select('transaction_items.price As price, transaction_items.quantity As quantity, 
    //         transactions.code As code, transactions.customer As customer, transactions.total_amount As total_amount, transactions.tendered As tendered, transactions.created_at As created_at, 
    //         tb_spareparts.spareparts As spareparts')
    //         ->join('tb_spareparts', " transaction_items.product_id = tb_spareparts.id ", 'inner')
    //         ->join('transactions', 'transactions.id=transaction_items.transaction_id');
    //     if (empty($id)) {
    //         return $builder->get()->getResult(); // tampilkan semua data
    //     } else {
    //         // tampilkan data sesuai id/barcode
    //         return $builder->where('transaction_id.', $id)->orWhere('transactions.code', $id)->get(1)->getRow();
    //     }
    // }

    public function get_quantity()
    {
        $builder = $this->builder($this->table)->select('SUM(transaction_items.quantity)')->get();
        return $builder;
    }
}
