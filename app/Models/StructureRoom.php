<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StructureRoom extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'scene';
    protected $table = 'tb_structure_rooms';
    protected $fillable = ['scene', 'id', 'name', 'with_password', 'password','id_group'];
    protected $casts = [
        'with_password' => 'boolean',
    ];
}

