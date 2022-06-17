<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function kategori()
    {
        $data = Kategori::orderBy('id', 'DESC')->get();
        return view('superadmin.kategori.index', compact('data'));
    }
    public function kategoricreate()
    {
        return view('superadmin.kategori.create');
    }
    public function kategoristore(Request $req)
    {
        $attr = $req->all();

        $check = Kategori::where('nama', $req->nama)->first();
        if ($check == null) {
            Kategori::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kategori');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function kategoriedit($id)
    {
        $data = Kategori::find($id);
        return view('superadmin.kategori.edit', compact('data'));
    }
    public function kategoriupdate(Request $req, $id)
    {
        $attr = $req->all();
        $check = Kategori::where('nama', $req->nama)->first();
        if ($check == null) {
            //simpan
            Kategori::find($id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kategori');
        } else {
            if ($id == $check->id) {
                Kategori::find($id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kategori');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function kategoridelete($id)
    {
        try {
            Kategori::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
