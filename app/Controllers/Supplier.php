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

    ######################################## Initialize Objects ########################################
    public function index()
    {
        $this->data['title'] =  "Bengkel ABC | List Supplier";
        // $this->data['tb_supplier'] =  $this->supplier_model->orderBy('date(created_at)ASC')->select('*')->get()->getResult();
        $this->data['tb_supplier'] =  $this->supplier_model->detailSupplier();
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->supplier_model->countAllResults();
        $this->data['supplier'] = $this->supplier_model->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['supplier'])? count($this->data['supplier']) : 0;
        $this->data['pager'] = $this->supplier_model->pager;
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('supplier/list');
        echo view('partial/footer');
    }

    ######################################## Home Page ########################################
    public function createSupplier()
    {
        $this->data['title'] =  "Bengkel ABC | Add New Supplier";
        $this->data['request'] =  $this->request;
        $this->data['kode_supplier'] = $this->supplier_model->generateKodeSupplier();
        // return view('supplier/create', $this->data);
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('supplier/create');
        echo view('partial/footer');
    }

    ######################################## Edit Form Page ########################################
    public function saveSupplier()
    {
        // validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|min_length[2]|max_length[255]|is_unique[tb_supplier.nama]',
                'error' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} Nama supplier sudah ada'
                ]
            ],
            'alamat' => [
                'rules' => 'required|min_length[2]|max_length[255]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|min_length[2]|max_length[20]|is_unique[tb_supplier.no_telepon]',
                'error' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} Nomor telepon sudah ada'
                ]
            ],
        ])) {
            $respon = [
                'validasi' => false,
                'error'    => $this->validator->getErrors(),
            ];
            $validation = \Config\Services::validation();
            $this->data['validation'] = \Config\Services::validation();
            return redirect()->to('/supplier/createSupplier')->withInput()->with('validation', $validation);
            // return $this->response->setJSON($respon);
            // return redirect()->back()->with('error', $this->validator->getErrors());
        }

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

    ######################################## Edit Form Page ########################################
    public function saveEditSupplier()
    {
        // validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|min_length[2]|max_length[255]',
                'error' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'alamat' => [
                'rules' => 'required|min_length[2]|max_length[255]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|min_length[2]|max_length[20]|',
                'error' => [
                    'required' => '{field} harus diisi',
                ]
            ],
        ])) {
            $respon = [
                'validasi' => false,
                'error'    => $this->validator->getErrors(),
            ];
            $validation = \Config\Services::validation();
            $this->data['validation'] = \Config\Services::validation();
            return redirect()->to('/supplier/createSupplier')->withInput()->with('validation', $validation);
            // return $this->response->setJSON($respon);
            // return redirect()->back()->with('error', $this->validator->getErrors());
        }

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

    ######################################## Edit Form Page ########################################
    public function editSupplier($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/supplier/create');
        }
        $this->data['title'] = "Bengkel ABC | Edit Supplier Details";
        $this->data['request'] =  $this->request;
        $qry = $this->supplier_model->select('*')->where(['id' => $id]);
        $this->data['data'] = $qry->first();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('supplier/edit');
        echo view('partial/footer');
    }

    ######################################## Delete Data ########################################
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

    ######################################## View Data ########################################
    public function view_detailSupplier($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/supplier/index');
        }
        $this->data['title'] = "Bengkel ABC | View Supplier Details";
        $qry = $this->supplier_model->select('*')->where(['id' => $id]);
        $this->data['data'] = $qry->first();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('supplier/view');
        echo view('partial/footer');
    }
}
