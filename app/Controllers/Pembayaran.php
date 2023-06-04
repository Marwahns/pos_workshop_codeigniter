<?php

namespace App\Controllers;

use App\Database\Migrations\Pelanggan;
use App\Models\SparepartsModel;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\PelangganModel;
use App\Models\PenjualanModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pembayaran extends BaseController
{
    protected $request;
    protected $session;

    protected $prod_model;
    protected $data;
    protected $tran_model;
    protected $tran_item_model;
    protected $pelanggan;
    protected $penjualanModel;
    protected $productModel;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->prod_model = new SparepartsModel();
        $this->tran_model = new Transaction();
        $this->tran_item_model = new TransactionItem();
        $this->pelanggan = new PelangganModel();
        $this->penjualanModel = new PenjualanModel();
        $this->productModel = new SparepartsModel();
        $this->data = ['session' => $this->session, 'request' => $this->request];
    }

    public function index()
    {
        $this->data['title'] =  'Bengkel ABC | Penjualan';
        $this->data['products'] =  $this->prod_model->findAll();
        $this->data['pelanggan'] = $this->pelanggan->detailPelanggan();
        $this->data['invoice'] = $this->tran_model->invoice();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('penjualan/index_ori');
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

        $data['code'] = $this->tran_model->invoice();
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
                $data2['ip_address'] = $this->request->getIPAddress();
                $this->tran_item_model->save($data2);
            }
            $this->data['penjualan'] = $this->productModel->set('stok', 'stok-' . $data2['quantity'], false)->where('id', $data2['product_id'])->update();
            $this->session->setFlashdata('main_success', "Transaction has been saved successfully.");

            $this->data['items'] = $this->tran_item_model
                ->select('transaction_items.price, transaction_items.quantity, 
                                transactions.code, transactions.customer, transactions.total_amount, transactions.tendered, transactions.created_at, 
                                tb_spareparts.spareparts')
                ->join('tb_spareparts', " transaction_items.product_id = tb_spareparts.id ", 'inner')
                ->join('transactions', 'transactions.id=transaction_items.transaction_id')
                ->where('transaction_id', $transaction_id)
                ->findAll();
            return view('penjualan/cetak_termal', $this->data);
        }
    }

    public function invoice()
    {
        $this->data['title'] =  'Bengkel ABC | Daftar Penjualan';
        $this->data['total'] =  $this->tran_model->countAllResults();
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['transactions'] = $this->tran_model
            ->select(" transactions.*, COALESCE((SELECT SUM(transaction_items.quantity) FROM transaction_items where transaction_id = transactions.id ), 0) as total_items")
            ->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['transactions']) ? count($this->data['transactions']) : 0;
        $this->data['products'] =  $this->prod_model->findAll();
        $this->data['pelanggan'] = $this->pelanggan->detailPelanggan();
        $this->data['invoice'] = $this->penjualanModel->invoice();
        $this->data['pager'] = $this->tran_model->pager;
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('penjualan/daftar_invoice', $this->data);
        echo view('partial/footer');
    }

    public function transactions()
    {
        $this->data['title'] = "Bengkel ABC | Transactions";
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->tran_model->countAllResults();
        $this->data['transactions'] = $this->tran_model
            ->select(" transactions.*, COALESCE((SELECT SUM(transaction_items.quantity) FROM transaction_items where transaction_id = transactions.id ), 0) as total_items")
            ->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['transactions']) ? count($this->data['transactions']) : 0;
        return view('pembayaran/invoice', $this->data);
    }

    public function transaction_delete($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('main_error', "Transaction Deletion failed due to unknown ID.");
            return redirect()->to('pembayaran/transactions');
        }
        $delete = $this->tran_model->where('id', $id)->delete();
        if ($delete) {
            $this->session->setFlashdata('main_success', "Transaction has been deleted successfully.");
        } else {
            $this->session->setFlashdata('main_error', "Transaction Deletion failed due to unknown ID.");
        }
        return redirect()->to('pembayaran/transactions');
    }
    public function transaction_view($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('main_error', "Transaction Details failed to load due to unknown ID.");
            return redirect()->to('pembayaran/transactions');
        }
        $this->data['title'] = "Bengkel ABC | Transactions";
        $this->data['details'] = $this->tran_model->where('id', $id)->first();
        if (!$this->data['details']) {
            $this->session->setFlashdata('main_error', "Transaction Details failed to load due to unknown ID.");
            return redirect()->to('pembayaran/transactions');
        }
        $this->data['items'] = $this->tran_item_model
            ->select("transaction_items.*, CONCAT(tb_spareparts.kode_spareparts,'-',tb_spareparts.spareparts) as product")
            ->where('transaction_id', $id)
            ->join('tb_spareparts', " transaction_items.product_id = tb_spareparts.id ", 'inner')
            ->findAll();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('pos/view', $this->data);
        echo view('partial/footer');
    }

    public function cetak($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('main_error', "Transaction Details failed to load due to unknown ID.");
            return redirect()->to('pembayaran/transactions');
        }
        $this->data['title'] = "Bengkel ABC | Print Transactions";
        $this->data['details'] = $this->tran_model->where('id', $id)->first();
        if (!$this->data['details']) {
            $this->session->setFlashdata('main_error', "Transaction Details failed to load due to unknown ID.");
            return redirect()->to('pembayaran/transactions');
        }
        $this->data['items'] = $this->tran_item_model
            ->select('transaction_items.price, transaction_items.quantity, 
                                transactions.code, transactions.customer, transactions.total_amount, transactions.tendered, transactions.created_at, 
                                tb_spareparts.spareparts')
            ->join('tb_spareparts', " transaction_items.product_id = tb_spareparts.id ", 'inner')
            ->join('transactions', 'transactions.id=transaction_items.transaction_id')
            ->where('transaction_id', $id)
            ->findAll();
        echo view('penjualan/cetak_termal', $this->data);
    }

    ######################################## Download Spreadhsheet ########################################
    public function download()
    {
        // Instansiasi Spreadsheet
        $spreadsheet = new Spreadsheet();
        // styling
        $style = [
            'font'      => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($style); // tambahkan style
        $spreadsheet->getActiveSheet()->getRowDimension(1)->setRowHeight(30); // setting tinggi baris
        // setting lebar kolom otomatis
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        // $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        // set kolom head
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Invoice')
            ->setCellValue('C1', 'Tanggal')
            // ->setCellValue('D1', 'Spare Parts')
            ->setCellValue('D1', 'Kasir')
            ->setCellValue('E1', 'Qty')
            ->setCellValue('F1', 'Total Belanja')
            ->setCellValue('G1', 'Tunai');
        $row = 2;
        // looping data item
        foreach ($this->tran_item_model->detailTransaksi() as $key => $data) {
            $spreadsheet->getActiveSheet()
                ->setCellValue('A' . $row, $key + 1)
                ->setCellValue('B' . $row, $data->code)
                ->setCellValue('C' . $row, $data->created_at)
                ->setCellValue('B' . $row, $data->kode_spareparts . '-' . $data->spareparts)
                // ->setCellValue('D' . $row, $data->customer)
                ->setCellValue('D' . $row, $data->price)
                ->setCellValue('E' . $row, $data->quantity)
                ->setCellValue('F' . $row, $data->total_amount)
                ->setCellValue('G' . $row, $data->tendered);
            $row++;
        }
        // tulis dalam format .xlsx
        $writer   = new Xlsx($spreadsheet);
        $namaFile = 'Daftar_invoice_' . date('d-m-Y');
        // Redirect hasil generate xlsx ke web browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $namaFile . '.xlsx');
        $writer->save('php://output');
        exit;
    }
}
