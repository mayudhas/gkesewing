<?php

namespace Panel\Karyawan\Services;

use App\Models\KaryawanModel;
use Exception;
use ReflectionException;

class KaryawanService
{

    public function __construct(public KaryawanModel $karyawanModel)
    {
    }

    public function fetch($request): array
    {
        return $this->karyawanModel->findAll();
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function store($request): int
    {
        $employeePhotoPathRaw = $request->getFile('employee_photo_path');
        $employeePhotoPath = null;
        if ($employeePhotoPathRaw->getName()) {
            $fileType = ['image/jpg', 'image/jpeg', 'image/gif', 'image/png'];
            if (!in_array($employeePhotoPathRaw->getMimeType(), $fileType))
                throw new Exception('Jenis file tidak diizinkan');
            if (!$employeePhotoPathRaw->hasMoved()) {
                $path = $employeePhotoPathRaw->getRandomName();
                $employeePhotoPathRaw->move(ROOTPATH . 'public/' . 'data/img/employee/', $path);
                $employeePhotoPath = 'data/img/employee/' . $path;
            } else {
                throw new Exception('Gagal upload foto');
            }
        }
        $insert = [
            'employee_name' => $request->getPost('employee_name'),
            'employee_phone' => $request->getPost('employee_phone'),
            'employee_type' => $request->getPost('employee_type'),
            'employee_status' => (int)$request->getPost('employee_status'),
            'employee_photo_path' => $employeePhotoPath,
        ];
        return $this->karyawanModel->insert($insert);
    }

    public function delete($employeeId): int
    {
        return $this->karyawanModel->delete($employeeId);
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function update($employeeId, $request): int
    {
        $update = [
            'employee_name' => $request->getPost('employee_name'),
            'employee_phone' => $request->getPost('employee_phone'),
            'employee_type' => $request->getPost('employee_type'),
            'employee_status' => (int)$request->getPost('employee_status')
        ];
        $employeePhotoPathRaw = $request->getFile('employee_photo_path');
        if ($employeePhotoPathRaw->getName()) {
            $fileType = ['image/jpg', 'image/jpeg', 'image/gif', 'image/png'];
            if (!in_array($employeePhotoPathRaw->getMimeType(), $fileType))
                throw new Exception('Jenis file tidak diizinkan');
            if (!$employeePhotoPathRaw->hasMoved()) {
                $path = $employeePhotoPathRaw->getRandomName();
                $employeePhotoPathRaw->move(ROOTPATH . 'public/' . 'data/img/employee/', $path);
                $employeePhotoPath = 'data/img/employee/' . $path;
            } else {
                throw new Exception('Gagal upload foto');
            }
            $update['employee_photo_path'] = $employeePhotoPath;
        }
        return $this->karyawanModel->update($employeeId, $update);
    }

}