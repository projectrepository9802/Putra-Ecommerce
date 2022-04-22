<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\MerchantsModel;

class DashboardController extends BaseController
{
	public function __construct()
	{
		$this->db = \Config\Database::connect();
		$this->merchants = new MerchantsModel();
	}

	public function index()
	{
		return view('backend/index');
	}
}
