<?php

namespace App\Models;

use App\Entities\PelangganEntity;
use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';
    protected $returnType = PelangganEntity::class;
    protected $protectFields = true;
    protected $allowedFields = ['customer_phone', 'customer_name', 'customer_address'];
}
