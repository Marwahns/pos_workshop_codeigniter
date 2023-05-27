<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model{
    //Table
    protected $table = 'tb_kategori';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'kode_kategori', 
        'kategori'
    ];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    ######################################## Generate Barcode Kategori ########################################
    function generateKodeKategori() {
		$builder = $this->db->table('tb_kategori');
		$query = $builder->get();  
		$query = $builder->select('RIGHT(kode_kategori,4) as kode_kategori');
		$queryId = $builder->select('max(id)');
		$builder->orderBy('kode_kategori', "DESC");
		$builder->limit(1);
		$query   = $builder->get();
        $queryId = $builder->get();

        if($queryId->getNumRows() != 0) {
            $data       = $queryId->getLastRow(); // ambil satu baris data terakhir
            $kodeSupplier  = intval($data->id) + 1;
        }else{
            $builder = $this->db->query('alter table tb_kategori AUTO_INCREMENT = 1');
            $builder = $this->db->table('tb_kategori');
            $queryFirst = $builder->select('max(id)');
            $queryFirst->orderBy('kode_kategori', "DESC");
            $queryFirst->limit(1);
            $queryFirst = $builder->get();
            $kodeSupplier  = $queryFirst->id + 1; 
        }

        $lastKode = str_pad($kodeSupplier, 2, "0", STR_PAD_LEFT);
        // $tahun    = date("Y");
        $supplier      = "KTG";

		$newKode  = $supplier.$lastKode;

        return $newKode; 
   }

   ######################################## Detail Kategori ########################################
   public function detailKategori($id = null)
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