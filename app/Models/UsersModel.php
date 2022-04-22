<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = "users";
    protected $allowedFields = [
        "fullname", "user_gender", "no_hp", "profile_pic"
    ];
}
