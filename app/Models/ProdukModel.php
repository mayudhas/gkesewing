<?php

namespace App\Models;

use App\Entities\ProdukEntity;
use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    protected $returnType = ProdukEntity::class;
    protected $protectFields = true;
    protected $allowedFields = ['product_name', 'product_unit', 'product_price', 'product_buy', 'uti_product_category_id', 'product_status'];
}
