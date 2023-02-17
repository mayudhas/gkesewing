<?php

namespace Panel\Kode_rekening\Services;

use App\Entities\AkunEntity;
use App\Models\AkunModel;
use App\Models\UtiAccountGroupModel;
use App\Models\UtiAccountPostModel;
use ReflectionException;

class KodeRekeningService
{

    public function __construct(private AkunModel $akunModel, private UtiAccountPostModel $utiAccountPostModel, private UtiAccountGroupModel $utiAccountGroupModel)
    {
    }

    public function fetch($request): array
    {
        return $this->akunModel->findAll();
    }

    /**
     * @throws ReflectionException
     */
    public function store($request): int
    {
        $accountCodeEntity = new AkunEntity($request->getPost());
        return $this->akunModel->insert($accountCodeEntity);
    }

    public function delete($accountCode): int
    {
        return $this->akunModel->delete($accountCode);
    }

    /**
     * @throws ReflectionException
     */
    public function update($accountCode, $request): int
    {
        $accountCodeEntity = new AkunEntity($request->getPost());
        return $this->akunModel->update($accountCode, $accountCodeEntity);
    }

    public function fetchUtiAccountPost(): array
    {
        return $this->utiAccountPostModel->findAll();
    }

    public function fetchUtiAccountGroup(): array
    {
        return $this->utiAccountGroupModel->findAll();
    }

}