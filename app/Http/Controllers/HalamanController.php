<?php

namespace App\Http\Controllers;

use App\Models\Halaman;
use Illuminate\Http\Request;

class HalamanController extends Controller
{
    public function profil()
    {
        $data = Halaman::where('nama', 'profil')->first()->isi;
        return view('superadmin.halaman.profil', compact('data'));
    }

    public function updateProfil(Request $req)
    {
        Halaman::where('nama', 'profil')->first()->update([
            'isi' => $req->isi,
        ]);
        toastr()->success('Berhasil Di Update');
        return back();
    }

    public function tentang()
    {
        $data = Halaman::where('nama', 'tentang')->first()->isi;
        return view('superadmin.halaman.tentang', compact('data'));
    }

    public function updateTentang(Request $req)
    {
        Halaman::where('nama', 'tentang')->first()->update([
            'isi' => $req->isi,
        ]);
        toastr()->success('Berhasil Di Update');
        return back();
    }
    public function kontak()
    {
        $data = Halaman::where('nama', 'kontak')->first()->isi;
        return view('superadmin.halaman.kontak', compact('data'));
    }

    public function updateKontak(Request $req)
    {
        Halaman::where('nama', 'kontak')->first()->update([
            'isi' => $req->isi,
        ]);
        toastr()->success('Berhasil Di Update');
        return back();
    }


    public function profilsatpol()
    {
        $data = Halaman::where('nama', 'profil')->first()->isi;
        return view('profilsatpol', compact('data'));
    }

    public function kontaksatpol()
    {
        $data = Halaman::where('nama', 'kontak')->first()->isi;
        return view('kontaksatpol', compact('data'));
    }
    public function tentangsipadu()
    {
        $data = Halaman::where('nama', 'tentang')->first()->isi;
        return view('tentangsipadu', compact('data'));
    }
}
