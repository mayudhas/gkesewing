<?php

namespace App\Models;

use App\Entities\UtiAccountGroupEntity;
use CodeIgniter\Model;

class UtiAccountGroupModel extends Model
{
    protected $table = 'uti_account_group';
    protected $primaryKey = 'uti_account_group_id';
    protected $returnType = UtiAccountGroupEntity::class;
    protected $protectFields = true;
    protected $allowedFields = ['uti_account_group_name', 'uti_account_group_alias'];
}
