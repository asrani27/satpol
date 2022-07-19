<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BeritaController extends Controller
{
    public function berita()
    {
        $data = Berita::orderBy('id', 'DESC')->get();
        return view('superadmin.berita.index', compact('data'));
    }
    public function beritacreate()
    {
        return view('superadmin.berita.create');
    }
    public function beritastore(Request $req)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($req->all(), [
                'file' => 'mimes:jpg,jpeg,png|max:10256'
            ]);

            if ($validator->fails()) {
                toastr()->error('File Harus Berupa JPG/PNG max 10MB');
                return back();
            }

            if ($req->hasFile('gambar')) {
                $filename = $req->gambar->getClientOriginalName();
                $filename = date('d-m-Y-') . rand(1, 9999) . $filename;
                $req->gambar->storeAs('/public/berita', $filename);
            }

            $n = new Berita;
            $n->judul = $req->judul;
            $n->gambar = $filename;
            $n->save();

            DB::commit();
            toastr()->success('Berhasil Di Simpan');
            return redirect('/berita');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Kegagalan Sistem');
            return back();
        }
    }
    public function beritaedit($id)
    {
        $data = Berita::find($id);
        return view('superadmin.berita.edit', compact('data'));
    }
    public function beritaupdate(Request $req, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($req->all(), [
                'file' => 'mimes:jpg,jpeg,png|max:10256'
            ]);

            if ($validator->fails()) {
                toastr()->error('File Harus Berupa JPG/PNG max 10MB');
                return back();
            }

            $data = Berita::find($id);

            if ($req->hasFile('gambar')) {
                $filename = $req->gambar->getClientOriginalName();
                $filename = date('d-m-Y-') . rand(1, 9999) . $filename;
                $req->gambar->storeAs('/public/berita', $filename);
            } else {
                $filename = $data->gambar;
            }

            $u = $data;
            $u->judul = $req->judul;
            $u->gambar = $filename;
            $u->save();

            DB::commit();
            toastr()->success('Berhasil Di Update');
            return redirect('/berita');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Kegagalan Sistem');
            return back();
        }
    }
    public function beritadelete($id)
    {
        try {
            Berita::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
