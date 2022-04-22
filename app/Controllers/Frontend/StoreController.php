<?php

namespace App\Controllers\Frontend;

use App\Models\ProductsModel;
use App\Models\MerchantsModel;
use App\Models\CategoriesModel;
use App\Controllers\BaseController;

class StoreController extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->products = new ProductsModel();
        $this->merchants = new MerchantsModel();
        $this->categories = new CategoriesModel();
    }

    public function index()
    {
        $idmerchant = $this->request->getVar('id_merchant');

        $merchants = $this->merchants->find($idmerchant);

        $product = $this->products->where('merchant_id', $idmerchant)
            ->findAll();

        $datas = [
            'validation' => '',
            'categories' => $this->categories->getCategories(),
            'merchant' => $merchants,
            'products' => $product,
        ];

        return view('frontend/pages/storedetail', $datas);
    }
}
