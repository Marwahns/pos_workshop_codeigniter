<?php

namespace App\Controllers;

use App\Models\SupplierModel;
use App\Models\UserModel;

class Supplier extends BaseController
{
    // Session
    protected $session;
    // Data
    protected $data;
    // Model
    protected $supplier_model;
    protected $user_model;


    // Initialize Objects
    public function __construct()
    {
        $this->supplier_model = new SupplierModel();
        // $this->user_model = new UserModel();
        $this->session = \Config\Services::session();
        $this->data['session'] = $this->session;
    }

    // Home Page
    public function index()
    {
        $this->data['page_title'] =  "List Supplier";
        $this->data['tb_supplier'] =  $this->supplier_model->orderBy('date(created_at)ASC')->select('*')->get()->getResult();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('supplier/list');
        echo view('partial/footer');
    }

    // Create Form Page
    public function createSupplier()
    {
        $this->data['page_title'] =  "Add New";
        $this->data['request'] =  $this->request;
        $this->data['kode_supplier'] = $this->supplier_model->generateKodeSupplier();
        // return view('supplier/create', $this->data);
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('supplier/create');
        echo view('partial/footer');
    }

    // Edit Form Page
    public function saveSupplier()
    {
        $this->data['request'] = $this->request;
        $post = [
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'kode_supplier' => $this->request->getPost('kode_supplier')
        ];
        if (!empty($this->request->getPost('id')))
            $save = $this->supplier_model->where(['id' => $this->request->getPost('id')])->set($post)->update();
        else
            $save = $this->supplier_model->insert($post);
        if ($save) {
            if (!empty($this->request->getPost('id')))
                $this->session->setFlashdata('success_message', 'Data has been updated successfully');
            else
                $this->session->setFlashdata('success_message', 'Data has been added successfully');
            $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : $save;
            return redirect()->to('/supplier/view_detailSupplier/' . $id);
        } else {
            return view('supplier/create', $this->data);
        }
    }

    // Edit Form Page
    public function editSupplier($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/supplier/create');
        }
        $this->data['page_title'] = "Edit Contact Details";
        $this->data['request'] =  $this->request;
        $qry = $this->supplier_model->select('*')->where(['id' => $id]);
        $this->data['data'] = $qry->first();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('supplier/edit');
        echo view('partial/footer');
    }

    // Delete Data
    public function deleteSupplier($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/supplier/index');
        }
        $delete = $this->supplier_model->delete($id);
        if ($delete) {
            $this->session->setFlashdata('success_message', 'Contact Details has been deleted successfully.');
            return redirect()->to('/supplier/index');
        }
    }

    // View Data
    public function view_detailSupplier($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/supplier/index');
        }
        $this->data['page_title'] = "View Contact Details";
        $qry = $this->supplier_model->select('*')->where(['id' => $id]);
        $this->data['data'] = $qry->first();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('supplier/view');
        echo view('partial/footer');
    }
}
