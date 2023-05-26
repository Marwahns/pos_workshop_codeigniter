<?php

namespace App\Models;

use CodeIgniter\Model;

class StokModel extends Model
{
    protected $table      = 'tb_stok';
    protected $primaryKey = 'id';
    // protected $useSoftDeletes = true;
    protected $allowedFields = ['tipe', 'spareparts_id', 'supplier_id', 'jumlah', 'keterangan', 'ip_address'];
    protected $useTimestamps = true;

    // join table
    function getJoinToSupplier()
    {
        return $this->db->table('tb_stok')
            ->join('tb_supplier', 'tb_supplier.id=tb_stok.supplier_id')
            ->get()->getResultArray();
    }

    function getJoinToSpareparts()
    {
        return $this->db->table('tb_stok')
            ->join('tb_spareparts', 'tb_spareparts.id=tb_stok.spareparts_id')
            ->get()->getResultArray();
    }

    function getJoinToKategori()
    {
        return $this->db->table('tb_stok')
            ->join('tb_kategori', 'tb_kategori.id=tb_stok.kategori_id')
            ->get()->getResultArray();
    }

    public function simpanTransaksi(array $data)
    {
        $db = \Config\Database::connect();
        $db->transBegin();
        $this->save($data); // simpan transaksi
        // proses update stok item
        if ($data['tipe'] == 'masuk') {
            // stok bertambah
            $db->table('tb_spareparts')->set('stok', 'stok+' . $data['jumlah'], false)->where('id', $data['spareparts_id'])->update();
        } else {
            // stok berkurang
            $db->table('tb_spareparts')->set('stok', 'stok-' . $data['jumlah'], false)->where('id', $data['spareparts_id'])->update();
        }

        if ($db->transStatus() === FALSE) {
            return $db->transRollback();
        } else {
            return $db->transCommit();
        }
    }

    function getAll()
    {
        $builder = $this->db->table('tb_stok')->select('*');
        $builder->join('tb_supplier', 'tb_supplier.id=tb_stok.supplier_id');
        $query = $builder->get();
        return $query->getResult();
    }
    
    function stok_bertambah($post=null)
    {
        return $this->db->table('tb_spareparts')->set('stok', 'stok+'.$post['jumlah'], false)->where('id', $post['spareparts_id'])->update();
    }

    function stok_berkurang($post=null)
    {
        return $this->db->table('tb_spareparts')->set('stok', 'stok-'.$post['jumlah'], false)->where('id', $post['spareparts_id'])->update();
    }
}
