<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;
use App\Models\ProductsModel;

class HomeController extends BaseController
{
	public function __construct()
	{
		$this->categories = new CategoriesModel();
		$this->products = new ProductsModel();
	}

	public function index()
	{
		$data = [
			'categories' => $this->categories->getCategories(),
			'products'	=> $this->products->getProducts(),
			'validation' => \Config\Services::validation()
		];
		return view('frontend/pages/home', $data);
	}

	public function search()
	{
		$keyword = $this->request->getVar('search');
		$product = $keyword ? $this->products->searchProduct($keyword) : $this->products->getProducts();
		$data = [
			'categories' => $this->categories->getCategories(),
			'products'	=> $product,
			'validation' => \Config\Services::validation()
		];
		return view('frontend/pages/home', $data);
	}
}
