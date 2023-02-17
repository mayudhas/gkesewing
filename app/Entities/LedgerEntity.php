<?php

namespace App\Entities;

use App\Models\UtiAccountGroupModel;
use App\Models\UtiAccountPostModel;
use CodeIgniter\Entity\Entity;

class LedgerEntity extends Entity
{
    protected $datamap = [];
    protected $casts = [
        'transaction_code' => '?string',
        'spending_id' => '?integer',
        'ledger_desc' => 'string',
        'ledger_name' => 'string',
        'ledger_number' => 'integer',
        'ledger_date' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
