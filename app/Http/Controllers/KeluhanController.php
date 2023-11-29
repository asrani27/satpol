<?php

namespace App\Http\Controllers;

use App\Models\KeluhanWA;
use Illuminate\Http\Request;

class KeluhanController extends Controller
{
    public function keluhanwa()
    {
        $data = KeluhanWA::orderBy('id', 'DESC')->get()->map(function ($item) {
            $isi = json_decode($item->isi);
            $item->nama = $isi->name;
            $item->kecamatan = $isi->district->name;
            $item->kelurahan = $isi->village->name;

            $item->kategori = $isi->category->nama;
            $item->isikeluhan = $isi->complaint;
            $item->lat = $isi->location->degreesLatitude;
            $item->long = $isi->location->degreesLongitude;
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
