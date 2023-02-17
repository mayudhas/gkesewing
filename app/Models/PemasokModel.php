<?php

namespace App\Models;

use App\Entities\PemasokEntity;
use CodeIgniter\Model;

class PemasokModel extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'supplier_id';
    protected $returnType = PemasokEntity::class;
    protected $protectFields = true;
    protected $allowedFields = ['supplier_company', 'supplier_name', 'supplier_phone', 'supplier_address'];
}
