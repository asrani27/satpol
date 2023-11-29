<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\KeluhanWA;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriKeluhan;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function kategori()
    {
        $data = KategoriKeluhan::get();
        return response()->json($data);
    }

    public function checkkeluhan($nomor)
    {
        $nomor_id = Str::replace('sipadu', '', $nomor);
        $data = KeluhanWA::find($nomor_id);

        $param['nomorkeluhan'] = $nomor;
        $param['isi'] = json_decode($data->isi);
        if ($data->status = 0) {
            $param['status'] = 'Belum diproses';
        }
        if ($data->status = 1) {
            $param['status'] = 'Siproses';
        }
        if ($data->status = 2) {
            $param['status'] = 'Selesai';
        }
        return response()->json($param);
    }
    public function storekeluhan(Request $req)
    {
        $n = new KeluhanWA;
        $n->tanggal = Carbon::now()->format('Y-m-d');
        $n->isi = $req->isi;
        $n->save();

        $pesan = 'Terima Kasih Telah memberikan laporan, berikut ini no keluhan anda : *SIPADU*' . $n->id;
        return response()->json($pesan);
    }
}
