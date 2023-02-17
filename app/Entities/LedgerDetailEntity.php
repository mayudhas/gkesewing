<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class LedgerDetailEntity extends Entity
{
    protected $datamap = [];
    protected $casts = [
        'ledger_code' => 'string',
        'account_code' => 'integer',
        'ledger_detail_score' => 'integer',
        'uti_account_post_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
