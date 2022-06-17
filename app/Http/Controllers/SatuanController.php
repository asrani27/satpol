<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function satuan()
    {
        $data = satuan::orderBy('id', 'DESC')->get();
        return view('superadmin.satuan.index', compact('data'));
    }
    public function satuancreate()
    {
        return view('superadmin.satuan.create');
    }
    public function satuanstore(Request $req)
    {
        $attr = $req->all();

        $check = satuan::where('nama', $req->nama)->first();
        if ($check == null) {
            satuan::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/satuan');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function satuanedit($id)
    {
        $data = Satuan::find($id);
        return view('superadmin.satuan.edit', compact('data'));
    }
    public function satuanupdate(Request $req, $id)
    {
        $attr = $req->all();
        $check = Satuan::where('nama', $req->nama)->first();
        if ($check == null) {
            //simpan
            Satuan::find($id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/satuan');
        } else {
            if ($id == $check->id) {
                Satuan::find($id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/satuan');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function satuandelete($id)
    {
        try {
            Satuan::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data barang');
            return back();
        }
    }
}
