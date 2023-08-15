<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusRolesModel extends Model
{
    protected $table      = 'tb_status_roles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['status'];
    // protected $useTimestamps = true;

}