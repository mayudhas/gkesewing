<?php

namespace App\Entities;

use App\Models\UtiAccountGroupModel;
use App\Models\UtiAccountPostModel;
use CodeIgniter\Entity\Entity;

class AkunEntity extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'account_code' => 'integer',
        'account_name' => 'string',
        'uti_account_post_id' => 'integer',
        'uti_account_group_id' => 'integer',
        'uti_account_post' => 'object',
        'uti_account_group' => 'object',
    ];
    protected $attributes = [
        'uti_account_post' => [],
        'uti_account_group' => [],
    ];

    public function getUtiAccountPost(): array|object
    {
        $this->attributes['uti_account_post'] = (new UtiAccountPostModel())->find($this->attributes['uti_account_post_id']);
        return $this->attributes['uti_account_post'];
    }

    public function getUtiAccountGroup(): array|object
    {
        $this->attributes['uti_account_group'] = (new UtiAccountGroupModel())->find($this->attributes['uti_account_group_id']);
        return $this->attributes['uti_account_group'];
    }
}
