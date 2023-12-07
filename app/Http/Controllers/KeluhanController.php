<?php

namespace App\Http\Controllers;

use App\Models\KeluhanWA;
use Illuminate\Http\Request;

class KeluhanController extends Controller
{

    public function baru($id)
    {
        KeluhanWA::find($id)->update(['status' => 0]);
        toastr()->success('Berhasil diubah');
        return back();
    }
    public function diproses($id)
    {
        KeluhanWA::find($id)->update(['status' => 1]);
        toastr()->success('Berhasil diubah');
        return back();
    }
    public function selesai($id)
    {
        KeluhanWA::find($id)->update(['status' => 2]);
        toastr()->success('Berhasil diubah');
        return back();
    }
    public function keluhanwa()
    {
        $data = KeluhanWA::orderBy('id', 'DESC')->get()->map(function ($item) {
            $isi = json_decode($item->isi);

            if (isset($isi->name) == true) {
                $item->nama = $isi->name;
            } else {
                $item->nama = null;
            }
            if (isset($isi->district) == true) {
                $item->kecamatan = $isi->district->name;
            } else {
                $item->kecamatan = null;
            }
            if (isset($isi->village) == true) {
                $item->kelurahan = $isi->village->name;
            } else {
                $item->kelurahan = null;
            }
            if (isset($isi->category) == true) {
                $item->kategori = $isi->category->nama;
            } else {
                $item->kategori = null;
            }
            if (isset($isi->complaint) == true) {
                $item->isikeluhan = $isi->complaint;
            } else {
                $item->isikeluhan = null;
            }
            if (isset($isi->location) == true) {
                $item->lat = $isi->location->degreesLatitude;
            } else {
                $item->lat = null;
            }
            if (isset($isi->location) == true) {
                $item->long = $isi->location->degreesLongitude;
            } else {
                $item->long = null;
            }

            return $item;
        });


        return view('superadmin.keluhanwa.index', compact('data'));
    }

    public function delete($id)
    {
        KeluhanWA::find($id)->delete();
        toastr()->success('Berhasil Di hapus');
        return back();
    }
}
