<?php

namespace Panel\Pembatalan\Services;

use App\Models\TransactionDetailModel;
use App\Models\TransactionModel;
use CodeIgniter\HTTP\Request;

class PenjualanService
{

    public function __construct(
        private TransactionModel       $transactionModel,
        private TransactionDetailModel $transactionDetailModel,
    )
    {
    }

    public final function findPenjualanCode(string $code): object|array|null
    {
        return $this->transactionModel->find($code);
    }

    public final function getPenjualanDetailCode(string $code): array
    {
        return $this->transactionDetailModel->where('transaction_code', $code)->findAll();
    }

    public final function cancelTransaction(Request $request): bool|\CodeIgniter\Database\BaseResult
    {
        $code = $request->getPost('code');
        return $this->transactionModel->delete($code);
    }


}