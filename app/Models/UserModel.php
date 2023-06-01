<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'tb_users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_status',
        'id_role',
        'email',
        'username',
        'password',
        'nama',
        'alamat',
        'token',
        'ip_address'
    ];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $rules = [
        'email'     => 'required|is_unique[users.email]',
        'username'  => 'required|min_length[2]|max_length[50]|alpha_numeric',
        'password'  => 'required|min_length[2]|max_length[255]',
        'nama'      => 'required|min_length[2]|max_length[50]|alpha_space',
        'alamat'    => 'required|min_length[2]|max_length[255]'
    ];

    protected $rulesValidation = [
        'email' => [
            'required'  => 'Email harus terisi',
            'is_unique' => 'Email telah terdaftar'
        ],
        'username' => [
            'required'      => 'Username harus terisi',
            'min_length'    => 'Username minimal terdiri dari 2 karakter',
            'max_length'    => 'Username maksimal terdiri dari 50 karakter',
            'alpha_numeric' => 'Username hanya boleh terdiri dari huruf dan angka'
        ],
        'password' => [
            'required'      => 'Password harus terisi',
            'min_length'    => 'Password minimal terdiri dari 2 karakter',
            'max_length'    => 'Password maksimal terdiri dari 255 karakter'
        ],
        'nama' => [
            'required'      => 'Nama harus terisi',
            'min_length'    => 'Nama minimal terdiri dari 2 karakter',
            'max_length'    => 'Nama maksimal terdiri dari 50 karakter',
            'alpha_space'   => 'Nama hanya boleh terdiri dari huruf dan spasi'
        ],
        'alamat' => [
            'required'      => 'Alamat harus terisi',
            'min_length'    => 'Alamat minimal terdiri dari 2 karakter',
            'max_length'    => 'Alamat maksimal terdiri dari 255 karakter'
        ]
    ];

    ######################################## Detail User ########################################
    public function detailUser($id = null)
    {
        $builder = $this->builder($this->table)->select('tb_users.id, tb_users.email, tb_users.username, tb_users.password, tb_users.nama, tb_users.alamat, tb_users.id_status, tb_users.id_role, tb_roles.role, tb_status_roles.status')
            ->join('tb_roles', 'tb_roles.id=tb_users.id_role')
            ->join('tb_status_roles', 'tb_status_roles.id=tb_users.id_status');
        if (empty($id)) {
            return $builder->get()->getResult(); // tampilkan semua data
        } else {
            // tampilkan data sesuai id/barcode
            return $builder->where('tb_users.id', $id)->get(1)->getRow();
        }
    }

    public function getUsername($loginProcess)
    {
        return $this->db->table('tb_users')->getWhere(['username' => $loginProcess['username']])->getRow();
    }

    public function getUser($kolom = null)
    {
        if (empty($kolom)) {
            return $this->findAll();
        }
        return $this->builder($this->table)->where('id', $kolom)->orWhere('username', $kolom)->orWhere('email', $kolom)->get(1)->getRow();
    }

    // public function getToken(string $token)
    // {
    //     return $this->builder($this->table)->select('id, email, token')->where('token', $token)->get(1)->getRow();
    // }

    public function getRole()
    {
        return $this->builder('tb_roles')->select('id, role')->orderBy('id', 'DESC')->get()->getResult();
    }

    public function getStatusRole()
    {
        return $this->builder('tb_status_roles')->select('id, status')->orderBy('id', 'DESC')->get()->getResult();
    }

    function userLogin()
    {
        return $this->builder($this->table)->select('username')->where('id', session('id'))->get()->getResult();
    }

    function getJoinToRole()
    {
        return $this->db->table('tb_users')
            ->join('tb_roles', 'tb_roles.id=tb_users.id_role')
            ->get()->getResultArray();
    }

    function getJoinToStatusRole()
    {
        return $this->db->table('tb_users')
            ->join('tb_status_roles', 'tb_status_roles.id=tb_users.id_status')
            ->get()->getResultArray();
    }

    function joinUser()
    {
        return $this->builder('tb_users')
            ->join('tb_roles', 'tb_roles.id=tb_users.id_role')
            ->join('tb_status_roles', 'tb_status_roles.id=tb_users.id_status')
            ->select('tb_users.*, tb_roles.role, tb_status_roles.status')
            ->get()->getResult();
    }
}
