<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\CategoriesModel;
use App\Models\ProductsModel;
use App\Models\MerchantsModel;

class ProductController extends BaseController
{
	public function __construct()
	{
		$this->products = new ProductsModel();
		$this->categories = new CategoriesModel();
		$this->merchants = new MerchantsModel();
		$this->cart = new CartModel();
	}

	public function index()
	{
		$data = [
			'meta_title' => 'Product',
			'pages_slug' => 'product',
			'products'	=> $this->products->getProducts(),
			'categories' => $this->categories->getCategories(),
			'validation' => \Config\Services::validation()
		];
		return view('frontend/pages/produk', $data);
	}

	public function show()
	{
		$data = [
			'meta_title' => 'Product',
			'pages_slug' => 'product',
			'products' => $this->products->getProducts(),
			'categories' => $this->categories->getCategories(),
			'validation' => \Config\Services::validation()
		];
		return view('frontend/pages/produk', $data);
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

		$merchants = $this->merchants->find($this->request->getVar('merchant_id'));

		$image = $this->request->getFile('product_thumbnail');
		$product_thumbnail_name = $image->getRandomName();
		$image->move('assets/images/merchants/' . $merchants['store_name'] . '/', $product_thumbnail_name);

		$data = [
			'product_name' => $this->request->getVar('product_name'),
			'category_id' => $this->request->getVar('category_id'),
			'merchant_id' => $this->request->getVar('merchant_id'),
			'product_price' => $this->request->getVar('product_price'),
			'product_status' => $this->request->getVar('product_status'),
			'product_thumbnail' => $merchants['store_name'] . '/' . $product_thumbnail_name,
			'product_description' => $this->request->getVar('product_description'),
			'stock' => $this->request->getVar('stock'),
			'slug' => url_title($this->request->getVar('product_name'), '-', true),
		];

		$this->products->save($data) ? session()->setFlashdata('success', 'Berhasil Mengirim Data Produk') :
			session()->setFlashdata('fail', 'Gagal Mengirim Data Produk');
		return redirect()->to('/profile');
	}

	public function detail($slug)
	{
		$data = [
			'categories' => $this->categories->getCategories(),
			'products'	=> $this->products->getProducts(),
			'validation' => \Config\Services::validation()
		];

		return view('frontend/pages/homePages/product-details', $data);
	}

	public function addtocart()
	{
		$jumlahProduk = $this->request->getVar('jumlahProduk');

		$id_user = user_id();
		$dataadd = [
			'id_user' => $id_user,
			'id_product' => $this->request->getVar('id_product'),
			'id_merchant' => $this->request->getVar('id_merchant'),
			'jumlah_produk' => $jumlahProduk
		];

		$productCheck = $this->cart->where(['id_user' => $dataadd['id_user'], 'id_product' => $dataadd['id_product'], 'id_merchant' => $dataadd['id_merchant']])
			->get()->getResult('array');

		if (count($productCheck) > 0) {
			$dataadd['id_card'] = $productCheck[0]['id_card'];
			$this->cart->save($dataadd) ? session()->setFlashdata('success', 'Berhasil Menambah Produk') :
				session()->setFlashdata('fail', 'Gagal Menambah Produk');
			return redirect()->to('/cart');
		} else {
			$this->cart->save($dataadd) ? session()->setFlashdata('success', 'Berhasil Menambah Produk') :
				session()->setFlashdata('fail', 'Gagal Menambah Produk');
			return redirect()->to('/cart');
		}
	}
}
