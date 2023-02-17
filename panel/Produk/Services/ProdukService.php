<?php

namespace Panel\Produk\Services;

use App\Models\ProdukModel;
use App\Models\UtiProductCategoryModel;
use CodeIgniter\HTTP\Request;
use ReflectionException;

class ProdukService
{

    public function __construct(public ProdukModel $produkModel, public UtiProductCategoryModel $utiProductCategoryModel)
    {
    }

    public function fetch($request): array
    {
        return $this->produkModel->findAll();
    }

    public final function fetchJoinCategory(int $productID = null): array|object
    {
        $build = $this->produkModel
            ->join('uti_product_category', 'uti_product_category_id');
        if ($productID) {
            return $build->find($productID);
        } else {
            return $build->findAll();
        }
    }

    public final function fetchUtiProductCategory($request): array
    {
        return $this->utiProductCategoryModel->findAll();
    }

    /**
     * @throws ReflectionException
     */
    public function store($request): int
    {
        $insert = [
            'product_name' => $request->getPost('product_name'),
            'product_unit' => $request->getPost('product_unit'),
            'product_price' => $request->getPost('product_price'),
            'product_buy' => $request->getPost('product_buy'),
            'uti_product_category_id' => $request->getPost('uti_product_category_id'),
            'product_status' => $request->getPost('product_status')
        ];
        return $this->produkModel->insert($insert);
    }

    public function delete($productId): int
    {
        return $this->produkModel->delete($productId);
    }

    /**
     * @throws ReflectionException
     */
    public function update($productId, $request): int
    {
        $update = [
            'product_name' => $request->getPost('product_name'),
            'product_unit' => $request->getPost('product_unit'),
            'product_price' => (float)$request->getPost('product_price'),
            'product_buy' => (float)$request->getPost('product_buy'),
            'uti_product_category_id' => (int)$request->getPost('uti_product_category_id'),
            'product_status' => (int)$request->getPost('product_status')
        ];
        return $this->produkModel->update($productId, $update);
    }

}