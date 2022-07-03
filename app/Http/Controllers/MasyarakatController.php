<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Kategori;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MasyarakatController extends Controller
{
    public function pilihkec()
    {
        $data = Kecamatan::orderBy('id', 'DESC')->get();
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
        DB::beginTransaction();
        try {
            $validator = Validator::make($req->all(), [
                'file' => 'mimes:jpg,jpeg|max:10256'
            ]);

            if ($validator->fails()) {
                toastr()->error('File Harus Berupa JPG max 10MB');
                return back();
            }

            if ($req->hasFile('file')) {
                $filename = $req->file->getClientOriginalName();
                $filename = date('d-m-Y-') . rand(1, 9999) . $filename;
                $req->file->storeAs('/public/foto', $filename);
                $foto_keluhan = $filename;
            } else {
                $foto_keluhan = null;
            }

            $n = new Keluhan;
            $n->kecamatan_id = Kelurahan::find($req->kelurahan_id)->kecamatan_id;
            $n->kelurahan_id = $req->kelurahan_id;
            $n->kategori_id = $req->kategori_id;
            $n->alamat = $req->alamat;
            $n->isi = $req->isi;
            $n->foto_keluhan = $foto_keluhan;
            $n->user_id = Auth::user()->id;
            $n->save();
            DB::commit();
            toastr()->success('Keluhan Berhasil Di Kirim');
            return redirect('/');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Kegagalan Sistem');
            return back();
        }
    }
}
