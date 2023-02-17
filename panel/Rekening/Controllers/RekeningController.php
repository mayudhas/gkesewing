<?php

namespace Panel\Rekening\Controllers;

use App\Controllers\CorePanelController;
use App\Helpers\ResponseHelper;
use Panel\Rekening\Config\Services;

class RekeningController extends CorePanelController
{
    protected $pathViews = 'Panel\Rekening\Views\\';
    private \Panel\Rekening\Services\RekeningService $RekeningService;

    public function __construct(
        private Services $servicesRekening
    )
    {
        $this->RekeningService = $this->servicesRekening->rekeningService();
    }

    public function index(): string
    {
        $data['page_title'] = 'Rekening';
        $breadcrumbs = [
            [
                'title' => 'Rekening',
                'href' => base_url('karyawan')
            ]
        ];
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        return $this->render('index', $data);
    }

    public final function loadAccountPost(): \CodeIgniter\HTTP\ResponseInterface
    {
        try {
            $postID = $this->request->getGet('post_id');
            $data = $this->RekeningService->findAccountPost($postID);
            $response = ResponseHelper::getStatusTrue(data: $data);
        } catch (\Exception $exception) {
            $response = ResponseHelper::getStatusFalse($exception->getMessage());
        }
        return $this->response->setJSON($response, $response['statusCode']);
    }

}