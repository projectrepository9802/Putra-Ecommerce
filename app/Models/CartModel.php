<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table                = 'cart_session';
    protected $primaryKey           = 'id_card';
    protected $allowedFields        = ['id_user', 'id_product', 'id_merchant', 'jumlah_produk'];
}
