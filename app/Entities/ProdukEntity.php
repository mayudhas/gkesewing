<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ProdukEntity extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'product_id' => '?integer',
        'product_name' => 'string',
        'product_unit' => 'string',
        'product_price' => 'integer',
        'product_buy' => 'integer',
        'uti_product_category_id' => 'integer',
        'product_status' => 'integer',
    ];
}
