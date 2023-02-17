<?php

namespace App\Models;

use App\Entities\KaryawanEntity;
use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'employee_id';
    protected $returnType = KaryawanEntity::class;
    protected $protectFields = true;
    protected $allowedFields = ['employee_name', 'employee_phone', 'employee_status', 'employee_type', 'employee_photo_path'];
}
