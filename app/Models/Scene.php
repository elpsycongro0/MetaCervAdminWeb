<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scene extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'name';
    protected $table = 'tb_scenes';
    protected $fillable = ['name', 'version', 'test_version'];
}

