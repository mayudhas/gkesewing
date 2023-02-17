<?php

namespace Panel\Transaksi\Services;

use App\Entities\PengeluaranEntity;
use App\Helpers\CookieHelper;
use App\Models\KaryawanModel;
use App\Models\PemasokModel;
use App\Models\PengeluaranModel;
use Exception;
use ReflectionException;

class PengeluaranService
{

    public function __construct(private PengeluaranModel $pengeluaranModel, private PemasokModel $pemasokModel, private KaryawanModel $karyawanModel)
    {
    }

    public function fetch($request): array
    {
        $where = [];
        if ($request->getGet('start') && $request->getGet('end')) {
            $where["spending_date >="] = $request->getGet('start');
            $where["spending_date <="] = $request->getGet('end');
        }
        return $this->pengeluaranModel->where($where)->findAll();
    }

    public function fetchSuppliers($request): array
    {
        return $this->pemasokModel->findAll();
    }

    public function fetchEmployees($request): array
    {
        return $this->karyawanModel->findAll();
    }

    public final function fetchNoLedger(): array
    {
        $query = $this->_query();
        return $query->where('is_ledger !=', 1)->findAll();
    }

    private function _query(): PengeluaranModel
    {
        return $this->pengeluaranModel
            ->join('employee', 'employee_id')
            ->join('supplier', 'supplier_id', 'left')
            ->orderBy('spending_date', 'asc');
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function store($request): int
    {
        $spendingPhotoPathRaw = $request->getFile('spending_photo_path');
        $spendingPhotoPath = null;
        if ($spendingPhotoPathRaw->getName()) {
            $fileType = ['image/jpg', 'image/jpeg', 'image/gif', 'image/png'];
            if (!in_array($spendingPhotoPathRaw->getMimeType(), $fileType))
                throw new Exception('Jenis file tidak diizinkan');
            if (!$spendingPhotoPathRaw->hasMoved()) {
                $path = $spendingPhotoPathRaw->getRandomName();
                $spendingPhotoPathRaw->move(ROOTPATH . 'public/' . 'data/img/pengeluaran/', $path);
                $spendingPhotoPath = 'data/img/pengeluaran/' . $path;
            } else {
                throw new Exception('Gagal upload foto');
            }
        } else {
            throw new Exception('Foto bukti / kuitansi tidak ditemukan');
        }
        $pengeluaranEntity = new PengeluaranEntity($request->getPost());
        $pengeluaranEntity->employee_id = $request->getPost('employee_id') ?? CookieHelper::getCookie()->employee_id;
        $pengeluaranEntity->supplier_id = $request->getPost('supplier_id');
        $pengeluaranEntity->spending_date = $request->getPost('spending_date');
        $pengeluaranEntity->spending_desc = $request->getPost('spending_desc');
        $pengeluaranEntity->spending_total = (float)$request->getPost('spending_total');
        $pengeluaranEntity->is_ledger = 0;
        $pengeluaranEntity->spending_photo_path = $spendingPhotoPath;
        return $this->pengeluaranModel->insert($pengeluaranEntity);
    }

    public function delete(int $spendingId): int
    {
        return $this->pengeluaranModel->delete($spendingId);
    }

    /**
     * @throws ReflectionException
     */
    public function update(int $spendingId, $request): int
    {
        $spendingEntity = new PengeluaranEntity($request->getPost());
        return $this->pengeluaranModel->update($spendingId, $spendingEntity);
    }

}