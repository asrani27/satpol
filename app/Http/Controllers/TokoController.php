<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\Barang;
use App\Models\BarangToko;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function toko()
    {
        $data = Toko::orderBy('id', 'DESC')->get();
        return view('superadmin.toko.index', compact('data'));
    }
    public function tokocreate()
    {
        return view('superadmin.toko.create');
    }
    public function tokostore(Request $req)
    {
        $attr = $req->all();

        $check = Toko::where('kode', $req->kode)->first();
        if ($check == null) {
            Toko::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/toko');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function tokoedit($id)
    {
        $data = Toko::find($id);
        return view('superadmin.toko.edit', compact('data'));
    }
    public function tokoupdate(Request $req, $id)
    {
        $attr = $req->all();
        $check = Toko::where('kode', $req->kode)->first();
        if ($check == null) {
            //simpan
            Toko::find($id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/toko');
        } else {
            if ($id == $check->id) {
                Toko::find($id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/toko');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function tokodelete($id)
    {
        try {
            Toko::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data barang');
            return back();
        }
    }

    public function tokobarang($id)
    {
        $toko = Toko::find($id);
        return view('superadmin.toko.barang', compact('id', 'toko'));
    }

    public function editharga($barang_id, $toko_id)
    {
        $data = BarangToko::where('barang_id', $barang_id)->where('toko_id', $toko_id)->first();
        $barang = Barang::find($barang_id);
        $toko = Toko::find($toko_id);
        return view('superadmin.toko.editharga', compact('barang_id', 'toko_id', 'data', 'barang', 'toko'));
    }

    public function updateharga(Request $req, $barang_id, $toko_id)
    {

        $c_harga = (int)str_replace(',', '', $req->harga);
        $c_harga_modal = (int)str_replace(',', '', $req->harga_modal);
        $c_harga_grosir = (int)str_replace(',', '', $req->harga_grosir);
        $c_harga_jual = (int)str_replace(',', '', $req->harga_jual);

        $diskon = ((($c_harga - $c_harga_jual) / $c_harga) * 100);

        $update = BarangToko::where('barang_id', $barang_id)->where('toko_id', $toko_id)->first();

        if ($update == null) {
            //simpan
            $n = new BarangToko;
            $n->barang_id = $barang_id;
            $n->toko_id = $toko_id;
            $n->harga = $c_harga;
            $n->harga_modal = $c_harga_modal;
            $n->harga_grosir = $c_harga_grosir;
            $n->diskon = $diskon;
            $n->harga_jual = $c_harga_jual;
            $n->save();
        } else {
            //update
            $update->update([
                'harga' => $c_harga,
                'diskon' => $diskon,
                'harga_modal' => $c_harga_modal,
                'harga_grosir' => $c_harga_grosir,
                'harga_jual' => $c_harga_jual,
            ]);
        }

        toastr()->success('Berhasil dupdate');
        return redirect('/toko/barang/' . $toko_id);
    }
}
