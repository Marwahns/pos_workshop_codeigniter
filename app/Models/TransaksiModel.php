<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'tb_transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'penjualan_id',
        'spareparts_id',
        'harga_produk',
        'jumlah_produk',
        'diskon_produk',
        'subtotal'
    ];

    // protected $useTimestamps = true;
    public function detailTransaksi($id = null)
    {
        // if ($id) {
        //     return $this->builder($this->table)
        //         ->select(
        //         'harga_produk, jumlah_produk, diskon_produk, subtotal, 
        //         tb_penjualan.invoice, tb_penjualan.total_harga, tb_penjualan.diskon, tb_penjualan.total_akhir, tb_penjualan.tunai, tb_penjualan.kembalian, tb_penjualan.catatan, tb_penjualan.created_at, 
        // tb_spareparts.spareparts, 
        // tb_pelanggan.nama , 
        // tb_users.nama'
        //         )
        // ->join('tb_penjualan',  'tb_penjualan.id  = penjualan_id')
        // ->join('tb_spareparts', 'tb_spareparts.id = spareparts_id')
        // ->join('tb_pelanggan',  'tb_pelanggan.id  = pelanggan_id')
        // ->join('tb_users',      'tb_users.id      = user_id')
        //         ->where('id_penjualan', $id, true)
        //         ->get()->getResultArray();
        // }
        $builder = $this->builder($this->table)
            ->select('harga_produk, jumlah_produk, diskon_produk, subtotal, 
                    tb_penjualan.invoice, tb_penjualan.total_harga, tb_penjualan.diskon, tb_penjualan.total_akhir, tb_penjualan.tunai, tb_penjualan.kembalian, tb_penjualan.catatan, tb_penjualan.tanggal, 
                    tb_spareparts.spareparts, 
                    tb_pelanggan.nama As pelanggan , 
                    tb_users.nama As kasir')
            ->join('tb_penjualan',  'tb_penjualan.id  = penjualan_id')
            ->join('tb_spareparts', 'tb_spareparts.id = spareparts_id')
            ->join('tb_pelanggan',  'tb_pelanggan.id  = pelanggan_id')
            ->join('tb_users',      'tb_users.id      = user_id');
        if (empty($id)) {
            return $builder->get()->getResult(); // tampilkan semua data
        } else {
            // tampilkan data sesuai id/barcode
            return $builder->where('tb_transaksi.id', $id)->get()->getResultArray();
        }
    }
    
}
