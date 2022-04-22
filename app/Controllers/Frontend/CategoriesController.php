<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;
use App\Models\ProductsModel;

class CategoriesController extends BaseController
{
	public function __construct()
	{
		$this->categories = new CategoriesModel();
		$this->products = new ProductsModel();
	}

	public function category($slug)
	{
		$data = [
			'categories' => $this->categories->getCategories(),
			'products'	=> $this->products->getProducts($slug),
			'validation' => \Config\Services::validation()
		];
		return view('frontend/pages/category', $data);
	}
}
