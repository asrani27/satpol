<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{

    public function barang()
    {
        $data = Barang::orderBy('id', 'DESC')->get();
        return view('superadmin.barang.index', compact('data'));
    }
    public function barangcreate()
    {
        return view('superadmin.barang.create');
    }
    public function barangstore(Request $req)
    {
        $attr = $req->all();

        $check = Barang::where('kode', $req->kode)->first();
        if ($check == null) {
            Barang::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/barang');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function barangedit($id)
    {
        $data = Barang::find($id);
        return view('superadmin.barang.edit', compact('data'));
    }
    public function barangupdate(Request $req, $id)
    {
        $attr = $req->all();
        $check = Barang::where('kode', $req->kode)->first();
        if ($check == null) {
            //simpan
            Barang::find($id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/barang');
        } else {
            if ($id == $check->id) {
                Barang::find($id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/barang');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function barangdelete($id)
    {
        try {
            Barang::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data barang');
            return back();
        }
    }
}
