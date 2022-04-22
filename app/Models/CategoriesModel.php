<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriesModel extends Model
{
	protected $table                = 'categories';
	protected $allowedFields        = ['category_name', 'icon', 'category_slug',];

	public function getCategories()
	{
		$result = $this->select('categories.id, categories.category_slug, categories.category_name, categories.icon, COUNT(DISTINCT products.id) as total_product')
			->join('products', 'products.category_id = categories.id', 'left')
			->groupBy('categories.category_name')
			->get()->getResult('array');
		return $result;
	}
}
