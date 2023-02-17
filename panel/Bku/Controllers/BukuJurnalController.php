<?php

namespace Panel\Bku\Controllers;

use App\Controllers\CorePanelController;
use App\Enums\MonthEnum;
use App\Helpers\CookieHelper;
use App\Helpers\ResponseHelper;
use App\Models\UtiAccountPostModel;
use Panel\Bku\Config\Services;

class   BukuJurnalController extends CorePanelController
{
    protected $pathViews = 'Panel\Bku\Views\buku-jurnal\\';
    private \Panel\Bku\Services\BukuJurnalService $BukuJurnalService;
    private \Panel\Rekening\Services\RekeningService $RekeningService;

    public function __construct(
        private UtiAccountPostModel             $accountPostModel,
        private Services                        $serviceBku,
        private \Panel\Rekening\Config\Services $servicesRekening
    )
    {
        $this->BukuJurnalService = $this->serviceBku->serviceBukuJurnal();
        $this->RekeningService = $this->servicesRekening->rekeningService();
    }

    public final function index(): string
    {
        if ($this->request->getGet('reset') == true) {
            delete_cookie(CookieHelper::$ledger);
        }
        $breadcrumbs = [
            ['title' => 'BKU', 'href' => '#'],
            ['title' => 'Buku Jurnal', 'href' => uri_string()]
        ];
        $data['page_title'] = 'BKU-Jurnal';
        $params = [
            'month' => $this->request->getGet('month') ?? date('m'),
            'year' => $this->request->getGet('year') ?? date('Y'),
        ];
        $data['months'] = MonthEnum::monthIndo();
        $data['posts'] = $this->accountPostModel->findAll();
        $data['accounts'] = $this->RekeningService->fetch();
        $data['ledgers'] = $this->BukuJurnalService->getLedgerDetailPeriode($params['year'], $params['month']);
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        return $this->render('index', array_merge($data, compact('params')));
    }

    public final function detail(): string
    {
        CookieHelper::setCodeLedger();
        $data['page_title'] = 'Ledger Detail';
        $params = [
            'month' => $this->request->getGet('month'),
            'year' => $this->request->getGet('year'),
        ];
        $breadcrumbs = [
            ['title' => 'Buku Jurnal', 'href' => base_url('buku-jurnal')],
            ['title' => 'Detail ', 'href' => '#']
        ];
        $data['ledgers'] = $this->BukuJurnalService->getLedgerPeriode($params['year'], $params['month']);
        $data['posts'] = $this->accountPostModel->findAll();
        $data['accounts'] = $this->RekeningService->fetch();
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        return $this->render('detail', $data);
    }

    public final function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            checkCsrfToken($this->request->getPost('_token'));
            $response = $this->BukuJurnalService->store($this->request);
        } catch (\Exception $exception) {
            $response = ResponseHelper::getStatusFalse($exception->getMessage());
        }
        if ($response['status']) {
            setAlert('Berhasil menambah data !');
            return redirect()->to('bku/buku-jurnal?reset=true');
        } else {
            setAlert($response['message'], 'error');
            return redirect()->back();
        }
    }

    public final function delete(int $id): \CodeIgniter\HTTP\ResponseInterface
    {
        try {
            $response = $this->BukuJurnalService->delete($id);
        } catch (\Exception $exception) {
            $response = ResponseHelper::getStatusFalse($exception->getMessage());
        }
        return $this->response->setJSON($response, $response['statusCode']);
    }

}