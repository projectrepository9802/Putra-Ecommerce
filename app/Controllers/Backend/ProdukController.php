<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\ProductsModel;

class ProdukController extends BaseController
{
	public function __construct()
	{
		$this->products = new ProductsModel();
	}

	public function index()
	{
		return view('backend/pages/produk/index');
	}

	public function detail($id)
	{
		return view('backend/pages/produk/detail');
	}

	public function add()
	{
		if (!$this->validate([
			'product_name' 			=> [
				'rules' 			=> 'required',
				'errors' 			=> [
					'required' 		=> 'Nama produk harus diisi'
				]
			],
			'category_id'			=> [
				'rules'				=> 'required',
				'errors'			=> [
					'required'		=> 'Kategori produk harus diisi'
				]
			],
			'product_price'			=> [
				'rules'				=> 'required',
				'errors'			=> [
					'required'		=> 'Harga produk harus diisi'
				]
			],
			'product_status'		=> [
				'rules'				=> 'required',
				'errors'			=> [
					'required'		=> 'Pilih salah satu status'
				]
			],
			'product_thumbnail'		=> [
				'rules'				=> 'uploaded[product_thumbnail]|max_size[product_thumbnail,1024]|is_image[product_thumbnail]|mime_in[product_thumbnail,image/jpg,image/jpeg,image/png]',
				'errors'			=> [
					'uploaded' 		=> 'Gambar produk harus diisi',
					'max_size' 		=> 'Ukuran gambar terlalu besar (Max 1 mb)',
					'is_image' 		=> 'File yang diupload bukan jpg/jpeg/png',
					'mime_in' 		=> 'File yang diupload bukan jpg/jpeg/png'
				]
			],
			'product_description' 	=> [
				'rules'				=> 'required',
				'errors'			=> [
					'required'		=> 'Deskripsi product harus diisi'
				]
			],
			'stock'					=> [
				'rules'				=> 'required',
				'errors'			=> [
					'required'		=> 'Stock produk harus diisi'
				]
			],
		])) {
			return redirect()->to('/profile')->withInput();
		}

		$image = $this->request->getFile('product_thumbnail');
		$product_thumbnail_name = $image->getRandomName();
		$image->move('assets/images/merchants', $product_thumbnail_name);

		$data = [
			'product_name' => $this->request->getVar('product_name'),
			'category_id' => $this->request->getVar('category_id'),
			'merchant_id' => $this->request->getVar('merchant_id'),
			'product_price' => $this->request->getVar('product_price'),
			'product_status' => $this->request->getVar('product_status'),
			'product_thumbnail' => $product_thumbnail_name,
			'product_description' => $this->request->getVar('product_description'),
			'stock' => $this->request->getVar('stock'),
			'slug' => url_title($this->request->getVar('product_name'), '-', true),
		];

		$this->products->save($data) ? session()->setFlashdata('success', 'Berhasil Mengirim Request Keanggotaan') :
			session()->setFlashdata('fail', 'Gagal Mengirim Request Keanggotaan');
		return redirect()->to('/profile');
	}
}
