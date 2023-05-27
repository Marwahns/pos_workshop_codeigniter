<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model {
    protected $table         = 'tb_keranjang';
    protected $primaryKey    = 'id_keranjang';
    protected $allowedFields = [
        'id_keranjang', 'spareparts_id', 'harga_produk', 'qty', 'diskon_produk', 'total', 'user_id', 'stok_produk'
    ];

    protected $afterInsert = ['updateStok'];

    protected $db;
    protected $builder;

    public function __construct() {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table($this->table);
    }

    public function getDataKeranjang($id = false) {
        // if ($id) {
        //     $this->builder->select('id_keranjang AS id, harga_produk AS harga, qty, diskon_item AS diskon, total, ip_address');
        //     $this->builder->where('id_item', $id);
        //     $this->builder->where('id_user', session('id'));
        //     return $this->builder->get()->getRowArray();
        // }

        // $this->builder->select('keranjang.id_keranjang AS id, keranjang.harga_produk AS harga, keranjang.qty, keranjang.diskon_item AS diskon, keranjang.total, keranjang.ip_address, item.id_item, item.barcode, item.nama_item AS item, item.stok');
        // $this->builder->join('item', 'item.id_item=keranjang.id_item');
        // $this->builder->where('id_user', session('id'));

        // return $this->builder->get()->getResultArray();
    }

    public function cekStokProduk($barcode) {
        return $this->builder('tb_spareparts')->select('stok')->where('kode_spareparts', $barcode)->get()->getRow();
    }

    public function hapusKeranjang($id = false) {
        if ($id) {
            return $this->builder->delete(['id_keranjang' => $id]);
        } else {
            return $this->builder->delete(['user_id' => session()->get('id')]);
        }
    }

    protected function updateStok(array $data) {
        $spareparts_model = new SparepartsModel();
        $cek_stok  = $spareparts_model->getItem($data['data']['spareparts_id']);
        $stok      = [
            'stok' => $cek_stok['stok'] - $data['data']['qty'],
        ];
        $spareparts_model->update($data['data']['spareparts_id'], $stok);

        return $data;
    }
}
