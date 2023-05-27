<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model{
    //Table
    protected $table = 'tb_supplier';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'kode_supplier', 
        'nama',
        'alamat', 
        'no_telepon'
    ];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    ######################################## Generate Barcode Supplier ########################################
    function generateKodeSupplier() {
		$builder = $this->db->table('tb_supplier');
		$query = $builder->get();  
		$query = $builder->select('RIGHT(kode_supplier,4) as kode_supplier');
		$queryId = $builder->select('max(id)');
		$builder->orderBy('kode_supplier', "DESC");
		$builder->limit(1);
		$query   = $builder->get();
        $queryId = $builder->get();

        if($queryId->getNumRows() != 0) {
            $data       = $queryId->getLastRow(); // ambil satu baris data terakhir
            $kodeSupplier  = intval($data->id) + 1;
        }else{
            $builder = $this->db->query('alter table tb_supplier AUTO_INCREMENT = 1');
            $builder = $this->db->table('tb_supplier');
            $queryFirst = $builder->select('max(id)');
            $queryFirst->orderBy('kode_supplier', "DESC");
            $queryFirst->limit(1);
            $queryFirst = $builder->get();
            $kodeSupplier  = $queryFirst->id + 1; 
        }

        $lastKode = str_pad($kodeSupplier, 2, "0", STR_PAD_LEFT);
        // $tahun    = date("Y");
        $supplier      = "SPL";

		$newKode  = $supplier.$lastKode;

        return $newKode; 

   }

   ######################################## Search Supplier ########################################
   public function search($keyword)
   {
    return $this->table('tb_supplier')->like('nama', $keyword);
   }

   ######################################## Detail Supplier ########################################
   public function detailSupplier($id = null)
   {
       $builder = $this->builder($this->table)->select('*');
       if (empty($id)) {
           return $builder->get()->getResult(); // tampilkan semua data
       } else {
           // tampilkan data sesuai id/barcode
           return $builder->where('tb_kategori.id', $id)->orWhere('kode_kategori', $id)->get(1)->getRow();
       }
   }

}