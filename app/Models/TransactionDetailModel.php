<?php

namespace App\Models;

use App\Entities\TransactionDetailEntity;
use CodeIgniter\Model;

class TransactionDetailModel extends Model
{
    protected $table = 'transaction_detail';
    protected $primaryKey = 'detail_id';
    protected $returnType = TransactionDetailEntity::class;
    protected $protectFields = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $allowedFields = [
        'transaction_code',
        'product_id',
        'product_name',
        'category_name',
        'product_unit',
        'transaction_detail_discount',
        'transaction_detail_price',
        'transaction_detail_quantity',
        'transaction_detail_total'
    ];
}
