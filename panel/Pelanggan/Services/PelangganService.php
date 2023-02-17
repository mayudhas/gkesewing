<?php

namespace Panel\Pelanggan\Services;

use App\Models\PelangganModel;
use ReflectionException;

class PelangganService
{

    public function __construct(public PelangganModel $pelangganModel)
    {
    }

    public function fetch($request): array
    {
        return $this->pelangganModel->findAll();
    }

    public final function firstPhone(string $customerPhone): object|array|null
    {
        return $this->pelangganModel->where(['customer_phone' => $customerPhone])->findAll();
    }

    /**
     * @throws ReflectionException
     */
    public function store($request): int
    {
        $insert = [
            'customer_phone' => $request->getPost('customer_phone'),
            'customer_name' => $request->getPost('customer_name'),
            'customer_address' => $request->getPost('customer_address')
        ];
        return $this->pelangganModel->insert($insert);
    }

    public function delete($customerId): int
    {
        return $this->pelangganModel->delete($customerId);
    }

    /**
     * @throws ReflectionException
     */
    public function update($customerId, $request): int
    {
        $update = [
            'customer_phone' => $request->getPost('customer_phone'),
            'customer_name' => $request->getPost('customer_name'),
            'customer_address' => $request->getPost('customer_address')
        ];
        return $this->pelangganModel->update($customerId, $update);
    }

}