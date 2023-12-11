<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\KeluhanWA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class KeluhanController extends Controller
{

    public function baru($id)
    {
        KeluhanWA::find($id)->update(['status' => 0]);
        toastr()->success('Berhasil diubah');
        return back();
    }
    public function uploadbukti(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'file' => 'mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            toastr()->error('File Harus Berupa JPG max 2MB');
            return back();
        }

        if ($req->hasFile('file')) {
            $filename = str_replace(" ", "_", $req->file->getClientOriginalName());
            $filename = date('d-m-Y-') . rand(1, 9999) . $filename;
            $req->file->storeAs('/public/foto', $filename);
        } else {
            $filename = KeluhanWA::find($req->id_keluhan)->file;
        }

        KeluhanWA::find($req->id_keluhan)->update(['file' => $filename]);
        toastr()->success('Berhasil diupload');
        return back();
    }
    public function diproses($id)
    {

        $find = KeluhanWA::find($id);
        $sender = json_decode($find->isi);
        if (isset($sender->sender) == true) {
            $nomor = $sender->sender->from;
        } else {
            $nomor = null;
        }

        KeluhanWA::find($id)->update(['status' => 1]);
        $pesan = json_decode($find->isi);

        if ($nomor == null) {
            toastr()->success('Berhasil diubah,namun nomor pelapor tidak ditemukan, tidak bisa mengirim notif');
            return back();
        } else {
            $data = [
                "phoneNumber" => $nomor,
                "content" => [
                    "text" => Carbon::now()->translatedFormat('d F Y') .
                        " SIPADU, KELUHAN ANDA, \n Nama : " . $pesan->name . " \n Keluhan : " . $pesan->complaint . " \n Sedang Diproses",
                ]
            ];

            $response = Http::withBody(json_encode($data), 'application/json')
                ->post('https://bot.sipadu.banjarmasinkota.go.id/message');

            toastr()->success('Berhasil diubah');
            return back();
        }
    }
    public function selesai($id)
    {

        $find = KeluhanWA::find($id);
        $sender = json_decode($find->isi);
        if (isset($sender->sender) == true) {
            $nomor = $sender->sender->from;
        } else {
            $nomor = null;
        }

        KeluhanWA::find($id)->update(['status' => 2]);
        $pesan = json_decode($find->isi);

        if ($nomor == null) {
            toastr()->success('Berhasil diubah,namun nomor pelapor tidak ditemukan, tidak bisa mengirim notif');
            return back();
        } else {
            $data = [
                "phoneNumber" => $nomor,
                "content" => [
                    "text" => Carbon::now()->translatedFormat('d F Y') .
                        " SIPADU, KELUHAN ANDA, \n Nama : " . $pesan->name . " \n Keluhan : " . $pesan->complaint . " \n Sudah Selesai, \n Foto : https://sipadu.banjarmasinkota.go.id/storage/foto/" . $pesan->file,
                ]
            ];

            $response = Http::withBody(json_encode($data), 'application/json')
                ->post('https://bot.sipadu.banjarmasinkota.go.id/message');

            toastr()->success('Berhasil diubah');
            return back();
        }
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
            if (isset($isi->sender) == true) {
                $item->pengirim = $isi->sender->from;
            } else {
                $item->pengirim = null;
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
