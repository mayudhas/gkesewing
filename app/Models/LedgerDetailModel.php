<?php

namespace App\Models;

use App\Entities\LedgerDetailEntity;
use CodeIgniter\Model;

class LedgerDetailModel extends Model
{
    protected $table = 'ledger_detail';
    protected $primaryKey = 'ledger_detail_id';
    protected $returnType = LedgerDetailEntity::class;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $protectFields = true;
    protected $allowedFields = [
        'ledger_code',
        'account_code',
        'uti_account_post_id',
        'ledger_detail_score',
    ];
}
