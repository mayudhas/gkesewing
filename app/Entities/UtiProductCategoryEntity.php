<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UtiProductCategoryEntity extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'uti_product_category_id' => '?integer',
        'uti_product_category_name' => 'string'
    ];
}
