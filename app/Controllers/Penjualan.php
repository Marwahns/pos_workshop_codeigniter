<?php

namespace App\Controllers;

use App\Libraries\Keranjang;
use App\Models\KeranjangModel;
use App\Models\PelangganModel;
use App\Models\PenjualanModel;
use App\Models\SparepartsModel;
use App\Models\TransaksiModel;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Irsyadulibad\DataTables\DataTables;

class Penjualan extends BaseController
{
    protected $pelangganModel;
    protected $keranjangModel;
    protected $penjualanModel;
    protected $transaksi;
    protected $SpareParts_model;
    protected $tran_model;
    protected $tran_item_model;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->pelangganModel = new PelangganModel();
        $this->penjualanModel = new PenjualanModel();
        $this->transaksi      = new TransaksiModel();
        $this->keranjangModel = new KeranjangModel();
        $this->SpareParts_model = new SparepartsModel();

        $this->tran_model = new Transaction;
        $this->tran_item_model = new TransactionItem;
        $this->data = ['session' => $this->session,'request'=>$this->request];
        helper('form');
    }
    public function index()
    {
        // $data = [
        //     'title'     => 'Input Penjualan',
        //     'pelanggan' => $this->pelangganModel->detailPelanggan(),
        // ];
        $this->data['title'] =  'Input Penjualan';
        $this->data['products'] =  $this->SpareParts_model->detailProduk();
        $this->data['pelanggan'] = $this->pelangganModel->detailPelanggan();
        $this->data['invoice'] = $this->penjualanModel->invoice();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('penjualan/index_ori', $this->data);
        echo view('partial/footer');
    }

    public function cekStok()
    {
        // value di dalam getGet berasal dari data yg ada di ajax
        $barcode = $this->request->getGet('barcode');
        $respon  = $this->keranjangModel->cekStokProduk($barcode);

        return $this->response->setJSON($respon);
    }

    public function tambah()
    {
        if ($this->request->getMethod() == 'post') {
            $id   = $this->request->getPost('iditem', FILTER_SANITIZE_NUMBER_INT);
            $item = [
                'id'      => $id,
                'barcode' => $this->request->getPost('barcode', FILTER_SANITIZE_STRING),
                'nama'    => $this->request->getPost('nama', FILTER_SANITIZE_STRING),
                'harga'   => $this->request->getPost('harga', FILTER_SANITIZE_NUMBER_INT),
                'jumlah'  => $this->request->getPost('jumlah', FILTER_SANITIZE_NUMBER_INT),
                'stok'    => $this->request->getPost('stok', FILTER_SANITIZE_NUMBER_INT),
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
                'id_pelanggan' => $this->request->getPost('id_pelanggan', FILTER_SANITIZE_NUMBER_INT),
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
        if ($this->request->isAJAX()) {
            return DataTables::use('tb_penjualan')->select('id, invoice, tanggal')->make();
        } else if ($this->request->getMethod() == 'get') {
            $data = [
                'title' => 'Daftar Invoice',
            ];
            echo view('penjualan/daftar_invoice', $data);
        }
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

    ## Beda template
    public function pos()
    {
        $this->data['page_title'] = "New Transaction";
        $this->data['products'] =  $this->SpareParts_model->detailProduk();
        $this->data['pelanggan'] = $this->pelangganModel->detailPelanggan();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('penjualan/add', $this->data);
        echo view('partial/footer');
    }

    public function save_transaction()
    {
        extract($this->request->getPost());

        $pref = date("Ymd");
        $code = sprintf("%'.05d", 1);
        while (true) {
            if ($this->tran_model->where(" code = '{$pref}{$code}' ")->countAllResults() > 0) {
                $code = sprintf("%'.05d", ceil($code) + 1);
            } else {
                $code = $pref . $code;
                break;
            }
        }

        $data['code'] = $code;
        foreach ($this->request->getPost() as $k => $v) {
            if (!is_array($this->request->getPost($k)) && !in_array($k, ['id'])) {
                $data[$k] = htmlspecialchars($v);
            }
        }
        $save_transaction = $this->tran_model->save($data);
        if ($save_transaction) {
            $transaction_id = $this->tran_model->insertID();
            foreach ($product_id as $k => $v) {
                $data2['transaction_id'] = $transaction_id;
                $data2['product_id'] = $v;
                $data2['price'] = $price[$k];
                $data2['quantity'] = $quantity[$k];
                $this->tran_item_model->save($data2);
            }
            $this->session->setFlashdata('main_success', "Transaction has been saved successfully.");
            return redirect()->to('penjualan/pos');
        }
    }
    public function transactions()
    {
        $this->data['page_title'] = "Transactions";
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->tran_model->countAllResults();
        $this->data['transactions'] = $this->tran_model
            ->select(" transactions.*, COALESCE((SELECT SUM(transaction_items.quantity) FROM transaction_items where transaction_id = transactions.id ), 0) as total_items")
            ->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['transactions']) ? count($this->data['transactions']) : 0;
        $this->data['pager'] = $this->tran_model->pager;
        return view('pages/pos/list', $this->data);
    }

    public function transaction_delete($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('main_error', "Transaction Deletion failed due to unknown ID.");
            return redirect()->to('penjualan/transactions');
        }
        $delete = $this->tran_model->where('id', $id)->delete();
        if ($delete) {
            $this->session->setFlashdata('main_success', "Transaction has been deleted successfully.");
        } else {
            $this->session->setFlashdata('main_error', "Transaction Deletion failed due to unknown ID.");
        }
        return redirect()->to('penjualan/transactions');
    }
    public function transaction_view($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('main_error', "Transaction Details failed to load due to unknown ID.");
            return redirect()->to('penjualan/transactions');
        }
        $this->data['page_title'] = "Transactions";
        $this->data['details'] = $this->tran_model->where('id', $id)->first();
        if (!$this->data['details']) {
            $this->session->setFlashdata('main_error', "Transaction Details failed to load due to unknown ID.");
            return redirect()->to('penjualan/transactions');
        }
        $this->data['items'] = $this->tran_item_model
            ->select("transaction_items.*, CONCAT(tb_spareparts.kode_spareparts,'-',tb_spareparts.spareparts) as product")
            ->where('transaction_id', $id)
            ->join('tb_spareparts', " transaction_items.product_id = tb_spareparts.id ", 'inner')
            ->findAll();
        return view('pages/pos/view', $this->data);
    }
}
