<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StructureGroup extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tb_structure_groups';
    protected $fillable = ['name', 'id_category', 'with_password', 'principal_scene', 'available', 'v_target'];
}

