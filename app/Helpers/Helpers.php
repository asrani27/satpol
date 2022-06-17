<?php

use App\Models\Barang;
use App\Models\Satuan;
use App\Models\BarangToko;

function satuan()
{
    return Satuan::get();
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
