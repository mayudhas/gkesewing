<?php

namespace App\Models;

use App\Entities\UtiProductCategoryEntity;
use CodeIgniter\Model;

class UtiProductCategoryModel extends Model
{
    protected $table = 'uti_product_category';
    protected $primaryKey = 'uti_product_category_id';
    protected $returnType = UtiProductCategoryEntity::class;
    protected $protectFields = true;
    protected $allowedFields = ['uti_product_category_name'];
}
