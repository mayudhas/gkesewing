<?php

namespace Panel\Pemasok\Services;

use App\Models\PemasokModel;
use ReflectionException;

class PemasokService
{

    public function __construct(public PemasokModel $pemasokModel)
    {
    }

    public function fetch($request): array
    {
        return $this->pemasokModel->findAll();
    }

    /**
     * @throws ReflectionException
     */
    public function store($request): int
    {
        $insert = [
            'supplier_company' => $request->getPost('supplier_company'),
            'supplier_name' => $request->getPost('supplier_name'),
            'supplier_phone' => $request->getPost('supplier_phone'),
            'supplier_address' => $request->getPost('supplier_address'),
        ];
        return $this->pemasokModel->insert($insert);
    }

    public function delete($supplierId): int
    {
        return $this->pemasokModel->delete($supplierId);
    }

    /**
     * @throws ReflectionException
     */
    public function update($supplierId, $request): int
    {
        $update = [
            'supplier_company' => $request->getPost('supplier_company'),
            'supplier_name' => $request->getPost('supplier_name'),
            'supplier_phone' => $request->getPost('supplier_phone'),
            'supplier_address' => $request->getPost('supplier_address'),
        ];
        return $this->pemasokModel->update($supplierId, $update);
    }

}