<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'tb_users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_status', 'id_role', 'email', 'username', 'password', 'nama', 'alamat', 'token', 'ip_address'];
    // protected $useTimestamps = true;

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

    // SELECT tb_users.id, tb_roles.role FROM tb_users JOIN tb_roles ON tb_users.id_role=tb_roles.id;

}
