<?php

namespace Panel\Transaksi\Services;

use App\Helpers\CookieHelper;
use App\Helpers\ResponseHelper;
use App\Libraries\ResponseLib;
use App\Models\PelangganModel;
use App\Models\TransactionDetailModel;
use App\Models\TransactionDetailTempModel;
use App\Models\TransactionModel;
use CodeIgniter\HTTP\Request;
use Panel\Produk\Config\Services;
use Panel\Produk\Services\ProdukService;
use ReflectionException;

class PenjualanService
{

    private ProdukService $ProductService;
    private \CodeIgniter\Database\BaseConnection $DB;

    public function __construct(
        public TransactionModel           $transactionModel,
        public TransactionDetailModel     $detailModel,
        public TransactionDetailTempModel $detailTempModel,
        public PelangganModel             $pelangganModel,
        public Services                   $servicesProduct,
    )
    {
        $this->ProductService = $this->servicesProduct->produkService();
        $this->DB = db_connect();
    }


    public final function fetch(Request $request): array
    {
        return $this->transactionModel->findAll();
    }

    public final function fetchNoLedger(): array
    {
        $query = $this->_query();
        $builds = $query->where('is_ledger !=', 1)->findAll();
        return $this->_cast($builds);
    }

    public final function fetchDate(string $dateStart, string $dateEnd): array
    {
        $query = $this->_query();
        $builds = $query->where(['transaction_date >=' => $dateStart, 'transaction_date <=' => $dateEnd])->findAll();
        return $this->_cast($builds);
    }

    private function _cast(array $builds): array
    {
        foreach ($builds as $build) {
            $build->total = (int)$build->total;
        }
        return $builds;
    }

    private function _query(): TransactionModel
    {
        return $this->transactionModel
            ->select('*, ceil((SELECT SUM(transaction_detail_total) FROM transaction_detail WHERE transaction_detail.transaction_code=transaction.transaction_code)) as total')
            ->join('employee', 'employee_id')
            ->join('customer', 'customer_phone')
            ->orderBy('transaction_date', 'asc');
    }

    public final function getTransactionDetailTemp(array $where = []): TransactionDetailTempModel
    {
        return $this->detailTempModel->where($where);
    }

    public final function resetTransaction(): void
    {
        $this->detailTempModel->where('transaction_code', get_cookie(CookieHelper::$transaction))->delete();
    }

    /**
     * @throws ReflectionException
     */
    public final function transactionStore(Request $request): array
    {
        $post = $request->getPost();
        $customer = $this->pelangganModel->where(['customer_phone' => $post['customer_phone']])->first();
        $temporaries = $this->detailTempModel->where(['transaction_code' => get_cookie(CookieHelper::$transaction)])->findAll();
        $this->DB->transBegin();
        if (!$customer) {
            $dataCustomer = [
                'customer_phone' => $post['customer_phone'],
                'customer_name' => $post['customer_name'],
                'customer_address' => $post['customer_address'],
            ];
            $this->pelangganModel->insert($dataCustomer);
        }
        $dataTransaction = [
            'transaction_code' => get_cookie(CookieHelper::$transaction),
            'employee_id' => $post['employee_id'],
            'customer_phone' => $post['customer_phone'],
            'transaction_date' => $post['transaction_date'],
            'transaction_desc' => $post['transaction_desc'],
        ];
        $this->transactionModel->insert($dataTransaction);
        $this->detailModel->insertBatch($temporaries);
        if ($this->DB->transStatus() === false) {
            $this->DB->transRollback();
            $response = ResponseHelper::getStatusFalse('Transaksi gagal');
        } else {
            $this->DB->transCommit();
            delete_cookie(CookieHelper::$transaction);
            $this->resetTransaction();
            $response = ResponseHelper::getStatusTrue('Transaksi berhasil');
        }
        return $response;
    }


    /**
     * @throws ReflectionException
     * @throws \Exception
     */
    public final function temporaryStore(\CodeIgniter\HTTP\Request $request): bool|\CodeIgniter\Database\BaseResult
    {
        checkCsrfToken($request->getPost('_token'));
        $post = $request->getPost();
        $product = $this->ProductService->fetchJoinCategory($post['product_id']);
        if (!$product) throw new \Exception('Produk tidak ditemukan dalam database.');
        $temp = $this->detailTempModel->where(['transaction_code' => get_cookie(CookieHelper::$transaction), 'product_id' => $post['product_id']])->first();
        if ($temp) {
            $quantity = $post['quantity'] + $temp->transaction_detail_quantity;
            $data = [
                'transaction_detail_discount' => $post['discount'] + $temp->transaction_detail_discount,
                'transaction_detail_quantity' => $quantity,
                'transaction_detail_total' => (int)($post['price'] * $quantity) - $post['discount'],
            ];
            return $this->detailTempModel->update($temp->detail_id, $data);
        } else {
            $insert = [
                'transaction_code' => get_cookie(CookieHelper::$transaction),
                'product_id' => $post['product_id'],
                'product_name' => $product->product_name,
                'category_name' => $product->uti_product_category_name,
                'product_unit' => $product->product_unit,
                'transaction_detail_discount' => $post['discount'],
                'transaction_detail_price' => $post['price'],
                'transaction_detail_quantity' => $post['quantity'],
                'transaction_detail_total' => ($post['quantity'] * $post['price']) - $post['discount']
            ];
            return $this->detailTempModel->insert($insert);
        }

    }

    public final function temporaryDelete(int $id): int
    {
        return $this->detailTempModel->delete($id);
    }

    /**
     * @throws ReflectionException
     */
//    public function update($customerId, $request): int
//    {
//        $update = [
//            'customer_phone' => $request->getPost('customer_phone'),
//            'customer_name' => $request->getPost('customer_name'),
//            'customer_address' => $request->getPost('customer_address')
//        ];
//        return $this->pelangganModel->update($customerId, $update);
//    }

}