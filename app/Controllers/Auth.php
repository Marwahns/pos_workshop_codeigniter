<?php

namespace App\Controllers;

use App\Models\UserModel;
use Config\Email;

class Auth extends BaseController
{
    // Session
    protected $session;
    // Data
    protected $data;
    protected $security;
    // Model
    protected $userModel;

    protected $email;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        $this->data['session'] = $this->session;
        $this->security = \Config\Services::security();
        helper(['fungsi_helper']);
    }

    public function index()
    {
        $this->data['title'] = "Login";
        $this->data['body_class'] = "hold-transition login-page";
        return view('auth/login', $this->data);
    }

    public function loginProcess()
    {
        $post = $this->request->getPost();
        $user = $this->userModel->getUsername($post);
        if ($user) {
            if (password_verify($post['password'], $user->password) && $user->id_status == 1) {
                $params = ['id' => $user->id];
                $this->data['join_role'] = $this->userModel->getJoinToRole();
                session()->set($params);
                return redirect()->to('/dashboard/index/');
            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak terdaftar');
        }
    }

    public function do_login()
    {
        $username =  $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $result = $this->userModel->where('username', $username)->first();

        if ($result->id > 0) {
            if (password_verify($password, $result->password)) {
                $this->session->set('user', $result);
                return redirect()->to('/dashboard/index/');
            } else {
                return redirect()->back()->with('error', 'Password or Username salah');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak terdaftar');
        }
    }

    public function do_register()
    {
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

        $id_role =  $this->request->getPost('id_role');
        $id_status = $this->request->getPost('id_status');
        $email = $this->request->getVar('email');
        $username =  $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $password = password_hash($password, PASSWORD_DEFAULT);
        $nama = $this->request->getVar('nama');
        $alamat = $this->request->getVar('alamat');
        $ip_address = $this->request->getIPAddress();
        $token = $this->security->getTokenName();

        $data = [
            'id_role'   => $id_role,
            'id_status' => $id_status,
            'email'     => $email,
            'username'  => $username,
            'password'  => $password,
            'nama'      => $nama,
            'alamat'    => $alamat,
            'ip_address' => $ip_address,
            'token'     => $token,
        ];

        $id = $this->request->getPost('id');
        $save = $this->userModel->save($data);

        if ($save) {
            $this->session->setFlashdata('success_message', 'Data has been added successfully');
            return redirect()->to('/users/view_detailUsers/' . $id);
        } else {
            return redirect()->to('/users/create/');
        }
    }

    public function do_update()
    {
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
            return redirect()->to('/users/editUsers')->withInput()->with('validation', $validation);
            return $this->response->setJSON($respon);
            // return redirect()->back()->with('error', $this->validator->getErrors());
        }

        $id_role =  $this->request->getPost('id_role');
        $id_status = $this->request->getPost('id_status');
        $email = $this->request->getVar('email');
        $username =  $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $password = password_hash($password, PASSWORD_DEFAULT);
        $nama = $this->request->getVar('nama');
        $alamat = $this->request->getVar('alamat');
        $ip_address = $this->request->getIPAddress();
        $token = $this->security->getTokenName();

        $data = [
            'id_role'   => $id_role,
            'id_status' => $id_status,
            'email'     => $email,
            'username'  => $username,
            'nama'      => $nama,
            'alamat'    => $alamat,
            'ip_address' => $ip_address,
            'token'     => $token,
        ];

        if (!empty($this->request->getPost('id'))) {

            // jika password di update
            if (!empty($this->request->getPost('password'))) {
                $data = [
                    'password' => $password
                ];
            }

            $save = $this->userModel->where(['id' => $this->request->getPost('id')])->set($data)->update();
            $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : $save;

            return redirect()->to('/users/view_detailUsers/' . $id);
        } else {
            return view('users/index', $this->data);
        }
    }

    public function do_update_profile()
    {
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
        //     return redirect()->to('/users/profile')->withInput()->with('validation', $validation);
        //     return $this->response->setJSON($respon);
        //     // return redirect()->back()->with('error', $this->validator->getErrors());
        // }

        $id_role =  $this->request->getPost('id_role');
        $id_status = $this->request->getPost('id_status');
        $email = $this->request->getVar('email');
        $username =  $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $password = password_hash($password, PASSWORD_DEFAULT);
        $nama = $this->request->getVar('nama');
        $alamat = $this->request->getVar('alamat');
        $ip_address = $this->request->getIPAddress();
        $token = $this->security->getTokenName();

        $data = [
            'id_role'   => $id_role,
            'id_status' => $id_status,
            'email'     => $email,
            'username'  => $username,
            'nama'      => $nama,
            'alamat'    => $alamat,
            'ip_address' => $ip_address,
            'token'     => $token,
        ];

        if (!empty($this->request->getPost('id'))) {

            // jika password di update
            if (!empty($this->request->getPost('password'))) {
                $data = [
                    'password' => $password
                ];
            }

            $save = $this->userModel->where(['id' => $this->request->getPost('id')])->set($data)->update();
            $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : $save;

            return redirect()->to('/users/view_detailUsers/' . $id);
        } else {
            return view('users/profile', $this->data);
        }
    }

    public function logout()
    {
        // session()->remove(['login', 'id']); // hapus session login dan id
        session()->destroy();
        return redirect()->to(base_url());
    }
}
