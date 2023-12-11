<?php

namespace App\Http\Controllers;

use App\Models\LaporanAnggota;
use Illuminate\Http\Request;

class LaporanAnggotaController extends Controller
{
    public function index()
    {
        $data = LaporanAnggota::orderBy('id', 'DESC')->get();
        return view('superadmin.laporananggota.index', compact('data'));
    }
}
