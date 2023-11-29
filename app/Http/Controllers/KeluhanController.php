<?php

namespace App\Http\Controllers;

use App\Models\KeluhanWA;
use Illuminate\Http\Request;

class KeluhanController extends Controller
{
    public function keluhanwa()
    {
        $data = KeluhanWA::orderBy('id', 'DESC')->get();
        return view('superadmin.keluhanwa.index', compact('data'));
    }
}
