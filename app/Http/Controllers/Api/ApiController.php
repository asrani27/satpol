<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\KeluhanWA;
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

    public function storekeluhan(Request $req)
    {
        $n = new KeluhanWA;
        $n->tanggal = Carbon::now()->format('Y-m-d');
        $n->isi = $req->isi;
        $n->save();

        $pesan = 'Terima Kasih Telah memberikan laporan, berikut ini no keluhan anda : SIPADU' . $n->id;
        return response()->json($pesan);
    }
}
