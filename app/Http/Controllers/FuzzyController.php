<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use App\Models\Fuzzy;
use GuzzleHttp\Client;
use App\Models\BaseUrl;
use App\Models\Pegawai;
use App\Models\Periode;
use App\Models\Indikator;
use Illuminate\Http\Request;

class FuzzyController extends Controller
{
    public function periode()
    {
        $data = Periode::orderBy('id', 'DESC')->get();
        return view('superadmin.fuzzy.periode', compact('data'));
    }

    public function skpd($periode_id)
    {
        $data = Skpd::orderBy('id', 'DESC')->get();
        return view('superadmin.fuzzy.skpd', compact('data', 'periode_id'));
    }

    public function pegawai($periode_id, $skpd_id)
    {
        $data = Fuzzy::where('skpd_id', $skpd_id)->get();
        $skpd = Skpd::find($skpd_id);
        $periode = Periode::find($periode_id);
        return view('superadmin.fuzzy.pegawai', compact('data', 'periode', 'skpd'));
    }

    public function masukkanpegawai($periode_id, $skpd_id)
    {
        $pegawai = Pegawai::where('skpd_id', $skpd_id)->get();
        $bulan = Periode::find($periode_id)->bulan;
        $tahun = Periode::find($periode_id)->tahun;

        foreach ($pegawai as $item) {
            $check = Fuzzy::where('bulan', $bulan)->where('tahun', $tahun)->where('skpd_id', $skpd_id)->where('nip', $item->nip)->first();
            if ($check == null) {
                //new
                $n = new Fuzzy;
                $n->nip = $item->nip;
                $n->nama = $item->nama;
                $n->bulan = $bulan;
                $n->tahun = $tahun;
                $n->skpd_id = $item->skpd_id;
                $n->save();
            } else {
            }
        }
        toastr()->success('berhasil Di Masukkan');
        return back();
    }
    public function tarikaktivitas($periode_id, $skpd_id)
    {
        $bulan = Periode::find($periode_id)->bulan;
        $tahun = Periode::find($periode_id)->tahun;
        $pegawai = Pegawai::where('skpd_id', $skpd_id)->get();
        $base_url = BaseUrl::first()->tpp;
        $client = new \GuzzleHttp\Client(['base_uri' => $base_url . '/api/']);

        // foreach ($pegawai as $item) {
        //     $response = $client->request('GET', 'pegawai/aktivitas/' . $item->nip . '/' . $bulan . '/' . $tahun, ['verify' => false]);
        //     $response = json_decode($response->getBody()->getContents());
        //     dd($response);
        // }
        try {
            foreach ($pegawai as $item) {
                $response = $client->request('GET', 'pegawai/aktivitas/' . $item->nip . '/' . $bulan . '/' . $tahun, ['verify' => false]);
                $response = json_decode($response->getBody()->getContents());

                $check = Fuzzy::where('bulan', $bulan)->where('tahun', $tahun)->where('nip', $item->nip)->first();
                if ($check == null) {
                    //new simpan
                    $n = new Fuzzy;
                    $n->nip = $item->nip;
                    $n->nama = $item->nama;
                    $n->bulan = $bulan;
                    $n->tahun = $tahun;
                    $n->ja = $response->ja;
                    $n->ma = $response->ma;
                    $n->save();
                } else {
                    //update
                    $check->update([
                        'nama' => $item->nama,
                        'ja' => $response->ja,
                        'ma' => $response->ma,
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

    public function aktivitasPegawai($nip, $bulan, $tahun)
    {
        $base_url = BaseUrl::first()->tpp;
        $client = new \GuzzleHttp\Client(['base_uri' => $base_url . '/api/']);
        $response = $client->request('GET', 'pegawai/aktivitas/' . $nip . '/' . $bulan . '/' . $tahun, ['verify' => false]);
        $response = json_decode($response->getBody()->getContents());
        $check = Fuzzy::where('bulan', $bulan)->where('tahun', $tahun)->where('nip', $nip)->first();

        $pegawai = Pegawai::where('nip', $nip)->first();
        if ($check == null) {
            //new simpan
            $n = new Fuzzy;
            $n->nip = $pegawai->nip;
            $n->nama = $pegawai->nama;
            $n->bulan = $bulan;
            $n->tahun = $tahun;
            $n->ja = $response->ja;
            $n->ma = $response->ma;
            $n->k = $response->k;
            $n->save();
        } else {
            //update
            $check->update([
                'nama' => $pegawai->nama,
                'ja' => $response->ja,
                'ma' => $response->ma,
                'k' => $response->k,
            ]);
        }
        toastr()->success('berhasil Di tarik');
        return back();
    }

    public function fuzzifikasi($id)
    {
        $data = Fuzzy::find($id);

        $indikator_ja = Indikator::where('singkatan', 'JA')->first();
        $indikator_ma = Indikator::where('singkatan', 'MA')->first();
        $indikator_k = Indikator::where('singkatan', 'K')->first();

        //Usedikit Jumlah AktivitaS
        if ($data->ja > $indikator_ja->sedikit) {
            $f_ja_s = 0;
        } elseif ($data->ja < $indikator_ja->banyak) {
            $f_ja_s = 1;
        } else {
            $f_ja_s = ($indikator_ja->sedikit - $data->ja) / ($indikator_ja->sedikit - $indikator_ja->banyak);
        }

        //Ubanyak Jumlah AktivitaS
        if ($data->ja > $indikator_ja->sedikit) {
            $f_ja_b = 1;
        } elseif ($data->ja < $indikator_ja->banyak) {
            $f_ja_b = 0;
        } else {
            $f_ja_b = ($data->ja - $indikator_ja->banyak) / ($indikator_ja->sedikit - $indikator_ja->banyak);
        }

        //Usedikit Menit AktivitaS
        if ($data->ma > $indikator_ma->sedikit) {
            $f_ma_s = 0;
        } elseif ($data->ma < $indikator_ma->banyak) {
            $f_ma_s = 1;
        } else {
            $f_ma_s = ($indikator_ma->sedikit - $data->ma) / ($indikator_ma->sedikit - $indikator_ma->banyak);
        }

        //Ubanyak Menit AktivitaS
        if ($data->ma > $indikator_ma->sedikit) {
            $f_ma_b = 1;
        } elseif ($data->ma < $indikator_ma->banyak) {
            $f_ma_b = 0;
        } else {
            $f_ma_b = ($data->ma - $indikator_ma->banyak) / ($indikator_ma->sedikit - $indikator_ma->banyak);
        }

        //Usedikit Kehadiran AktivitaS
        if ($data->k > $indikator_k->sedikit) {
            $f_k_s = 0;
        } elseif ($data->k < $indikator_k->banyak) {
            $f_k_s = 1;
        } else {
            $f_k_s = ($indikator_k->sedikit - $data->k) / ($indikator_k->sedikit - $indikator_k->banyak);
        }

        //Ubanyak Kehadiran AktivitaS
        if ($data->k > $indikator_k->sedikit) {
            $f_k_b = 1;
        } elseif ($data->k < $indikator_k->banyak) {
            $f_k_b = 0;
        } else {
            $f_k_b = ($data->k - $indikator_k->banyak) / ($indikator_k->sedikit - $indikator_k->banyak);
        }

        $data->update([
            'f_ja_s' => $f_ja_s,
            'f_ja_b' => $f_ja_b,
            'f_ma_s' => $f_ma_s,
            'f_ma_b' => $f_ma_b,
            'f_k_s' => $f_k_s,
            'f_k_b' => $f_k_b,
        ]);

        toastr()->success('berhasil Di Hitung');
        return back();
    }

    public function inferensi($id)
    {

        $data = Fuzzy::find($id);

        if (min($data->f_ja_s, $data->f_ma_s, $data->f_k_s) == 0) {
            $sss = 0;
        } else {
            $sss = min($data->f_ja_s, $data->f_ma_s, $data->f_k_s);
        }

        if (min($data->f_ja_s, $data->f_ma_s, $data->f_k_b) == 0) {
            $ssb = 0;
        } else {
            $ssb = min($data->f_ja_s, $data->f_ma_s, $data->f_k_b);
        }

        if (min($data->f_ja_s, $data->f_ma_b, $data->f_k_s) == 0) {
            $sbs = 0;
        } else {
            $sbs = min($data->f_ja_s, $data->f_ma_b, $data->f_k_s);
        }

        if (min($data->f_ja_s, $data->f_ma_b, $data->f_k_b) == 0) {
            $sbb = 0;
        } else {
            $sbb = min($data->f_ja_s, $data->f_ma_b, $data->f_k_b);
        }

        if (min($data->f_ja_b, $data->f_ma_s, $data->f_k_s) == 0) {
            $bss = 0;
        } else {
            $bss = min($data->f_ja_b, $data->f_ma_s, $data->f_k_s);
        }

        if (min($data->f_ja_b, $data->f_ma_s, $data->f_k_b) == 0) {
            $bsb = 0;
        } else {
            $bsb = min($data->f_ja_b, $data->f_ma_s, $data->f_k_b);
        }

        if (min($data->f_ja_b, $data->f_ma_b, $data->f_k_s) == 0) {
            $bbs = 0;
        } else {
            $bbs = min($data->f_ja_b, $data->f_ma_b, $data->f_k_s);
        }

        if (min($data->f_ja_b, $data->f_ma_b, $data->f_k_b) == 0) {
            $bbb = 0;
        } else {
            $bbb = min($data->f_ja_b, $data->f_ma_b, $data->f_k_b);
        }


        $data->update([
            'sss' => $sss,
            'ssb' => $ssb,
            'sbs' => $sbs,
            'sbb' => $sbb,
            'bss' => $bss,
            'bsb' => $bsb,
            'bbs' => $bbs,
            'bbb' => $bbb,
        ]);

        //RULE
        if ($data->sss == 0) {
            $r1 = 70;
        } else {
            $r1 = ($data->sss * (70 - 60)) + 60;
        }

        if ($data->ssb == 0) {
            $r2 = 70;
        } else {
            $r2 = ($data->ssb * (70 - 60)) + 60;
        }

        if ($data->sbs == 0) {
            $r3 = 70;
        } else {
            $r3 = ($data->sbs * (70 - 60)) + 60;
        }

        if ($data->sbb == 0) {
            $r4 = 70;
        } else {
            $r4 = ($data->sbb * (70 - 60)) + 60;
        }

        if ($data->bss == 0) {
            $r5 = 70;
        } else {
            $r5 = ($data->bss * (70 - 60)) + 60;
        }

        if ($data->bsb == 0) {
            $r6 = 70;
        } else {
            $r6 = ($data->bsb * (70 - 60)) + 60;
        }

        if ($data->bbs == 0) {
            $r7 = 70;
        } else {
            $r7 = ($data->bbs * (70 - 60)) + 60;
        }

        if ($data->bbb == 0) {
            $r8 = 70;
        } else {
            $r8 = ($data->bbb * (70 - 60)) + 60;
        }

        $data->update([
            'r1' => $r1,
            'r2' => $r2,
            'r3' => $r3,
            'r4' => $r4,
            'r5' => $r5,
            'r6' => $r6,
            'r7' => $r7,
            'r8' => $r8,
        ]);

        toastr()->success('berhasil Di Hitung');
        return back();
    }

    public function defuzzifikasi($id)
    {
        $data = Fuzzy::find($id);

        $defuzzy = (($data->sss * $data->r1) + ($data->ssb * $data->r2) + ($data->sbs * $data->r3) + ($data->sbb * $data->r4) + ($data->bss * $data->r5) + ($data->bsb * $data->r6) + ($data->bbs * $data->r7) + ($data->bbb * $data->r8)) / ($data->sss + $data->ssb + $data->sbs + $data->sbb + $data->bss + $data->bsb + $data->bbs + $data->bbb);
        $keputusan = $defuzzy < 70 ? 'Tidak Rajin' : 'Rajin';
        $data->update([
            'defuzzy' => $defuzzy,
            'keputusan' => $keputusan,
        ]);
        toastr()->success('berhasil Di Hitung');
        return back();
    }
}
