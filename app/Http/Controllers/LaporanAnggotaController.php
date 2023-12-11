<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Models\LaporanAnggota;

class LaporanAnggotaController extends Controller
{
    public function index()
    {
        $data = LaporanAnggota::orderBy('id', 'DESC')->get()->map(function ($item) {
            $item->nama = Pegawai::where('nik', $item->nik)->first() == null ? '' :  Pegawai::where('nik', $item->nik)->first()->nama;
            return $item;
        });
        return view('superadmin.laporananggota.index', compact('data'));
    }

    public function delete($id)
    {
        try {
            LaporanAnggota::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
