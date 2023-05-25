<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\StatusRolesModel;
use App\Models\UserModel;

class Users extends BaseController
{
    // Session
    protected $session;
    // Data
    protected $data;
    // Model
    protected $user_model;
    protected $role_model;
    protected $statusRole_model;


    // Initialize Objects
    public function __construct()
    {
        $this->user_model = new UserModel();
        $this->role_model = new RoleModel();
        $this->statusRole_model = new StatusRolesModel();
        $this->session = \Config\Services::session();
        $this->data['session'] = $this->session;
        helper(['form', 'fungsi']);
    }

    // Home Page
    public function index()
    {
        $this->data['page_title'] =  "List Users";
        $this->data['tb_users'] =  $this->user_model->joinUser();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('users/list');
        echo view('partial/footer');
    }

    // Create Form Page
    public function createUsers()
    {
        $this->data['page_title'] =  "Add New";
        $this->data['request'] =  $this->request;
        $this->data['id_role'] =  $this->role_model->orderBy('id ASC')->select('*')->get()->getResult();
        $this->data['id_status'] =  $this->statusRole_model->orderBy('id ASC')->select('*')->get()->getResult();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('users/create');
        echo view('partial/footer');
    }

    // Edit Form Page
    public function saveAccount()
    {
        $this->data['request'] = $this->request;
        $getpost = $this->request->getPost();
        $post = [
            'id_role' => $this->request->getPost('id_role'),
            'id_status' => $this->request->getPost('id_status'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => buat_password($getpost['password']),
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
        ];
        if (!empty($this->request->getPost('id')))
            $save = $this->user_model->where(['id' => $this->request->getPost('id')])->set($post)->update();
        else
            $save = $this->user_model->insert($post);
        if ($save) {
            if (!empty($this->request->getPost('id')))
                $this->session->setFlashdata('success_message', 'Data has been updated successfully');
            else
                $this->session->setFlashdata('success_message', 'Data has been added successfully');
            $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : $save;
            return redirect()->to('/users/view_detailUsers/' . $id);
        } else {
            return view('users/create', $this->data);
        }
    }

    // Edit Form Page
    public function editUsers($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/users/create');
        }
        $this->data['page_title'] = "Edit Account Users Details";
        $this->data['request'] =  $this->request;
        $this->data['id_role'] =  $this->role_model->orderBy('id ASC')->select('*')->get()->getResult();
        $this->data['id_status'] =  $this->statusRole_model->orderBy('id ASC')->select('*')->get()->getResult();
        $qry = $this->user_model->select('*')->where(['id' => $id]);
        $this->data['data'] = $qry->first();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('users/edit');
        echo view('partial/footer');
    }

    // Delete Data
    public function deleteUsers($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/users/index');
        }
        $delete = $this->user_model->delete($id);
        if ($delete) {
            $this->session->setFlashdata('success_message', 'Contact Details has been deleted successfully.');
            return redirect()->to('/users/index');
        }
    }

    // View Data
    public function view_detailUsers($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/users/index');
        }
        $this->data['page_title'] = "View Contact Details";
        $qry = $this->user_model->select('*')->where(['id' => $id]);
        $this->data['data'] = $qry->first();
        $this->data['join_role'] = $this->user_model->getJoinToRole();
        $this->data['join_status_role'] = $this->user_model->getJoinToStatusRole();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('users/view');
        echo view('partial/footer');
    }
    
    public function profile()
    {
        $this->data['page_title'] =  "Edit Profile";
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('users/profile');
        echo view('partial/footer');
    }

}
