<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
	protected $table                = 'products';
	protected $allowedFields        = [
		'product_name', 'category_id', 'merchant_id', 'product_status', 'product_price', 'product_thumbnail', 'product_description', 'stock', 'slug'
	];

	public function getProducts($slug = false)
	{
		if ($slug == false) {
			return $this->findAll();
		}
		$result = $this->select('*')
			->join('categories', 'categories.id = products.category_id')
			->join('merchants', 'merchants.id = products.merchant_id')
			->where(['categories.category_slug' => $slug, 'products.product_status' => 'published'])
			->get()->getResult('array');
		return $result;
	}

	public function searchProduct($keyword)
	{
		$result = $this->table('products')->select('*')
			->join('categories', 'categories.id = products.category_id')
			->join('merchants', 'merchants.id = products.merchant_id')
			->like('product_name', $keyword)
			->orLike('product_description', $keyword)
			->orLike('store_name', $keyword)
			->orLike('category_name', $keyword)
			->orLike('slug', $keyword)
			->get()->getResult('array');
		return $result;
	}
}
