<?php

namespace App\Controllers;

use App\Libraries\Keranjang;
use App\Models\KeranjangModel;
use App\Models\PelangganModel;
use App\Models\PenjualanModel;
use App\Models\SparepartsModel;
use App\Models\TransaksiModel;
use Irsyadulibad\DataTables\DataTables;

class Penjualan extends BaseController
{
    // Session
    protected $session;
    // Data
    protected $data;
    // Model
    protected $pelangganModel;
    protected $keranjangModel;
    protected $penjualanModel;
    protected $transaksi;
    protected $SpareParts_model;

    public function __construct()
    {
        $this->pelangganModel = new PelangganModel();
        $this->penjualanModel = new PenjualanModel();
        $this->transaksi      = new TransaksiModel();
        $this->keranjangModel = new KeranjangModel();
        $this->SpareParts_model = new SparepartsModel();
        $this->session = \Config\Services::session();
        $this->data['session'] = $this->session;
        helper('form');
    }
    public function index()
    {
        $data = [
            'title'     => 'Input Penjualan',
            'pelanggan' => $this->pelangganModel->detailPelanggan(),
            'produk' => $this->SpareParts_model->detailProduk(),
            'tb_spareparts' => $this->SpareParts_model->detailProduk()
        ];
        echo view('partial/header', $data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('penjualan/index', $data);
        echo view('partial/footer');
    }

    public function cekStok()
    {
        $barcode = $this->request->getGet('barcode');
        $respon  = $this->keranjangModel->cekStokProduk($barcode);

        return $this->response->setJSON($respon);
    }

    public function tambah()
    {
        if ($this->request->getMethod() == 'post') {
            $id   = $this->request->getPost('spareparts_id', FILTER_SANITIZE_NUMBER_INT);
            $item = [
                'id'      => $id,
                'barcode'            => $this->request->getPost('barcode', FILTER_SANITIZE_STRING),
                'nama'               => $this->request->getPost('nama', FILTER_SANITIZE_STRING),
                'harga'              => $this->request->getPost('harga', FILTER_SANITIZE_NUMBER_INT),
                'jumlah'             => $this->request->getPost('jumlah', FILTER_SANITIZE_NUMBER_INT),
                'stok'               => $this->request->getPost('stok', FILTER_SANITIZE_NUMBER_INT),
            ];
            $hasil = Keranjang::tambah($id, $item); // masukan item ke keranjang
            if ($hasil == 'error') {
                $respon = [
                    'status' => false,
                    'pesan'  => 'Item yang ditambahkan melebihi stok',
                ];
            } else {
                $respon = [
                    'status' => true,
                    'pesan'  => 'Item berhasil ditambahkan ke keranjang.',
                ];
            }

            return $this->response->setJSON($respon);
        }
    }

    public function ubah()
    {
        if ($this->request->getMethod() == 'post') {
            $id   = $this->request->getPost('item_id', FILTER_SANITIZE_NUMBER_INT);
            $item = [
                'jumlah' => $this->request->getPost('item_jumlah', FILTER_SANITIZE_NUMBER_INT),
                'diskon' => $this->request->getPost('item_diskon', FILTER_SANITIZE_NUMBER_INT),
                'total'  => $this->request->getPost('harga_setelah_diskon', FILTER_SANITIZE_NUMBER_INT),
            ];
            Keranjang::ubah($id, $item); // masukan item ke keranjang
            $respon = [
                'pesan' => 'Item berhasil diubah.',
            ];

            return $this->response->setJSON($respon);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $iditem = $this->request->getPost('iditem', FILTER_SANITIZE_NUMBER_INT);
            if (empty($iditem)) {
                // hapus session keranjang
                session()->remove('keranjang');
                $respon = [
                    'status' => true,
                    'pesan'  => 'Transaksi berhasil dibatalkan.',
                ];
            } else {
                $hapus = Keranjang::hapus($iditem);
                if ($hapus) {
                    $respon = [
                        'status' => true,
                        'pesan'  => 'Item berhasil dihapus dari keranjang.',
                    ];
                } else {
                    $respon = [
                        'status' => false,
                        'pesan'  => 'Gagal menghapus item dari keranjang',
                    ];
                }
            }

            return $this->response->setJSON($respon);
        }
    }

    public function bayar()
    {
        if ($this->request->getMethod() == 'post') {
            // tambahkan record ke tabel penjualan
            $tunai     = $this->request->getPost('tunai', FILTER_SANITIZE_NUMBER_INT);
            $kembalian = $this->request->getPost('kembalian', FILTER_SANITIZE_NUMBER_INT);
            $data      = [
                'invoice'      => $this->penjualanModel->invoice(),
                'pelanggan_id' => $this->request->getPost('pelanggan_id', FILTER_SANITIZE_NUMBER_INT),
                'total_harga'  => $this->request->getPost('subtotal', FILTER_SANITIZE_NUMBER_INT),
                'diskon'       => $this->request->getPost('diskon', FILTER_SANITIZE_NUMBER_INT),
                'total_akhir'  => $this->request->getPost('total_akhir', FILTER_SANITIZE_NUMBER_INT),
                'tunai'        => str_replace('.', '', $tunai),
                'kembalian'    => str_replace('.', '', $kembalian),
                'catatan'      => $this->request->getPost('catatan', FILTER_SANITIZE_STRING),
                'tanggal'      => $this->request->getPost('tanggal', FILTER_SANITIZE_STRING),
                'id_user'      => session('id'),
                'ip_address'   => $this->request->getIPAddress(),
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ];

            $result = $this->penjualanModel->simpanPenjualan($data);
            if ($result['status']) {
                $respon = [
                    'status'      => $result['status'],
                    'pesan'       => 'Transaksi berhasil.',
                    'idpenjualan' => $result['id'],
                ];
            } else {
                $respon = [
                    'status' => $result['status'],
                    'pesan'  => 'Transaksi gagal',
                ];
            }

            return $this->response->setJSON($respon);
        }
    }

    public function keranjang()
    {
        if ($this->request->isAJAX()) {
            $respon = [
                'invoice'   => $this->penjualanModel->invoice(),
                'keranjang' => Keranjang::keranjang(),
                'sub_total' => Keranjang::sub_total(),
            ];

            return $this->response->setJSON($respon);
        }
    }

    public function invoice()
    {
        // if ($this->request->isAJAX()) {
        //     return DataTables::use('tb_penjualan')->select('id, invoice, tanggal')->make();
        // } else if ($this->request->getMethod() == 'get') {
        //     $data = [
        //         'title' => 'Daftar Invoice',
        //     ];
        //     echo view('partial/header', $data);
        //     echo view('partial/top_menu');
        //     echo view('partial/side_menu');
        //     echo view('penjualan/daftar_invoice', $data);
        //     echo view('partial/footer');
        // }
        $this->data['page_title'] =  "Daftar Invoice";
        // $this->data['tb_transaksi'] =  $this->transaksi->detailTransaksi();
        $this->data['tb_transaksi'] =  $this->transaksi->orderBy('date(created_at)ASC')->select('*')->get()->getResult();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('penjualan/daftar_invoice', $this->data);
        echo view('partial/footer');
    }

    public function cetak($id)
    {
        $transaksi = $this->transaksi->detailTransaksi($id);
        // jika id penjualan tidak ditemukan redirect ke halaman invoice dan tampilkan error
        if (empty($transaksi)) {
            return redirect()->to('/penjualan/invoice')->with('pesan', 'Invoice tidak ditemukan');
        }
        echo view('penjualan/cetak_termal', ['transaksi' => $transaksi]);
    }

    public function addProduk(){

        $this->data['request'] = $this->request;

        $id_product     = $this->request->getVar('produk');
        $id_pelanggan   = $this->request->getVar('pelanggan');
        $jumlah         = $this->request->getVar('jumlah');

        $post = [
            // 'product_id'    => $id_product,
            'pelanggan_id'   => $id_pelanggan,
            'jumlah'        => $jumlah
        ];

        $this->penjualanModel->insert($post);
        return redirect()->to('penjualan')->withInput()->with('success', 'Berhasil Menambahkan Data');
    }

    public function buatFaktur(){
        // $tgl = $this->request->getPost('tanggal');
        // $this->data['getFaktur'] = $this->penjualanModel->createFaktur($tgl);
        // return $this->data;
        if ($this->request->isAJAX()) {
            $respon = [
                'invoice'   => $this->penjualanModel->invoice(),
                'keranjang' => Keranjang::keranjang(),
                'sub_total' => Keranjang::sub_total(),
            ];

            return $this->response->setJSON($respon);
        }
    }
}
