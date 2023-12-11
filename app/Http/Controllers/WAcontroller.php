<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\NomorWA;
use App\Models\KeluhanWA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WAcontroller extends Controller
{
    public function keatasan($id)
    {
        $nomor = NomorWA::get();
        $pesan = format_pesan(KeluhanWA::where('id', $id)->get())->first();

        foreach ($nomor as $n) {
            $data = [
                "phoneNumber" => $n->nama,
                "content" => [
                    "text" => Carbon::now()->translatedFormat('d F Y') .
                        " BOT SIPADU, KELUHAN MASUK, \n Nama : " . $pesan->nama . " \n Keluhan : " . $pesan->isikeluhan . " \n",
                ]
            ];

            $response = Http::withBody(json_encode($data), 'application/json')
                ->post('https://bot.sipadu.banjarmasinkota.go.id/message');
        }
        toastr()->success(' Berhasil Di Kirim');
        return back();
        dd($nomor);
    }
}
