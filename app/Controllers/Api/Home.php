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
        // $data = $SpareParts_model->find($id);
        $data = $SpareParts_model
            ->select('tb_spareparts.*, tb_supplier.nama as supplier, tb_kategori.kategori')
            ->join('tb_supplier', 'tb_supplier.id=tb_spareparts.supplier_id')
            ->join('tb_kategori', 'tb_kategori.id=tb_spareparts.kategori_id')
            ->where(['tb_spareparts.id' => $id])
            ->get()
            ->getRow();

        return $this->respond($data);
    }
}
