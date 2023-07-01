<?php

namespace Panel\Laporan\Controllers;

use App\Controllers\CorePanelController;
use Panel\Laporan\Config\Service;

class BukuBesarController extends CorePanelController
{

    protected $pathViews = 'Panel\Laporan\Views\buku-besar\\';

    public function __construct(private Service $service)
    {
    }

    public function index(): string
    {
        $data['page_title'] = 'Buku Besar';
        $breadcrumbs = [
            [
                'title' => 'Buku Besar',
                'href' => base_url('laporan/buku-besar')
            ]
        ];
        $data['laporan'] = $this->service->bukuBesarService()->fetchLaporan($this->request);
        $data['start'] = $this->request->getGet('start') ?: null;
        $data['end'] = $this->request->getGet('end') ?: null;
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        return $this->render('index', $data);
    }

}