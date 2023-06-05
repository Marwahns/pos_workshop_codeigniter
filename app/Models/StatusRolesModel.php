<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusRolesModel extends Model
{
    protected $table      = 'tb_status_roles';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['status'];
    
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

}