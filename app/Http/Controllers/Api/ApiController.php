<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\KeluhanWA;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriKeluhan;
use App\Http\Controllers\Controller;
use App\Models\LaporanAnggota;

class ApiController extends Controller
{
    public function kategori()
    {
        $data = KategoriKeluhan::get();
        return response()->json($data);
    }

    public function storeLaporanAnggota(Request $req)
    {
        $n = new LaporanAnggota;
        $n->nik = $req->nik;
        $n->rincian = $req->rincian;
        $n->alamat = $req->alamat;
        $n->foto = $req->foto;
        $n->save();

        $pesan = 'Laporan telah disimpan';
        return response()->json($pesan);
    }
    public function checkkeluhan($nomor)
    {
        try {
            $nomor_id = Str::replace('sipadu', '', $nomor);
            $data = KeluhanWA::find($nomor_id);

            $param['nomorkeluhan'] = $nomor;
            $param['isi'] = json_decode($data->isi);
            if ($data->status == 0) {
                $param['status'] = 'Belum diproses';
            }
            if ($data->status == 1) {
                $param['status'] = 'Siproses';
            }
            if ($data->status == 2) {
                $param['status'] = 'Selesai';
            }

            $pesan = 'Nomor keluhan ' . $nomor .  ' atas nama ' . '*' . json_decode($data->isi)->name . '*' . ' dengan keluhan ' . '*' . json_decode($data->isi)->complaint . '*' . ' berstatus ' .  '*' . strtoupper($param['status']) .  '*';
            return response()->json($pesan);
        } catch (\Exception $e) {
            $pesan = 'nomor tidak ditemukan';
            return response()->json($pesan);
        }
    }
    public function storekeluhan(Request $req)
    {
        $convert = json_encode($req->isi);
        //return response()->json($convert);
        try {
            $n = new KeluhanWA;
            $n->tanggal = Carbon::now()->format('Y-m-d');
            $n->isi = $convert;
            $n->save();

            $pesan = 'Terima Kasih Telah memberikan laporan, berikut ini no keluhan anda : *SIPADU' . $n->id . '*';
            return response()->json($pesan);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }
}
