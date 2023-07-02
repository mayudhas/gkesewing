<?php

namespace Panel\Dashboard\Services;

use App\Models\PengeluaranModel;
use App\Models\TransactionModel;

class DashboardService
{

    public function __construct(
        private TransactionModel $transactionModel,
        private PengeluaranModel $pengeluaranModel,
    )
    {
    }

    public function getIncome($year): array
    {
        return $this->transactionModel
            ->select('SUM(transaction_detail.transaction_detail_total) AS total, MONTH(transaction.transaction_date) AS bulan')
            ->join('transaction_detail', 'transaction.transaction_code = transaction_detail.transaction_code')
            ->where('YEAR(transaction.transaction_date)', $year)
            ->groupBy('MONTH(transaction.transaction_date)')
            ->orderBy('bulan ASC')
            ->findAll();
    }

    public function getOutcome($year): array
    {
        return $this->pengeluaranModel
            ->select('SUM(spending_total) AS total, MONTH(spending_date) AS bulan')
            ->where('YEAR(spending_date)', $year)
            ->groupBy('MONTH(spending_date)')
            ->orderBy('bulan ASC')
            ->findAll();
    }

}