<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKeluhan extends Model
{
    use HasFactory;
    protected $table = 'kategorikeluhan';
    protected $guarded = ['id'];

    public $timestamps = false;
}
