<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function delete($id)
    {
        Keranjang::find($id)->delete();
        return back();
    }
}
