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
            'title'             => 'Dashboard',
            'spareParts'        => $this->spareParts_model->countAllResults(),
            'supplier'          => $this->supplier_model->countAllResults(),
            'kategori'          => $this->kategori_model->countAllResults(),
            // 'penjualan'         => $this->transaksi_model->countAllResults(),
            // 'penjualan_harian'  => $this->penjualan_daily(),
            // 'penjualan_bulanan' => $this->penjualan_daily(true),
            'item'              => $this->transaksi_item_model->get_quantity(),
            'users'             => $this->auth_model->countAllResults(),
        ];
        
        echo view('partial/header',$data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('dashboard',$data);
        echo view('partial/footer');
    }

    // private function penjualan_daily($bulanan = false){
	// 	$today = date("Y-m-d",strtotime("today"));
	// 	$yesterday = date("Y-m-d",strtotime("-1 day"));	
	// 	if($bulanan){
	// 		$yesterday = date("Y-m-d",strtotime("-30 day"));	
	// 	}	

	// 	$filter['DATE(sales_transaction.date) >='] = $yesterday;
	// 	$filter['DATE(sales_transaction.date) <='] = $today;

	// 	$penjualans = $this->transaksi_model->get_filter($filter,url_param());
	// 	return $penjualans;
	// }
}