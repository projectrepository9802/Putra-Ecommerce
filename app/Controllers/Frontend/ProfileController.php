<?php

namespace App\Controllers\Frontend;

use PDO;
use App\Models\UsersModel;
use App\Models\ProductsModel;
use App\Models\MerchantsModel;
use App\Models\CategoriesModel;
use App\Controllers\BaseController;

class ProfileController extends BaseController
{
	public function __construct()
	{
		$this->db = \Config\Database::connect();
		$this->users = new UsersModel();
		$this->products = new ProductsModel();
		$this->merchants = new MerchantsModel();
		$this->categories = new CategoriesModel();
	}

	public function index()
	{
		$level = $this->db->table('auth_groups_users')->getWhere(['user_id' => user_id()])->getFirstRow('array');
		$profile_status = $this->db->table('merchants')->getWhere(['user_id' => user_id()])->getFirstRow('array');
		$data = [
			'products'  => $this->products->getProducts(),
			'categories'  => $this->categories->getCategories(),
			'level'		=> $level,
			'validation' => \Config\Services::validation(),
			'profile_status' => $profile_status,
		];
		return view('frontend/pages/profile', $data);
	}

	public function upgrade()
	{
		if (!$this->validate([
			'merchant_fullname' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama lengkap harus diisi'
				]
			],
			'merchant_email' => [
				'rules' => 'required|is_unique[merchants.merchant_email]|valid_email',
				'errors' => [
					'required' => 'Email harus diisi',
					'is_unique' => 'Email telah digunakan',
					'valid_email' => 'Email tidak valid',
				]
			],
			'merchant_gender' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Jenis kelamin harus diisi'
				]
			],
			'merchant_phone' => [
				'rules' => 'required|is_unique[merchants.merchant_phone]|numeric|min_length[8]|max_length[12]',
				'errors' => [
					'required' => 'No. Telepon harus diisi',
					'is_unique' => 'No. Telepon telah digunakan',
					'numeric' => 'No. Telepon harus menggunakan angka',
					'min_length' => 'No. Telepon minimal 8 karakter',
					'max_length' => 'No. Telepon maximal 12 karakter',
				]
			],
			'store_name' => [
				'rules' => 'required|is_unique[merchants.store_name]|min_length[8]|max_length[30]',
				'errors' => [
					'required' => 'Nama toko harus diisi',
					'is_unique' => 'Nama toko sudah ada',
					'min_length' => 'Nama toko minimal 8 karakter',
					'max_length' => 'Nama toko maximal 30 karakter',
				]
			],
			'store_address' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Alamat harus diisi'
				]
			],
			'merchant_provinsi' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Alamat harus diisi'
				]
			],
			'merchant_kota' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Alamat harus diisi'
				]
			],
			'merchant_kecamatan' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Alamat harus diisi'
				]
			],
			'merchant_kelurahan' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Alamat harus diisi'
				]
			],
			'store_image' => [
				'rules' => 'uploaded[store_image]|max_size[store_image,1024]|is_image[store_image]|mime_in[store_image,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'uploaded' => 'Gambar toko harus diisi',
					'max_size' => 'Ukuran gambar terlalu besar (Max 1 mb)',
					'is_image' => 'File yang diupload bukan jpg/jpeg/png',
					'mime_in' => 'File yang diupload bukan jpg/jpeg/png'
				]
			],
			'ktp_image' => [
				'rules' => 'uploaded[ktp_image]|max_size[ktp_image,1024]|is_image[ktp_image]|mime_in[ktp_image,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'uploaded' => 'KTP harus diisi',
					'max_size' => 'Ukuran gambar terlalu besar (Max 1 mb)',
					'is_image' => 'File yang diupload bukan jpg/jpeg/png',
					'mime_in' => 'File yang diupload bukan jpg/jpeg/png'
				]
			],
			'store_logo' => [
				'rules' => 'uploaded[store_logo]|max_size[store_logo,1024]|is_image[store_logo]|mime_in[store_logo,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'uploaded' => 'Logo toko harus diisi',
					'max_size' => 'Ukuran gambar terlalu besar (Max 1 mb)',
					'is_image' => 'File yang diupload bukan jpg/jpeg/png',
					'mime_in' => 'File yang diupload bukan jpg/jpeg/png'
				]
			],
		])) {
			return redirect()->to('/profile')->withInput();
		}

		$provinsiToko = explode("-", $this->request->getVar('merchant_provinsi'));
		$kotakabToko = explode("-", $this->request->getVar('merchant_kota'));
		$kecamatanToko = explode("-", $this->request->getVar('merchant_kecamatan'));
		$kelurahanToko = explode("-", $this->request->getVar('merchant_kelurahan'));

		$namaToko = $this->request->getVar('store_name');

		if (!is_dir('assets/images/merchants/' . $namaToko)) {
			mkdir('assets/images/merchants/' . $namaToko, 0777, TRUE);
		}

		$store_image = $this->request->getFile('store_image');
		$store_image_name = $store_image->getRandomName();
		$store_image->move('assets/images/merchants/' . $namaToko, $store_image_name);

		$ktp_image = $this->request->getFile('ktp_image');
		$ktp_image_name = $ktp_image->getRandomName();
		$ktp_image->move('assets/images/merchants/' . $namaToko, $ktp_image_name);

		$store_logo = $this->request->getFile('store_logo');
		$store_logo_name = $store_logo->getRandomName();
		$store_logo->move('assets/images/merchants/' . $namaToko, $store_logo_name);

		$alamatToko = $this->request->getPost('store_address') . " ," . $kelurahanToko[1] . " ," . $kecamatanToko[1] . " ," . $kotakabToko[1] . " ," . $provinsiToko[1];

		$data = [
			'user_id' => $this->request->getVar('user_id'),
			'merchant_fullname' => $this->request->getVar('merchant_fullname'),
			'merchant_email' => $this->request->getVar('merchant_email'),
			'merchant_gender' => $this->request->getVar('merchant_gender'),
			'merchant_phone' => $this->request->getVar('merchant_phone'),
			'store_name' => $this->request->getVar('store_name'),
			'store_slug' => url_title($this->request->getVar('store_name'), '-', true),
			'store_address' => $alamatToko,
			'store_image' => $store_image_name,
			'ktp_image' => $ktp_image_name,
			'store_logo' => $store_logo_name,
		];

		$this->merchants->save($data) ? session()->setFlashdata('success', 'Berhasil Mengirim Request Keanggotaan') :
			session()->setFlashdata('fail', 'Gagal Mengirim Request Keanggotaan');
		return redirect()->to('/profile');
	}

	public function edit()
	{
		if (!$this->validate([
			'emailFields' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Email harus diisi'
				]
			],
			'namalengkapFields' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama Lengkap harus diisi',
				]
			],
			'genderOption' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Jenis kelamin harus diisi'
				]
			],
			'noteleponFields' => [
				'rules' => 'required|numeric|min_length[8]|max_length[12]',
				'errors' => [
					'required' => 'No. Telepon harus diisi',
					'is_unique' => 'No. Telepon telah digunakan',
					'numeric' => 'No. Telepon harus menggunakan angka',
					'min_length' => 'No. Telepon minimal 8 karakter',
					'max_length' => 'No. Telepon maximal 12 karakter',
				]
			],
			'profile_picture' => [
				'rules' => 'uploaded[profile_picture]|max_size[profile_picture, 1024]|is_image[profile_picture]|mime_in[profile_picture,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'uploaded' => 'File gambar belum dipilih',
					'max_size' => 'Ukuran gambar max. 1 Mb',
					'is_image' => 'File yang dipilih bukan gambar',
					'mime_in' => 'File yang dipilih bukan gambar'
				]
			]
		])) {
			return redirect()->to('/profile')->withInput();
		}


		$user = $this->users->find($this->request->getVar('user_id'));

		if ($user['profile_pic'] != "default-user.png") {
			unlink('assets/images/' . $user['profile_pic']);
		}

		$fileProfile = $this->request->getFile('profile_picture');
		$namaFile = $fileProfile->getRandomName();
		$fileProfile->move('assets/images', $namaFile);

		$dataUpdate = [
			'id' => $this->request->getVar('user_id'),
			'email' => $this->request->getVar('emailFields'),
			'fullname' => $this->request->getVar('namalengkapFields'),
			'user_gender' => $this->request->getVar('genderOption'),
			'no_hp' => $this->request->getVar('noteleponFields'),
			'profile_pic' => $namaFile,
		];

		$this->users->save($dataUpdate) ? session()->setFlashdata('success', 'Update profile berhasil') :
			session()->setFlashdata('fail', 'Gagal mengupdate profile');
		return redirect()->to('/profile');
	}

	public function switch()
	{
		$fungsi = $this->request->getVar('fungsi');

		if ($fungsi == "edit") {
			$id = $this->request->getVar('id_produk');

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
					'rules'				=> 'max_size[product_thumbnail,1024]|is_image[product_thumbnail]|mime_in[product_thumbnail,image/jpg,image/jpeg,image/png]',
					'errors'			=> [
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

			$fileProduct = $this->request->getFile('product_thumbnail');
			$merchants = $this->merchants->find($this->request->getVar('merchant_id'));

			if ($fileProduct->getError() == 4) {
				$namaFileProduct = $this->request->getVar('fileProductLama');
			} else {
				$namaFileProduct = $fileProduct->getRandomName();
				$fileProduct->move('assets/images/merchants/' . $merchants['store_name'] . '/', $namaFileProduct);
				unlink('assets/images/merchants/' . $merchants['store_name'] . '/' . $this->request->getVar('fileProductLama'));
			}

			$data = [
				'id' => $this->request->getVar('id'),
				'product_name' => $this->request->getVar('product_name'),
				'category_id' => $this->request->getVar('category_id'),
				'merchant_id' => $this->request->getVar('merchant_id'),
				'product_price' => $this->request->getVar('product_price'),
				'product_status' => $this->request->getVar('product_status'),
				'product_thumbnail' => $merchants['store_name'] . '/' . $namaFileProduct,
				'product_description' => $this->request->getVar('product_description'),
				'stock' => $this->request->getVar('stock'),
				'slug' => url_title($this->request->getVar('product_name'), '-', true),
			];

			$this->products->save($data) ? session()->setFlashdata('success', 'Berhasil Mengupdate Data Produk') :
				session()->setFlashdata('fail', 'Gagal Mengupdate Data Produk');
			return redirect()->to('/profile');
		} elseif ($fungsi == "hapus") {
			$id = $this->request->getVar('id_produk');

			$this->products->delete(['id' => $id]) ? session()->setFlashdata('success', 'Hapus produk berhasil') :
				session()->setFlashdata('fail', 'Gagal menghapus produk');
			return redirect()->to('/profile');
		}
	}
}
