<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tb_companies';
    protected $fillable = ['commercial_name', 'razon_social', 'structure_group_id', 'ruc', 'default_password_changed', 'deployed'];
    protected $casts = [
        'default_password_changed' => 'boolean',
        'deployed' => 'boolean',
    ];
}
