<?php

namespace App\Models;

use CodeIgniter\Model;

class SparepartsModel extends Model
{
    //Table
    protected $table = 'tb_spareparts';
    protected $primaryKey = 'id';
    //allowed friends to manage
    protected $allowedFields = ['supplier_id', 'kategori_id', 'kode_spareparts', 'spareparts', 'harga', 'stok'];

    function generateKodeSpareParts()
    {
        $builder = $this->db->table('tb_spareparts');
        $query = $builder->get();
        $query = $builder->select('RIGHT(kode_spareparts,4) as kode_spareparts');
        $queryId = $builder->select('max(id)');
        $builder->orderBy('kode_spareparts', "DESC");
        $builder->limit(1);
        $query   = $builder->get();
        $queryId = $builder->get();

        if ($queryId->getNumRows() != 0) {
            $data       = $queryId->getLastRow(); // ambil satu baris data terakhir
            $kodeSupplier  = intval($data->id) + 1;
        } else {
            $builder = $this->db->query('alter table tb_spareparts AUTO_INCREMENT = 1');
            $builder = $this->db->table('tb_spareparts');
            $queryFirst = $builder->select('max(id)');
            $queryFirst->orderBy('kode_spareparts', "DESC");
            $queryFirst->limit(1);
            $queryFirst = $builder->get();
            $kodeSupplier  = $queryFirst->id + 1;
        }

        $lastKode = str_pad($kodeSupplier, 2, "0", STR_PAD_LEFT);
        // $tahun    = date("Y");
        $supplier      = "SPR";

        $newKode  = $supplier . $lastKode;

        return $newKode;
    }

    public function detailItem($id = null)
    {
        $builder = $this->builder($this->table)->select('tb_spareparts.id AS id, kode_spareparts, spareparts AS spareparts, harga, stok, supplier_id, kategori_id AS kategori_id')
            ->join('tb_supplier', 'tb_supplier.id=tb_spareparts.supplier_id')
            ->join('tb_kategori', 'tb_kategori.id=tb_spareparts.kategori_id');
        if (empty($id)) {
            return $builder->get()->getResult(); // tampilkan semua data
        } else {
            // tampilkan data sesuai id/barcode
            return $builder->where('tb_spareparts.id', $id)->orWhere('kode_spareparts', $id)->get(1)->getRow();
        }
    }

    // Search produk
    public function cariProduk($keyword)
    {
        $builder = $this->builder($this->table);
        $query = $builder->select('kode_spareparts, spareparts');
        if (empty($keyword)) {
            $data = $query->get(10)->getResult();
        } else {
            $data = $query->like('kode_spareparts', $keyword)->orLike('spareparts', $keyword)->get()->getResult();
        }
        return $data;
    }

    // join table
    function getJoinToSupplier()
    {
        return $this->db->table('tb_spareparts')
            ->select('*')
            ->join('tb_supplier', 'tb_supplier.id=tb_spareparts.supplier_id')
            ->get()->getResultArray();
    }

    function getJoinToKategori()
    {
        return $this->db->table('tb_spareparts')
            ->select('*')
            ->join('tb_kategori', 'tb_kategori.id=tb_spareparts.kategori_id')
            ->get()->getResultArray();
    }

    function get_join()
    {
        $builder = $this->db->table('tb_spareparts');
        $builder->select('*');
        $builder->join('tb_supplier', 'tb_supplier.id=tb_spareparts.supplier_id');
        $builder->join('tb_kategori', 'tb_kategori.id=tb_spareparts.kategori_id');
        $query = $builder->get();
        return $query;
    }

    function search($keyword)
    {
        return $this->db->table('tb_spareparts')->like('spareparts', $keyword)->orderBy('spareparts', 'ASC')->limit(10)->get()->getResult();
    }
}
