<?php

namespace Panel\Bku\Services;

use App\Helpers\CookieHelper;
use App\Helpers\ResponseHelper;
use App\Models\LedgerDetailModel;
use App\Models\LedgerDetailTempModel;
use App\Models\LedgerModel;
use App\Models\PengeluaranModel;
use App\Models\TransactionModel;
use CodeIgniter\HTTP\Request;
use ReflectionException;

class BukuJurnalService
{

    private \CodeIgniter\Database\BaseConnection $DB;

    public function __construct(
        private LedgerModel       $ledgerModel,
        private LedgerDetailModel $ledgerDetailModel,
        private TransactionModel  $transactionModel,
        private PengeluaranModel  $pengeluaranModel,
    )
    {
        $this->DB = db_connect();
    }

    public final function getLedgerPeriode(int $year, int $month): array
    {
        return $this->ledgerModel
            ->where('YEAR(ledger_date)', $year)
            ->where('MONTH(ledger_date)', $month)
            ->orderBy('ledger_number')
            ->findAll();
    }

    public final function getLedgerDetailPeriode(int $year, int $month): array
    {
        return $this->ledgerDetailModel
            ->select('*, 
            if(ledger_detail.uti_account_post_id=1, ledger_detail_score, 0) AS debit_score, 
            if(ledger_detail.uti_account_post_id=2, ledger_detail_score, 0) AS credit_score, 
            (SELECT COUNT(*) jml_row FROM ledger_detail WHERE ledger_detail.ledger_code=ledger.ledger_code) jml_row')
            ->join('account', 'account_code')
            ->join('ledger', 'ledger_code')
            ->where('YEAR(ledger_date)', $year)
            ->where('MONTH(ledger_date)', $month)
            ->findAll();
    }

    /**
     * @throws ReflectionException
     */
    public final function store(Request $request): array
    {
        $this->DB->transBegin();
        $post = $request->getPost();
        $postID = $post['post_id'];
        $ledgerCode = get_cookie(CookieHelper::$ledger);
        $count = count($post['account_code']);
        $data = [
            'ledger_code' => $ledgerCode,
            'ledger_desc' => $post['ledger_desc'],
            'ledger_number' => $post['ledger_number'],
            'ledger_date' => $post['ledger_date'],
            'ledger_name' => $post['ledger_name'],
        ];
        if ($transaction = $post['transaction']) {
            $field = $postID == 1 ? 'transaction_code' : 'spending_id';
            $data[$field] = $post['transaction'];
            $postID == 1
                ? $this->transactionModel->update($transaction, ['is_ledger' => 1])
                : $this->pengeluaranModel->update($transaction, ['is_ledger' => 1]);
        }

        $dataDetail = [];
        for ($i = 0; $i < $count; $i++) {
            $dd['ledger_code'] = $ledgerCode;
            $dd['account_code'] = $post['account_code'][$i];
            $dd['uti_account_post_id'] = $post['uti_account_post_id'][$i];
            $dd['ledger_detail_score'] = $post['ledger_detail_score'][$i];
            $dataDetail[] = $dd;
        }

        $this->ledgerDetailModel->insertBatch($dataDetail);
        $this->ledgerModel->insert($data);
        if ($this->DB->transStatus() === false) {
            $this->DB->transRollback();
            $response = ResponseHelper::getStatusFalse('Pencatatan gagal');
        } else {
            $this->DB->transCommit();
            $response = ResponseHelper::getStatusTrue('Pencatatan berhasil');
        }
        return $response;
    }


    /**
     * @throws ReflectionException
     */
    public final function delete(int $id): array
    {
        $ledger = $this->ledgerModel->find($id);
        $this->DB->transBegin();
        if ($ledger->transaction_code) {
            $this->transactionModel->update($ledger->transaction_code, ['is_ledger' => 0]);
        }
        if ($ledger->spending_id) {
            $this->pengeluaranModel->update($ledger->spending_id, ['is_ledger' => 0]);
        }
        $this->ledgerModel->delete($id);
        if ($this->DB->transStatus() === false) {
            $this->DB->transRollback();
            $response = ResponseHelper::getStatusFalse('Menghapus data gagal');
        } else {
            $this->DB->transCommit();
            $response = ResponseHelper::getStatusTrue('Menghapus data berhasil');
        }
        return $response;

    }

}