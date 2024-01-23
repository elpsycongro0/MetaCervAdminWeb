<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendantCompanyCreate extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tb_pendant_company_create';
    protected $fillable = ['id', 'email', 'firstname', 'lastname', 'company', 'role', 'id_country', 'phone', 'avatar', 'photo', 'id_privilege', 'gender', 'register_event', 'active', 'birthdate', 'avatar_vr', 'password', 'commercial_name', 'ruc', 'razon_social', 'created'];
    protected $casts = [
        'created' => 'boolean',
    ];
}

