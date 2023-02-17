<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PemasokEntity extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'supplier_id' => '?integer',
        'supplier_company' => 'string',
        'supplier_name' => 'string',
        'supplier_phone' => 'string',
        'supplier_address' => 'string',
    ];
}
