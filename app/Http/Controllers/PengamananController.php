<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pengamanan;
use Illuminate\Http\Request;

class PengamananController extends Controller
{
    public function index()
    {
        $data = Pengamanan::orderBy('id', 'DESC')->get();
        return view('superadmin.pengamanan.index', compact('data'));
    }
    public function create()
    {
        $petugas = Pegawai::get();
        return view('superadmin.pengamanan.create', compact('petugas'));
    }
    public function store(Request $req)
    {
        $attr = $req->all();
        Pengamanan::create($attr);
        toastr()->success('Berhasil disimpan');
        return redirect('/pengamanan');
    }
    public function edit($id)
    {
        $data = Pengamanan::find($id);
        $petugas = Pegawai::get();
        return view('superadmin.pengamanan.edit', compact('data', 'petugas'));
    }
    public function update(Request $req, $id)
    {
        $attr = $req->all();
        $check = Pengamanan::where('nama', $req->nama)->first();
        if ($check == null) {
            //simpan
            Pengamanan::find($id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/pengamanan');
        } else {
            if ($id == $check->id) {
                Pengamanan::find($id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/pengamanan');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            Pengamanan::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
