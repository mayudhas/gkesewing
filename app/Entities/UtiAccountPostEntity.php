<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UtiAccountPostEntity extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'uti_account_post_id' => '?integer',
        'uti_account_post_name' => 'string',
        'uti_account_post_alias' => 'string'
    ];
}
