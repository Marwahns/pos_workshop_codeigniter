<?php

namespace App\Controllers;

use App\Database\Migrations\Pelanggan;
use App\Models\SparepartsModel;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\PelangganModel;
use App\Models\PenjualanModel;

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

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->prod_model = new SparepartsModel();
        $this->tran_model = new Transaction();
        $this->tran_item_model = new TransactionItem();
        $this->pelanggan = new PelangganModel();
        $this->penjualanModel = new PenjualanModel();
        $this->data = ['session' => $this->session,'request'=>$this->request];
    }

    public function index()
    {
        $this->data['title'] =  'Input Penjualan';
        $this->data['products'] =  $this->prod_model->findAll();
        $this->data['pelanggan'] = $this->pelanggan->detailPelanggan();
        $this->data['invoice'] = $this->penjualanModel->invoice();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('penjualan/index_ori');
        echo view('partial/footer');
    }

    public function pos(){
        $this->data['page_title']="New Transaction";
        $this->data['products'] =  $this->prod_model->findAll();
     
        return view('pos/add', $this->data);
    }

    public function save_transaction(){
        extract($this->request->getPost());
        
        $pref = date("Ymd");
        $code = sprintf("%'.05d", 1);
        while(true){
            if($this->tran_model->where(" code = '{$pref}{$code}' ")->countAllResults() > 0){
                $code = sprintf("%'.05d", ceil($code) + 1);
            }else{
                $code = $pref.$code;
                break;
            }
        }

        $data['code'] = $code;
        foreach($this->request->getPost() as $k => $v){
            if(!is_array($this->request->getPost($k)) && !in_array($k, ['id'])){
                $data[$k] = htmlspecialchars($v);
            }
        }
        $save_transaction = $this->tran_model->save($data);
        if($save_transaction){
            $transaction_id = $this->tran_model->insertID();
            foreach($product_id as $k=>$v){
                $data2['transaction_id'] = $transaction_id;
                $data2['product_id'] = $v ;
                $data2['price'] = $price[$k];
                $data2['quantity'] = $quantity[$k];
                $this->tran_item_model->save($data2);
            }
            $this->session->setFlashdata('main_success',"Transaction has been saved successfully.");
            return redirect()->to('pembayaran/index');
        }
    }

    public function invoice()
    {
        $this->data['title'] =  'Daftar Penjualan';
        $this->data['total'] =  $this->tran_model->countAllResults();
        $this->data['transactions'] = $this->tran_model
                                    ->select(" transactions.*, COALESCE((SELECT SUM(transaction_items.quantity) FROM transaction_items where transaction_id = transactions.id ), 0) as total_items")
                                    ->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['transactions'])? count($this->data['transactions']) : 0;
        $this->data['products'] =  $this->prod_model->findAll();
        $this->data['pelanggan'] = $this->pelanggan->detailPelanggan();
        $this->data['invoice'] = $this->penjualanModel->invoice();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('penjualan/daftar_invoice', $this->data);
        echo view('partial/footer');
    }

    public function transactions(){
        $this->data['page_title']="Transactions";
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->tran_model->countAllResults();
        $this->data['transactions'] = $this->tran_model
                                    ->select(" transactions.*, COALESCE((SELECT SUM(transaction_items.quantity) FROM transaction_items where transaction_id = transactions.id ), 0) as total_items")
                                    ->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['transactions'])? count($this->data['transactions']) : 0;
        // $this->data['pager'] = $this->tran_model->pager;
        return view('pos/list', $this->data);
    }

    public function transaction_delete($id=''){
        if(empty($id)){
                $this->session->setFlashdata('main_error',"Transaction Deletion failed due to unknown ID.");
                return redirect()->to('pembayaran/transactions');
        }
        $delete = $this->tran_model->where('id', $id)->delete();
        if($delete){
            $this->session->setFlashdata('main_success',"Transaction has been deleted successfully.");
        }else{
            $this->session->setFlashdata('main_error',"Transaction Deletion failed due to unknown ID.");
        }
        return redirect()->to('pembayaran/transactions');
    }
    public function transaction_view($id=''){
        if(empty($id)){
            $this->session->setFlashdata('main_error',"Transaction Details failed to load due to unknown ID.");
            return redirect()->to('pembayaran/transactions');
        }
        $this->data['page_title']="Transactions";
        $this->data['details'] = $this->tran_model->where('id', $id)->first();
        if(!$this->data['details']){
            $this->session->setFlashdata('main_error',"Transaction Details failed to load due to unknown ID.");
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

    public function cetak($id='')
    {
        if(empty($id)){
            $this->session->setFlashdata('main_error',"Transaction Details failed to load due to unknown ID.");
            return redirect()->to('pembayaran/transactions');
        }
        $this->data['page_title']="Transactions";
        $this->data['details'] = $this->tran_model->where('id', $id)->first();
        if(!$this->data['details']){
            $this->session->setFlashdata('main_error',"Transaction Details failed to load due to unknown ID.");
            return redirect()->to('pembayaran/transactions');
        }
        $this->data['items'] = $this->tran_item_model
                                // ->select("transaction_items.*, CONCAT(tb_spareparts.kode_spareparts,'-',tb_spareparts.spareparts) as product")
                                ->select('transaction_items.price, transaction_items.quantity, 
                                transactions.code, transactions.customer, transactions.total_amount, transactions.tendered, transactions.created_at, 
                                tb_spareparts.spareparts')
                                ->join('tb_spareparts', " transaction_items.product_id = tb_spareparts.id ", 'inner')
                                ->join('transactions', 'transactions.id=transaction_items.transaction_id')
                                ->where('transaction_id', $id)
                                ->findAll();
        // echo view('partial/header', $this->data);
        // echo view('partial/top_menu');
        // echo view('partial/side_menu');
        echo view('penjualan/cetak_termal', $this->data);
        // echo view('pos/generatereceipt', $this->data);
        // echo view('partial/footer');
        
        // $transaksi = $this->tran_item_model->where('id', $id)->first();
        // // jika id penjualan tidak ditemukan redirect ke halaman invoice dan tampilkan error
        // if (empty($transaksi)) {
        //     return redirect()->to('/pembayaran/invoice')->with('pesan', 'Invoice tidak ditemukan');
        // }
        // echo view('penjualan/daftar_invoice');
    }

}