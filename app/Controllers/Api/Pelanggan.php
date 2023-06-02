<?php

namespace App\Controllers\Api;

use App\Models\PelangganModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Pelanggan extends ResourceController
{
    use ResponseTrait;

    protected $Pelanggan_model;

    public function show($id = null)
    {
        $Pelanggan_model = new PelangganModel();
        $data = $Pelanggan_model->find($id);

        return $this->respond($data);
    }

}
