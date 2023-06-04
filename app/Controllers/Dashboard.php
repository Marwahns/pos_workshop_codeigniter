<?php
namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\SparepartsModel;
use App\Models\SupplierModel;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    // Data
    protected $data;
    // Model
    protected $spareParts_model;
    protected $supplier_model;
    protected $kategori_model;
    protected $transaksi_item_model;
    protected $transaksi_model;
    protected $auth_model;

    // Initialize Objects
    public function __construct()
    {
        $this->spareParts_model = new SparepartsModel();
        $this->supplier_model = new SupplierModel();
        $this->kategori_model = new KategoriModel();
        $this->transaksi_item_model = new TransactionItem();
        $this->transaksi_model = new Transaction();
        $this->auth_model = new UserModel();
    }

    public function index()
    {
        $data = [
            'title'                 => 'Dashboard',
            'spareParts'            => $this->spareParts_model->countAllResults(),
            'item'                  => $this->spareParts_model->selectSum('stok')->first(),
            'kategori'              => $this->kategori_model->countAllResults(),
            'supplier'              => $this->supplier_model->countAllResults(),
            'penjualan'             => $this->transaksi_model->countAllResults(),
            'penjualan_harian'      => $this->transaksi_model->selectCount('id')->where('DATE(created_at) = DATE(NOW())')->first(),
            'penjualan_mingguan'    => $this->transaksi_model->selectCount('id')->where('WEEK(created_at) = WEEK(NOW())')->first(),
            'penjualan_bulanan'     => $this->transaksi_model->selectCount('id')->where('MONTH(created_at) = MONTH(NOW())')->first(),
            'users'                 => $this->auth_model->countAllResults(),
            'pendapatan_harian'     => $this->transaksi_model->selectSum('total_amount')->where('DATE(created_at) = DATE(NOW())')->first(),
            'pendapatan_mingguan'   => $this->transaksi_model->selectSum('total_amount')->where('WEEK(created_at) = WEEK(NOW())')->first(),
            'pendapatan_bulanan'    => $this->transaksi_model->selectSum('total_amount')->where('MONTH(created_at) = MONTH(NOW())')->first(),
            'amount'                => $this->transaksi_model->selectSum('total_amount')->first(),

        ];
        
        echo view('partial/header',$data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('dashboard',$data);
        echo view('partial/footer');
    }
    
}