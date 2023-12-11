<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Models\LaporanAnggota;

class LaporanAnggotaController extends Controller
{
    public function index()
    {
        $data = LaporanAnggota::orderBy('id', 'DESC')->get()->map(function ($item) {
            $item->nama = Pegawai::where('nik', $item->nik)->first()->nama;
            return $item;
        });
        return view('superadmin.laporananggota.index', compact('data'));
    }
}
