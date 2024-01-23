<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tb_users';
    protected $fillable = ['email', 'firstname', 'lastname', 'company', 'role', 'id_country', 'phone', 'id_privilege', 'gender', 'register_event', 'active', 'birthday', 'password'];
    
}
