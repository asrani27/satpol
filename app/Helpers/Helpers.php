<?php

use App\Models\Barang;
use App\Models\Satuan;
use App\Models\BarangToko;

function satuan()
{
    return Satuan::get();
}

function format_pesan($pesan)
{
    $data = $pesan->map(function ($item) {
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
    return $data;
}

function barang()
{
    return Barang::orderBy('id', 'DESC')->get();
}

function convertBulan($bulan)
{
    if ($bulan == '01') {
        $hasil = 'Januari';
    } elseif ($bulan == '02') {
        $hasil = 'Februari';
    } elseif ($bulan == '03') {
        $hasil = 'Maret';
    } elseif ($bulan == '04') {
        $hasil = 'April';
    } elseif ($bulan == '05') {
        $hasil = 'Mei';
    } elseif ($bulan == '06') {
        $hasil = 'Juni';
    } elseif ($bulan == '07') {
        $hasil = 'Juli';
    } elseif ($bulan == '08') {
        $hasil = 'Agustus';
    } elseif ($bulan == '09') {
        $hasil = 'September';
    } elseif ($bulan == '10') {
        $hasil = 'Oktober';
    } elseif ($bulan == '11') {
        $hasil = 'November';
    } elseif ($bulan == '12') {
        $hasil = 'Desember';
    }
    return $hasil;
}
