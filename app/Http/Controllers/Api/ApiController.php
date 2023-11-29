<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriKeluhan;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function kategori()
    {
        $data = KategoriKeluhan::get();
        return response()->json($data);
    }
}
