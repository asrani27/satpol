<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use GuzzleHttp\Client;
use App\Models\BaseUrl;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class SkpdController extends Controller
{
    public function skpd()
    {
        $data = Skpd::orderBy('id', 'DESC')->get();
        return view('superadmin.skpd.index', compact('data'));
    }

    public function skpdtarikdata()
    {

        try {
            $base_url = BaseUrl::first()->tpp;
            $client = new \GuzzleHttp\Client(['base_uri' => $base_url . '/api/']);
            $response = $client->request('GET', 'skpd', ['verify' => false]);
            $response = json_decode($response->getBody()->getContents())->data;

            foreach ($response as $skpd) {
                $check = Skpd::find($skpd->id);
                if ($check == null) {
                    $n = new Skpd;
                    $n->id = $skpd->id;
                    $n->kode = $skpd->kode_skpd;
                    $n->nama = $skpd->nama;
                    $n->save();
                } else {
                    $check->update([
                        'kode' => $skpd->kode_skpd,
                        'nama' => $skpd->nama,
                    ]);
                }
            }

            toastr()->success('berhasil Di tarik');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Periksa Base URL');
            return back();
        }
    }

    public function tarikpegawai($id)
    {

        try {
            $kode_skpd = Skpd::find($id)->kode;
            $base_url = BaseUrl::first()->tpp;
            $client = new \GuzzleHttp\Client(['base_uri' => $base_url . '/api/']);
            $response = $client->request('GET', 'pegawai/skpd/' . $kode_skpd, ['verify' => false]);
            $response = json_decode($response->getBody()->getContents())->data;

            foreach ($response as $pegawai) {
                $check = Pegawai::where('nip', $pegawai->nip)->first();
                if ($check == null) {
                    $n = new Pegawai;
                    $n->nip = $pegawai->nip;
                    $n->nama = $pegawai->nama;
                    $n->skpd_id = $id;
                    $n->save();
                } else {
                    $check->update([
                        'nama' => $pegawai->nama,
                        'skpd_id' => $id,
                    ]);
                }
            }
            toastr()->success('berhasil Di tarik');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Periksa Base URL');
            return back();
        }
    }
    public function skpddelete($id)
    {
        Skpd::find($id)->delete();
        toastr()->success('Berhasil Di Hapus');
        return back();
    }

    public function skpdpegawai($id)
    {
        $data = Pegawai::where('skpd_id', $id)->get();
        return view('superadmin.skpd.pegawai', compact('data'));
    }
}
