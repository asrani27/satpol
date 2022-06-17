<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Kategori;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasyarakatController extends Controller
{
    public function pilihkec()
    {
        $data = Kecamatan::get();
        return view('masyarakat.pilihkec', compact('data'));
    }

    public function pilihkel()
    {
        $kecamatan_id = request()->kecamatan_id;
        $kel = Kelurahan::where('kecamatan_id', $kecamatan_id)->get();
        $kat = Kategori::get();
        return view('masyarakat.pilihkel', compact('kel', 'kat'));
    }

    public function store(Request $req)
    {
        $n = new Keluhan;
        $n->kecamatan_id = Kelurahan::find($req->kelurahan_id)->kecamatan_id;
        $n->kelurahan_id = $req->kelurahan_id;
        $n->kategori_id = $req->kategori_id;
        $n->alamat = $req->alamat;
        $n->isi = $req->isi;
        $n->user_id = Auth::user()->id;
        $n->save();
        toastr()->success('Keluhan Berhasil Di Kirim');
        return redirect('/');
    }
}
