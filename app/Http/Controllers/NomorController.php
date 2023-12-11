<?php

namespace App\Http\Controllers;

use App\Models\NomorWA;
use Illuminate\Http\Request;

class NomorController extends Controller
{
    public function index()
    {
        $data = NomorWA::orderBy('id', 'DESC')->get();
        return view('superadmin.nomor.index', compact('data'));
    }
    public function create()
    {
        return view('superadmin.nomor.create');
    }
    public function store(Request $req)
    {
        $attr = $req->all();

        $check = NomorWA::where('nama', $req->nama)->first();
        if ($check == null) {
            NomorWA::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/nomor');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function edit($id)
    {
        $data = NomorWA::find($id);
        return view('superadmin.nomor.edit', compact('data'));
    }
    public function update(Request $req, $id)
    {
        $attr = $req->all();
        $check = NomorWA::where('nama', $req->nama)->first();
        if ($check == null) {
            //simpan
            NomorWA::find($id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/nomor');
        } else {
            if ($id == $check->id) {
                NomorWA::find($id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/nomor');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            NomorWA::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
