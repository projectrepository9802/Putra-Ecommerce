<?php

namespace App\Models;

use CodeIgniter\Model;

class MerchantsModel extends Model
{
	protected $table                = 'merchants';
	protected $allowedFields        = [
		'user_id',
		'merchant_fullname',
		'merchant_email',
		'merchant_gender',
		'merchant_phone',
		'merchant_status',
		'store_name',
		'store_slug',
		'store_address',
		'store_image',
		'ktp_image',
		'store_logo',
		'verified',
	];

	public function getMerchants()
	{
		return $this->findAll();
	}
}
