<?php

namespace App\Models;

use App\Entities\ProdukEntity;
use App\Entities\TransactionEntity;
use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'transaction_code';
    protected $returnType = TransactionEntity::class;
    protected $protectFields = true;
    protected $allowedFields = [
        'transaction_code',
        'employee_id',
        'customer_phone',
        'transaction_date',
        'transaction_desc',
        'is_ledger'
    ];
    protected $useAutoIncrement = false;
}
