<?php

namespace App\Http\Controllers;

use App\Models\BaseUrl;
use App\Models\Keluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index()
    {
        return view('superadmin.beranda');
    }

    public function masyarakat()
    {
        $data = Keluhan::where('user_id', Auth::user()->id)->get();
        return view('masyarakat.beranda', compact('data'));
    }

    public function pegawai()
    {
        return view('pegawai.beranda');
    }
}
