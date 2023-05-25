<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table      = 'tb_roles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['role'];
    // protected $useTimestamps = true;

}