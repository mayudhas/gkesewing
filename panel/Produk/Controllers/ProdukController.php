<?php

namespace Panel\Produk\Controllers;

use App\Controllers\CorePanelController;
use Panel\Produk\Config\Services;

class ProdukController extends CorePanelController
{

    protected $pathViews = 'Panel\Produk\Views\\';

    public function __construct(private Services $service)
    {
    }

    public function index(): string
    {
        $data['page_title'] = 'Produk';
        $breadcrumbs = [
            [
                'title' => 'Produk',
                'href' => base_url('produk')
            ]
        ];
        $data['producs'] = $this->service->produkService()->fetch($this->request);
        $data['utiProductCategories'] = $this->service->produkService()->fetchUtiProductCategory($this->request);
        $this->view->setVar('breadcrumbs', $breadcrumbs, 'raw');
        return $this->render('index', $data);
    }

    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->produkService()->store($this->request);
            setAlert('Berhasil menambah data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/produk');
    }

    public function delete($productId): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->produkService()->delete($productId);
            setAlert('Berhasil menghapus data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/produk');
    }

    public function update($productId): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            $this->service->produkService()->update($productId, $this->request);
            setAlert('Berhasil memperbarui data !');
        } catch (\Exception $exception) {
            setAlert($exception->getMessage(), 'error');
        }
        return redirect()->to('/produk');
    }

}