<?php

namespace App\Entities;

use App\Models\KaryawanModel;
use App\Models\PemasokModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

/**
 * @property array|bool|Time|float|int|object|string|null $employee_id
 * @property array|bool|Time|float|int|object|string|null $supplier_id
 * @property array|bool|Time|float|int|object|string|null $spending_date
 * @property array|bool|Time|float|int|object|string|null $spending_desc
 * @property array|bool|Time|float|int|object|string|null $spending_total
 * @property array|bool|Time|float|int|object|string|null $is_ledger
 * @property array|bool|Time|float|int|object|string|null $spending_photo_path
 */
class PengeluaranEntity extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'spending_id' => '?integer',
        'employee_id' => 'integer',
        'supplier_id' => 'integer|null',
        'spending_date' => 'string',
        'spending_desc' => 'string',
        'spending_total' => 'integer',
        'spending_photo_path' => '?string',
        'is_ledger' => 'integer'
    ];

    protected $attributes = [
        'employee' => [],
        'supplier' => [],
    ];

    public function getEmployee(): array|object|null
    {
        $this->attributes['employee'] = (new KaryawanModel())->find($this->attributes['employee_id']);
        return $this->attributes['employee'];
    }

    public function getSupplier(): array|object|null
    {
        $this->attributes['supplier'] = (new PemasokModel())->find($this->attributes['supplier_id']);
        return $this->attributes['supplier'];
    }
}
