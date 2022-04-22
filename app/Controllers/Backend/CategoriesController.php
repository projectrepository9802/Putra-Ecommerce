<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;

class CategoriesController extends BaseController
{
	public function __construct()
	{
		$this->categories = new CategoriesModel();
	}

	public function index()
	{
		$title = 'Kategori';
		$data = [
			'meta_title' 	=> $title . ' | Admin Panel',
			'title'			=> $title,
			'categories' 	=> $this->categories->getCategories(),
			'validation' 	=> \Config\Services::validation(),
			'pages_slug'	=> 'categories'
		];
		return view('backend/pages/categories', $data);
	}

	public function addCategory()
	{
		if (!$this->validate([
			'category_name'			=> [
				'rules'				=> 'required|is_unique[categories.category_name]|min_length[5]|max_length[30]',
				'errors'			=> [
					'required'		=> 'Nama kategori harus diisi',
					'is_unique'		=> 'Nama kategori sudah digunakan',
					'min_length' 	=> 'Nama kategori minimal 5 karakter',
					'max_length' 	=> 'Nama kategori maximal 30 karakter'
				],
			],
			'icon'					=> [
				'rules'				=> 'required',
				'errors'			=> [
					'required'		=> 'Icon harus diisi'
				]
			],
		])) {
			return redirect()->to('/admin/categories')->withInput();
		}
		$data = [
			'category_name'		=> $this->request->getVar('category_name'),
			'category_slug'		=> url_title($this->request->getVar('category_name'), '-', true),
			'icon'				=> $this->request->getVar('icon')
		];
		$this->categories->save($data) ?
			session()->setFlashdata('success', 'Berhasil Menambah Kategori Baru') :
			session()->setFlashdata('fail', 'Gagal Menambah Kategori Baru');
		return redirect()->to('/admin/categories');
	}

	public function updateCategory($id)
	{
		$data = [
			'id'				=> $id,
			'category_name'		=> $this->request->getVar('category_name'),
			'category_slug'		=> url_title($this->request->getVar('category_name')),
			'icon'				=> $this->request->getVar('icon')
		];
		$this->categories->save($data) ?
			session()->setFlashdata('success', 'Berhasil Mengedit Kategori') :
			session()->setFlashdata('fail', 'Gagal Mengedit Kategori');
		return redirect()->to('/admin/categories');
	}

	public function deleteCategory($id)
	{
		$this->categories->delete($id);
		return redirect()->to('/admin/categories');
	}
}
