<?php

namespace App\Models;

use CodeIgniter\Model;

class StokModel extends Model
{
    protected $table      = 'tb_stok';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'tipe',
        'spareparts_id',
        'supplier_id',
        'jumlah',
        'keterangan',
        'ip_address'
    ];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    ######################################## Detail Stok Masuk ########################################
    public function detailStokMasuk($id = null)
    {
        $builder = $this->builder($this->table)->select('tb_stok.id, tb_stok.supplier_id, tb_stok.jumlah, tb_stok.keterangan, tb_stok.tipe, tb_stok.ip_address, tb_stok.created_at, tb_spareparts.kode_spareparts As kode_spareparts, tb_spareparts.spareparts, tb_spareparts.harga, tb_spareparts.stok, tb_supplier.nama, tb_kategori.kategori')
            ->join('tb_spareparts', 'tb_spareparts.id = tb_stok.spareparts_id')
            ->join('tb_kategori', 'tb_kategori.id = tb_spareparts.kategori_id')
            ->join('tb_supplier', 'tb_supplier.id = tb_stok.supplier_id')
            ->where('tipe', 'masuk')
            ->where('tb_stok.deleted_at IS NULL'); // Menambahkan kondisi untuk deleted_at
        if (empty($id)) {
            return $builder->get()->getResult(); // tampilkan semua data
        } else {
            // tampilkan data sesuai id/barcode
            return $builder->where('tb_stok.id', $id)->orWhere('tb_spareparts.kode_spareparts', $id)->get(1)->getRow();
        }
    }

    ######################################## Detail Stok Keluar ########################################
    public function detailStokKeluar($id = null)
    {
        $builder = $this->builder($this->table)->select('tb_stok.id, tb_stok.supplier_id, tb_stok.jumlah, tb_stok.keterangan, tb_stok.tipe, tb_stok.ip_address, tb_stok.spareparts_id, tb_stok.created_at, tb_spareparts.id As idSpareparts, tb_spareparts.kode_spareparts, tb_spareparts.spareparts, tb_spareparts.harga, tb_spareparts.stok, tb_supplier.nama, tb_kategori.kategori')
            ->join('tb_spareparts', 'tb_spareparts.id = tb_stok.spareparts_id')
            ->join('tb_kategori', 'tb_kategori.id = tb_spareparts.kategori_id')
            ->join('tb_supplier', 'tb_supplier.id = tb_stok.supplier_id')
            ->where('tipe', 'keluar')
            ->where('tb_stok.deleted_at IS NULL'); 
        if (empty($id)) {
            return $builder->get()->getResult(); // tampilkan semua data
        } else {
            // tampilkan data sesuai id/barcode
            return $builder->where('tb_stok.id', $id)->orWhere('tb_spareparts.kode_spareparts', $id)->get(1)->getRow();
        }
    }

    ######################################## Simpan Transaksi ########################################
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

    ######################################## Get All Stok ########################################
    function getAll()
    {
        $builder = $this->db->table('tb_stok')->select('*')->where('tb_supplier.deleted_at IS NULL');
        $builder->join('tb_supplier', 'tb_supplier.id=tb_stok.supplier_id');
        $query = $builder->get();
        return $query->getResult();
    }

    ######################################## Update Otomatis Stok in Table Spareparts ########################################
    function stok_bertambah($post = null)
    {
        return $this->db->table('tb_spareparts')->set('stok', 'stok+' . $post['jumlah'], false)->where('id', $post['spareparts_id'])->update();
    }

    function stok_berkurang($post = null)
    {
        return $this->db->table('tb_spareparts')->set('stok', 'stok-' . $post['jumlah'], false)->where('id', $post['spareparts_id'])->update();
    }
}
