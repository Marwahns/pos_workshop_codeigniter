<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table      = 'tb_penjualan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 
        'pelanggan_id', 
        'invoice',
        'total_harga',
        'diskon',
        'total_akhir',
        'tunai',
        'kembalian',
        'catatan',
        'tanggal',
    ];

    // protected $useTimestamps = true;

    public function invoice()
    {
        // ambil invoice terakhir sesuai tanggal hari ini
        $builder = $this->builder($this->table)->selectMax('invoice')->where('tanggal', date('Y-m-d'))->get(1)->getRow();
        // buat format invoice baru
        if (empty($builder->invoice)) {
            $no = '0001';
        } else {
            $data = substr($builder->invoice, -4); // ambil 4 angka ke belakang
            $angka = ((int) $data) + 1;
            $no = sprintf("%'.04d", $angka);
        }
        return "INV" . date('ymd') . $no;
    }

    public function simpanPenjualan(array $post)
    {
        $produk = new Model();
        $transaksi = new TransaksiModel();

        $db = \Config\Database::connect();
        $db->transBegin();
        $this->save($post); // simpan transaksi ke tabel penjualan
        $penjualan_id = $this->insertID; // mengambil id penjualan
        $keranjang = session('keranjang'); // menampung session keranjang
        $data = [];
        foreach ($keranjang as $val) {
            $itemTransaksi = [
                'penjualan_id'  => $penjualan_id,
                'spareparts_id' => $val['id'],
                'harga_produk'  => $val['harga'],
                'jumlah_produk' => $val['jumlah'],
                'diskon_produk' => $val['diskon'],
                'subtotal'      => $val['total'],
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s"),
            ];
            array_push($data, $itemTransaksi); // masukan item transaksi ke variabel $data
            // update stok item sesuai idnya
            $produk->set('stok', 'stok-'.$val['jumlah'], false);
            $produk->where('id', $val['id']);
            $produk->update();
        }
        $transaksi->insertBatch($data); // tambahkan ke tabel transaksi

        if ($db->transStatus() === FALSE)
        {
            $db->transRollback();
            return ['status' => false];
        } else {
            // kosongkang keranjang
            unset($_SESSION['keranjang']);
            return ['status' => $db->transCommit(), 'id' => $penjualan_id];
        }
    }

    public function laporanPenjualan($tahun)
    {
        return $this->builder('tb_bulan_tahun')->select('bulan')->selectCount('jumlah_item', 'total')->join('tb_transaksi', 'date_format(created_at, "%m-%Y") = bulan_tahun', 'left')->where('tahun', $tahun)->groupBy('bulan_tahun')->get()->getResult();
    }

}
