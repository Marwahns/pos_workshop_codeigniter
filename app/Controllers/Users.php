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
    protected $security;
    // Model
    protected $user_model;
    protected $role_model;
    protected $statusRole_model;


    ######################################## Initialize Objects ########################################
    public function __construct()
    {
        $this->user_model = new UserModel();
        $this->role_model = new RoleModel();
        $this->statusRole_model = new StatusRolesModel();
        $this->session = \Config\Services::session();
        $this->data['session'] = $this->session;
        $this->security = \Config\Services::security();
        helper(['form', 'fungsi']);
    }

    ######################################## Home Page ########################################
    public function index()
    {
        $this->data['body_class'] = "";
        $this->data['title'] =  "Bengkel ABC | List Users";
        // $this->data['tb_users'] =  $this->user_model->joinUser();
        $this->data['tb_users'] =  $this->user_model->detailUser();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('users/list', $this->data);
        echo view('partial/footer');
    }

    ######################################## Create Form Page ########################################
    public function createUsers()
    {
        $this->data['body_class'] = "";
        $this->data['title'] =  "Bengkel ABC | Add New User";
        $this->data['request'] =  $this->request;
        $this->data['id_role'] =  $this->role_model->orderBy('id ASC')->select('*')->get()->getResult();
        $this->data['id_status'] =  $this->statusRole_model->orderBy('id ASC')->select('*')->get()->getResult();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('users/create', $this->data);
        echo view('partial/footer');
    }

    ######################################## Save Form Page ########################################
    public function saveAccount()
    {
        // validasi input
        if (!$this->validate([
            'id_status' => [
                'rules' => 'required|min_length[1]|max_length[11]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

            'id_role' => [
                'rules' => 'required|min_length[1]|max_length[11]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

            'email' => [
                'rules' => 'required|min_length[2]|max_length[255]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

            'username' => [
                'rules' => 'required|min_length[1]|max_length[30]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

            'password' => [
                'rules' => 'required|min_length[1]|max_length[255]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

            'nama' => [
                'rules' => 'required|min_length[1]|max_length[255]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

            'alamat' => [
                'rules' => 'required|min_length[1]|max_length[255]',
                'error' => [
                    'required' => '{field} harus diisi'
                ]
            ],

        ])) {
            $respon = [
                'validasi' => false,
                'error'    => $this->validator->getErrors(),
            ];
            $validation = \Config\Services::validation();
            $this->data['validation'] = \Config\Services::validation();
            return redirect()->to('/users/createUsers')->withInput()->with('validation', $validation);
            return $this->response->setJSON($respon);
            // return redirect()->back()->with('error', $this->validator->getErrors());
        }

        $this->data['request'] = $this->request;
        $getpost = $this->request->getPost();
        $password = $this->request->getVar('password');
        $post = [
            'id_role'   => $this->request->getPost('id_role'),
            'id_status' => $this->request->getPost('id_status'),
            'email'     => esc($this->request->getVar('email')),
            'username'  => esc($this->request->getVar('username')),
            'password'  => password_hash($password, PASSWORD_DEFAULT),
            'nama'      => esc($this->request->getVar('nama')),
            'alamat'    => esc($this->request->getVar('alamat')),
            'ip_address' => $this->request->getIPAddress(),
            'token'     => $this->security->getTokenName(),
        ];

        $save = $this->user_model->insert($post);

        // $id = $this->request->getPost('id');
        // $this->user_model->save($post);

        if ($save) {
            $this->session->setFlashdata('success_message', 'Data has been added successfully');
            $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : $save;
            return redirect()->to('/users/view_detailUsers/' . $id);
        } else {
            return view('users/create', $this->data);
        }
    }

    ######################################## Save Edit Account ########################################
    public function saveEditAccount()
    {
        // validasi input
        // if (!$this->validate([
        //     'id_status' => [
        //         'rules' => 'required|min_length[1]|max_length[11]',
        //         'error' => [
        //             'required' => '{field} harus diisi'
        //         ]
        //     ],

        //     'id_role' => [
        //         'rules' => 'required|min_length[1]|max_length[11]',
        //         'error' => [
        //             'required' => '{field} harus diisi'
        //         ]
        //     ],

        //     'email' => [
        //         'rules' => 'required|min_length[2]|max_length[255]',
        //         'error' => [
        //             'required' => '{field} harus diisi'
        //         ]
        //     ],

        //     'username' => [
        //         'rules' => 'required|min_length[1]|max_length[30]',
        //         'error' => [
        //             'required' => '{field} harus diisi'
        //         ]
        //     ],

        //     'password' => [
        //         'rules' => 'min_length[1]|max_length[255]',
        //     ],

        //     'nama' => [
        //         'rules' => 'required|min_length[1]|max_length[255]',
        //         'error' => [
        //             'required' => '{field} harus diisi'
        //         ]
        //     ],

        //     'alamat' => [
        //         'rules' => 'required|min_length[1]|max_length[255]',
        //         'error' => [
        //             'required' => '{field} harus diisi'
        //         ]
        //     ],

        // ])) {
        //     $respon = [
        //         'validasi' => false,
        //         'error'    => $this->validator->getErrors(),
        //     ];
        //     $validation = \Config\Services::validation();
        //     $this->data['validation'] = \Config\Services::validation();
        //     return redirect()->to('/users/editUsers')->withInput()->with('validation', $validation);
        //     return $this->response->setJSON($respon);
        //     // return redirect()->back()->with('error', $this->validator->getErrors());
        // }

        $this->data['request'] = $this->request;
        $getpost = $this->request->getPost();
        $password = $this->request->getVar('password');
        $post = [
            'id_role' => $this->request->getPost('id_role'),
            'id_status' => $this->request->getPost('id_status'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'ip_address'   => $this->request->getIPAddress(),
        ];
        if (!empty($this->request->getPost('id'))) {

            // jika password di update
            if (!empty($this->request->getPost('password'))) {
                $post['password'] = password_hash($password, PASSWORD_DEFAULT);
            } else {
                // Jika password tidak diubah, gunakan password yang ada dalam database
                $existingUser = $this->user_model->where(['id' => $this->request->getPost('id')])->first();
                $post['password'] = $existingUser['password'];
            }

            // print_r($post); die();
            $save = $this->user_model->where(['id' => $this->request->getPost('id')])->set($post)->update();
            $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : $save;
            $this->session->setFlashdata('success_message', 'Data has been updated successfully.');
            return redirect()->to('/users/view_detailUsers/' . $id);
        } else {
            return view('users/index', $this->data);
        }
    }

    ######################################## Save Update Account Profile ########################################
    public function saveUpdateAccountProfile()
    {
        // validasi input
        // if (!$this->validate([
        //     'id_status' => [
        //         'rules' => 'required|min_length[1]|max_length[11]',
        //         'error' => [
        //             'required' => '{field} harus diisi'
        //         ]
        //     ],

        //     'id_role' => [
        //         'rules' => 'required|min_length[1]|max_length[11]',
        //         'error' => [
        //             'required' => '{field} harus diisi'
        //         ]
        //     ],

        //     'email' => [
        //         'rules' => 'required|min_length[2]|max_length[255]',
        //         'error' => [
        //             'required' => '{field} harus diisi'
        //         ]
        //     ],

        //     'username' => [
        //         'rules' => 'required|min_length[1]|max_length[30]',
        //         'error' => [
        //             'required' => '{field} harus diisi'
        //         ]
        //     ],

        //     'password' => [
        //         'rules' => 'min_length[1]|max_length[255]',
        //     ],

        //     'nama' => [
        //         'rules' => 'required|min_length[1]|max_length[255]',
        //         'error' => [
        //             'required' => '{field} harus diisi'
        //         ]
        //     ],

        //     'alamat' => [
        //         'rules' => 'required|min_length[1]|max_length[255]',
        //         'error' => [
        //             'required' => '{field} harus diisi'
        //         ]
        //     ],

        // ])) {
        //     $respon = [
        //         'validasi' => false,
        //         'error'    => $this->validator->getErrors(),
        //     ];
        //     $validation = \Config\Services::validation();
        //     $this->data['validation'] = \Config\Services::validation();
        //     return redirect()->to('/users/editUsers')->withInput()->with('validation', $validation);
        //     return $this->response->setJSON($respon);
        //     // return redirect()->back()->with('error', $this->validator->getErrors());
        // }

        $this->data['request'] = $this->request;
        $getpost = $this->request->getPost();
        $password = $this->request->getVar('password');
        $post = [
            'id_role' => $this->request->getPost('id_role'),
            'id_status' => $this->request->getPost('id_status'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            // 'password' => buat_password($getpost['password']),
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'ip_address'   => $this->request->getIPAddress(),
        ];
        if (!empty($this->request->getPost('id'))) {

            // jika password di update
            if (!empty($this->request->getPost('password'))) {
                $post['password'] = password_hash($password, PASSWORD_DEFAULT);
            } else {
                // Jika password tidak diubah, gunakan password yang ada dalam database
                $existingUser = $this->user_model->where(['id' => $this->request->getPost('id')])->first();
                $post['password'] = $existingUser['password'];
            }

            // print_r($post); die();
            $save = $this->user_model->where(['id' => $this->request->getPost('id')])->set($post)->update();
            $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : $save;
            $this->session->setFlashdata('success_message', 'Profile has been updated successfully.');
            return redirect()->to('/profile/index');
        } else {
            return view('users/profile', $this->data);
        }
    }

    ######################################## Edit Form Page ########################################
    public function editUsers($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/users/create');
        }
        $this->data['body_class'] = "";
        $this->data['title'] = "Bengkel ABC | Edit Account Users Details";
        $this->data['request'] =  $this->request;
        $this->data['id_role'] =  $this->role_model->orderBy('id ASC')->select('*')->get()->getResult();
        $this->data['id_status'] =  $this->statusRole_model->orderBy('id ASC')->select('*')->get()->getResult();
        $qry = $this->user_model->select('*')->where(['id' => $id]);
        $this->data['data'] = $qry->first();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('users/edit', $this->data);
        echo view('partial/footer');
    }

    ######################################## Delete Data ########################################
    public function deleteUsers($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/users/index');
        }
        $delete = $this->user_model->delete($id);
        if ($delete) {
            $this->session->setFlashdata('success_message', 'Data has been deleted successfully.');
            return redirect()->to('/users/index');
        }
    }

    ######################################## View Data ########################################
    public function view_detailUsers($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('error_message', 'Unknown Data ID.');
            return redirect()->to('/users/index');
        }
        $this->data['body_class'] = "";
        $this->data['title'] = "Bengkel ABC | View User Details";
        $qry = $this->user_model->select('tb_users.id, tb_users.email, tb_users.username, tb_users.password, tb_users.nama, tb_users.alamat, tb_users.id_status, tb_users.id_role, tb_roles.role, tb_status_roles.status')
            ->join('tb_roles', 'tb_roles.id=tb_users.id_role')
            ->join('tb_status_roles', 'tb_status_roles.id=tb_users.id_status')
            ->where(['tb_users.id' => $id]);
        $this->data['data'] = $qry->first();
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('users/view', $this->data);
        echo view('partial/footer');
    }

    public function profile()
    {
        $this->data['body_class'] = "";
        $this->data['title'] =  "Bengkel ABC | Edit Profile";
        echo view('partial/header', $this->data);
        echo view('partial/top_menu');
        echo view('partial/side_menu');
        echo view('users/profile', $this->data);
        echo view('partial/footer');
    }
}
