<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengamanan extends Model
{
    use HasFactory;
    protected $table = 'pengamanan';
    protected $guarded = ['id'];
}
