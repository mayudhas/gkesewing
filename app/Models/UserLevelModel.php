<?php

namespace App\Models;

use App\Entities\UserLevelEntity;
use CodeIgniter\Model;

class UserLevelModel extends Model
{
    protected $table = 'user_level';
    protected $primaryKey = 'user_level_id';
    protected $returnType = UserLevelEntity::class;
    protected $protectFields = true;
    protected $allowedFields = ['user_level_name'];
}
