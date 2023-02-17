<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class TransactionEntity extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'transaction_code' => 'string',
        'employee_id' => 'integer',
        'customer_phone' => 'string',
        'transaction_date' => 'date',
        'transaction_desc' => 'string',
        'is_ledger' => 'integer'
    ];
}
