<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use Illuminate\Http\Request;

class DataMasukController extends Controller
{
    public function index()
    {
        $data = Keluhan::get();
        return view('superadmin.keluhan.index', compact('data'));
    }

    public function kirim($id)
    {
        Keluhan::find($id)->update(['status' => 1]);
        toastr()->success('Berhasil Di Kirim Kesemua Anggota');
        return back();
    }

    public function delete($id)
    {
        Keluhan::find($id)->delete();
        toastr()->success('Berhasil Di Hapus');
        return back();
    }
}
