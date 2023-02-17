<?php

namespace App\Models;

use App\Entities\AkunEntity;
use CodeIgniter\Model;

class AkunModel extends Model
{
    protected $table = 'account';
    protected $primaryKey = 'account_code';
    protected $useAutoIncrement = false;
    protected $returnType = AkunEntity::class;
    protected $protectFields = true;
    protected $allowedFields = ['account_code', 'account_name', 'uti_account_post_id', 'uti_account_group_id'];
}
