<?php

namespace App\Models;

use App\Entities\PengeluaranEntity;
use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    protected $table = 'transaction_spending';
    protected $primaryKey = 'spending_id';
    protected $returnType = PengeluaranEntity::class;
    protected $allowedFields = ['employee_id', 'supplier_id', 'spending_date', 'spending_desc', 'spending_total', 'spending_photo_path', 'is_ledger'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

}
