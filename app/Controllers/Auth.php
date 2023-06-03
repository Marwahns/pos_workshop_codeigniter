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
    // Model
    protected $userModel;

    protected $email;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        $this->data['session'] = $this->session;
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
        if($user){
            if(password_verify($post['password'], $user->password) && $user->id_status == 1){
                $params = ['id' => $user->id];
                $this->data['join_role'] = $this->userModel->getJoinToRole();
                session()->set($params);
                return redirect()->to('/dashboard/index/');
            } else{
                return redirect()->back()->with('error', 'Password salah');
            }
        } else{
            return redirect()->back()->with('error', 'Username tidak terdaftar');
        }
    }

    public function logout()
    {
        session()->remove(['login', 'id']); // hapus session login dan id
        return redirect()->to(base_url());
    }
}