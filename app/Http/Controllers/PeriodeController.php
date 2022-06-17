<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function periode()
    {
        $data = Periode::orderBy('id', 'DESC')->get();
        return view('superadmin.periode.index', compact('data'));
    }
    public function periodecreate()
    {
        return view('superadmin.periode.create');
    }
    public function periodestore(Request $req)
    {
        $attr = $req->all();

        $check = Periode::where('bulan', $req->bulan)->where('tahun', $req->tahun)->first();
        if ($check == null) {
            Periode::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/periode');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function periodeedit($id)
    {
        $data = Periode::find($id);
        return view('superadmin.periode.edit', compact('data'));
    }
    public function periodeupdate(Request $req, $id)
    {
        $attr = $req->all();
        $check = Periode::where('bulan', $req->bulan)->where('tahun', $req->tahun)->first();
        if ($check == null) {
            //simpan
            Periode::find($id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/periode');
        } else {
            if ($id == $check->id) {
                Periode::find($id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/periode');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function periodedelete($id)
    {
        try {
            Periode::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data barang');
            return back();
        }
    }
}
