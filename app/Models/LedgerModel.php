<?php

namespace App\Models;

use App\Entities\AkunEntity;
use App\Entities\LedgerEntity;
use CodeIgniter\Model;

class LedgerModel extends Model
{
    protected $table = 'ledger';
    protected $primaryKey = 'ledger_code';
    protected $returnType = LedgerEntity::class;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
//    protected $useAutoIncrement = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'ledger_code',
        'ledger_desc',
        'ledger_name',
        'ledger_number',
        'ledger_date',
        'transaction_code',
        'spending_id',
    ];
}
