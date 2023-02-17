<?php

namespace Panel\User\Services;

use App\Entities\UserEntity;
use App\Models\KaryawanModel;
use App\Models\UserLevelModel;
use App\Models\UserModel;
use ReflectionException;

class UserService
{

    public function __construct(private UserModel $userModel, private UserLevelModel $userLevelModel, private KaryawanModel $karyawanModel)
    {
    }

    public function fetch($request): array
    {
        return $this->userModel->findAll();
    }

    /**
     * @throws ReflectionException
     */
    public function store($request): int
    {
        $userEntity = new UserEntity($request->getPost());
        if ($request->getPost('employee_id')) {
            $employee = $this->karyawanModel->find($request->getPost('employee_id'));
            $userEntity->user_name = $employee->employee_name;
        }
        return $this->userModel->insert($userEntity);
    }

    public function delete($accountCode): int
    {
        return $this->userModel->delete($accountCode);
    }

    /**
     * @throws ReflectionException
     */
    public function update($accountCode, $request): int
    {
        $update = $request->getPost();
        if ($request->getPost('user_is_active')) $update['user_is_active'] = 1;
        else $update['user_is_active'] = 0;
        $accountCodeEntity = new UserEntity($update);
        return $this->userModel->update($accountCode, $accountCodeEntity);
    }

    public function fetchUserLevelModel(): array
    {
        return $this->userLevelModel->findAll();
    }

    public function fetchEmployeeNotExistInUsers(): array
    {
        return $this->karyawanModel->builder()->where(" NOT EXISTS (SELECT * FROM user WHERE employee.employee_id = user.employee_id)")->get()->getResultArray();
    }

}