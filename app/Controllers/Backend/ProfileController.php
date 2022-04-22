<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\MerchantsModel;

class ProfileController extends BaseController
{
	public function __construct()
	{
		$this->db = \Config\Database::connect();
		$this->merchants = new MerchantsModel();
	}

	public function index()
	{
		$title = 'Users';
		$data = [
			'meta_title'	=> $title . ' | Admin Panel',
			'title'			=> $title,
			'pages_slug' 	=> 'users',
			'validation' 	=> \Config\Services::validation(),
			'merchants'		=> $this->merchants->getMerchants(),
		];
		return view('backend/pages/users', $data);
	}

	public function deleteuser($id, $user_id)
	{
		$this->merchants->delete($id);
		$this->db->table('auth_groups_users')->where('user_id', $user_id)->update(['group_id' => '2']);
		return redirect()->to('/admin/users');
	}

	public function verifikasi($id, $user_id)
	{
		$this->merchants->save([
			'id' 				=> $id,
			'merchant_status' 	=> 'active',
			'verified' 			=> 'true',
		]);
		$this->db->table('auth_groups_users')->where('user_id', $user_id)->update(['group_id' => '3']);
		return redirect()->to('/admin/users');
	}
}
