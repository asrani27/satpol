<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluhanWA extends Model
{
    use HasFactory;
    protected $table = 'keluhanwa';
    protected $guarded = ['id'];
}
