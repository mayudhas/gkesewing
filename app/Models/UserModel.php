<?php

namespace App\Models;

use App\Entities\UserEntity;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType = UserEntity::class;
    protected $allowedFields = ['user_level_id', 'user_username', 'user_password', 'user_name', 'user_is_active', 'employee_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

}
