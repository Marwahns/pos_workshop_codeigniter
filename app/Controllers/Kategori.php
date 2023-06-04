<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\UserModel;

class Kategori extends BaseController
{
    // Session
    protected $session;
    // Data
    protected $data;
    // Model
    protected $kategori_model;
    protected $user_model;

    ######################################## Initialize Objects ########################################
    public function __construct()
    {
        $this->kategori_model = new KategoriModel();
        $this->session = \Config\Services::session();
        $this->data['session'] = $this->session;
    }

    ######################################## Home Page ########################################
    public function index()
    {
        $this->data['title'] =  "Bengkel ABC | List Kategori";
        // $this->data['tb_kategori'] =  $this->kategori_model->orderBy('date(created_at)ASC')->select('*')->get()->getResult();
        $this->data['tb_kategori'] =  $this->kategori_model->detailKategori();
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->kategori_model->countAllResults();
        $this->data['kategori'] = $this->kategori_model->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['kategori'])? count($this->data['kategori']) : 0;
        $this->data['pager'] = $this->kategori_model->pager;
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('kategori/list');
        echo view('partial/footer');
    }

    ######################################## Create Form Page ########################################
    public function createKategori()
    {
        $this->data['title'] =  "Bengkel ABC | Add New Category";
        $this->data['request'] =  $this->request;
        $this->data['kode_kategori'] = $this->kategori_model->generateKodeKategori();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('kategori/create');
        echo view('partial/footer');
    }

    ######################################## Save Form Page ########################################
    public function saveKategori()
    {
        // validasi input
        if (!$this->validate([
            'kategori' => [
                'rules' => 'required|min_length[2]|max_length[255]|is_unique[tb_kategori.kategori]',
                'error' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} Kategori sudah ada'
                ]
            ],
        ])) {
            $respon = [
                'validasi' => false,
                'error'    => $this->validator->getErrors(),
            ];
            $validation = \Config\Services::validation();
            $this->data['validation'] = \Config\Services::validation();
            return redirect()->to('/kategori/createKategori')->withInput()->with('validation', $validation);
            // return $this->response->setJSON($respon);
            // return redirect()->back()->with('error', $this->validator->getErrors());
        }

        $this->data['request'] = $this->request;
        $post = [
            'kode_kategori' => $this->request->getPost('kode_kategori'),
            'kategori' => $this->request->getPost('kategori')
        ];
        if (!empty($this->request->getPost('id')))
            $save = $this->kategori_model->where(['id' => $this->request->getPost('id')])->set($post)->update();
        else
            $save = $this->kategori_model->insert($post);
        if ($save) {
            if (!empty($this->request->getPost('id')))
                $this->session->setFlashdata('success_message', 'Data has been updated successfully');
            else
                $this->session->setFlashdata('success_message', 'Data has been added successfully');
            $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : $save;
            return redirect()->to('/kategori/view_detailKategori/' . $id);
        } else {
            return view('kategori/create', $this->data);
        }
    }

    ######################################## Edit Form Page ########################################
    public function editKategori($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/kategori/edit');
        }
        $this->data['title'] = "Bengkel ABC | Edit Category Details";
        $this->data['request'] =  $this->request;
        $qry = $this->kategori_model->select('*')->where(['id' => $id]);
        $this->data['data'] = $qry->first();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('kategori/edit');
        echo view('partial/footer');
    }

    ######################################## Delete Data ########################################
    public function deleteKategori($id = '') 
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/kategori/index');
        }
        $delete = $this->kategori_model->delete($id);
        if ($delete) {
            $this->session->setFlashdata('success_message', 'Contact Details has been deleted successfully.');
            return redirect()->to('/kategori/index');
        }
    }

    

    ######################################## View Data ########################################
    public function view_detailKategori($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/supplier/index');
        }
        $this->data['title'] = "Bengkel ABC | View Category Details";
        $qry = $this->kategori_model->select('*')->where(['id' => $id]);
        $this->data['data'] = $qry->first();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('kategori/view');
        echo view('partial/footer');
    }
}
