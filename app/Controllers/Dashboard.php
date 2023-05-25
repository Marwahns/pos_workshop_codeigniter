<?php
namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\SparepartsModel;
use App\Models\SupplierModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    // Data
    protected $data;
    // Model
    protected $spareParts_model;
    protected $supplier_model;
    protected $kategori_model;
    protected $auth_model;

    // Initialize Objects
    public function __construct()
    {
        $this->spareParts_model = new SparepartsModel();
        $this->supplier_model = new SupplierModel();
        $this->kategori_model = new KategoriModel();
        $this->auth_model = new UserModel();
    }

    public function index()
    {
        $data = [
            'title'         => 'Dashboard',
            'spareParts'    => $this->spareParts_model->countAllResults(),
            'supplier'      => $this->supplier_model->countAllResults(),
            'kategori'      => $this->kategori_model->countAllResults(),
            'users'          => $this->auth_model->countAllResults(),
        ];
        
        echo view('partial/header',$data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('dashboard',$data);
        echo view('partial/footer');
    }
}