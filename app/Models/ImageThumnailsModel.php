<?php

namespace App\Models;

use CodeIgniter\Model;

class ImageThumnailsModel extends Model
{
	protected $table                = 'imagethumnails';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $returnType           = 'array';
	protected $allowedFields        = ['product_id', 'image_file', 'image_slug'];
}
