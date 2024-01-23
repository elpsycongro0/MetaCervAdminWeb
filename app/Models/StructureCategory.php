<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StructureCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tb_structure_categories';
    protected $fillable = ['name', 'color', 'image', 'v_target', 'with_effect'];
}

