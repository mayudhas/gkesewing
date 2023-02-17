<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class TransactionDetailEntity extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'detail_id' => 'integer',
        'transaction_code' => 'string',
        'product_id' => 'integer',
        'product_name' => 'string',
        'category_name' => 'string',
        'product_unit' => 'string',
        'transaction_detail_discount' => 'float',
        'transaction_detail_price' => 'float',
        'transaction_detail_quantity' => 'float',
        'transaction_detail_total' => 'float'
    ];
}
