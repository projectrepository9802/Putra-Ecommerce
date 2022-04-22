<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;

class CartController extends BaseController
{
    public function __construct()
    {
        $this->categories = new CategoriesModel();
    }

    public function index()
    {
        $datas = [
            'validation' => '',
            'categories' => $this->categories->getCategories(),
        ];

        return view('frontend/pages/cart', $datas);
    }
}
