<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class KaryawanEntity extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'employee_id' => '?integer',
        'employee_name' => 'string',
        'employee_phone' => 'string',
        'employee_status' => 'integer',
        'employee_type' => 'string',
        'employee_photo_path' => '?string',
    ];
}
