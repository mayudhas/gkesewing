<?php

namespace Panel\Laporan\Services;

use App\Models\AkunModel;
use App\Models\LedgerModel;
use CodeIgniter\HTTP\Request;

class BukuBesarService
{

    public function __construct(private LedgerModel $ledgerModel, private AkunModel $akunModel)
    {
    }

    public function fetchLaporan(Request $request): array
    {
        $startDate = $request->getGet('start') ?: null;
        $endDate = $request->getGet('end') ?: null;
        if (!($startDate && $endDate)) {
            return [];
        }
        $dataBukuBesar = $this->ledgerModel
            ->join("ledger_detail AS b", "ledger.ledger_code = b.ledger_code", "left")
            ->join("account AS c", "b.account_code = c.account_code", "left")
            ->join("uti_account_post AS d", "c.uti_account_post_id = d.uti_account_post_id", "left")
            ->where("ledger.ledger_date BETWEEN '{$startDate}' AND '{$endDate}'")
            ->orderBy('c.account_code, ledger.ledger_number')
            ->findAll();

        if (!(count($dataBukuBesar) > 0)) {
            return [];
        }

        $accountCode = array_unique(array_column($dataBukuBesar, 'account_code'));

        $dataAccountCode = $this->akunModel->whereIn('account_code', $accountCode)->findAll();

        $result = array();
        foreach ($dataAccountCode as $valAccountCode) {
            $dataDetail = [];
            $dataDebit = 0;
            $dataKredit = 0;
            $totalAkumulasi = 0;
            foreach ($dataBukuBesar as $iBukuBesar => $valBukuBesar)
                if ($valAccountCode->account_code == $valBukuBesar->account_code) {
                    $valBukuBesar->total = $valBukuBesar->ledger_detail_score + $totalAkumulasi;
                    $totalAkumulasi = $valBukuBesar->total;
                    $dataDetail[] = $valBukuBesar;
                    if ($valBukuBesar->uti_account_post_id == 1) {
                        $dataDebit += $valBukuBesar->ledger_detail_score;
                    } elseif ($valBukuBesar->uti_account_post_id == 2) {
                        $dataKredit += $valBukuBesar->ledger_detail_score;
                    }
                }
            $valAccountCode->debit = $dataDebit;
            $valAccountCode->kredit = $dataKredit;
            $valAccountCode->detail = $dataDetail;
            $result[] = $valAccountCode;
        }
        return $result;
    }

}