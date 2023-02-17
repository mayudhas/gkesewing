<?php

namespace App\Models;

use App\Entities\UtiAccountPostEntity;
use CodeIgniter\Model;

class UtiAccountPostModel extends Model
{
    protected $table = 'uti_account_post';
    protected $primaryKey = 'uti_account_post_id';
    protected $returnType = UtiAccountPostEntity::class;
    protected $protectFields = true;
    protected $allowedFields = ['uti_account_post_name', 'uti_account_post_alias'];
}
