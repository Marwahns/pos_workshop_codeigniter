<?php

namespace App\Controllers\Api;

use App\Models\PelangganModel;
use App\Models\SparepartsModel;
use App\Models\SupplierModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Home extends ResourceController
{
    use ResponseTrait;

    protected $SpareParts_model;
    protected $supllier_model;
    protected $Pelanggan_model;

    public function show($id = null)
    {
        $SpareParts_model = new SparepartsModel();
        $Pelanggan_model = new PelangganModel();
        $data = $SpareParts_model->find($id);
        // $data = $Pelanggan_model->find($id);

        return $this->respond($data);
    }

}
