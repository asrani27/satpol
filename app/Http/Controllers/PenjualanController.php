<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Penjualan;
use App\Models\BarangToko;
use Illuminate\Http\Request;
use App\Models\PenjualanDetail;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function penjualan()
    {
        $data = Toko::orderBy('id', 'DESC')->get();
        return view('superadmin.penjualan.index', compact('data'));
    }

    public function penjualantoko($id)
    {
        $data = Penjualan::where('toko_id', $id)->get();
        $toko = Toko::find($id);
        return view('superadmin.penjualan.penjualan', compact('data', 'toko'));
    }

    public function transaksi($id)
    {
        $barang = Barang::whereHas('toko', function ($q) use ($id) {
            $q->where('toko_id', '=', $id);
        })->get();

        $barang->map(function ($item) use ($id) {
            $item->harga_jual = BarangToko::where('barang_id', $item->id)->where('toko_id', $id)->first()->harga_jual;
            return $item;
        });

        $keranjang = Keranjang::where('toko_id', $id)->get();

        $check = Penjualan::where('toko_id', $id)->get();
        if (count($check) == 0) {
            $kode = $id . '0000001';
        } else {
            $number = count($check) + 1;
            if (strlen($number) == 1) {
                $kode = $id . '000000' . $number;
            } elseif (strlen($number) == 2) {
                $kode = $id . '00000' . $number;
            } elseif (strlen($number) == 3) {
                $kode = $id . '0000' . $number;
            } elseif (strlen($number) == 4) {
                $kode = $number;
            }
        }

        return view('superadmin.penjualan.create', compact('barang', 'kode', 'keranjang', 'id'));
    }

    public function transaksisimpan(Request $req, $id)
    {
        if ($req->button == 'keranjang') {
            if ($req->barang_id == null || $req->jumlah == null) {
                toastr()->error('Barang / Jumlah Belum Di isi');
                $req->flash();
                return back();
            }

            $barang = BarangToko::where('barang_id', $req->barang_id)->where('toko_id', $id)->first();
            $checkKeranjang = Keranjang::where('toko_id', $id)->where('barang_id', $req->barang_id)->first();

            if ($checkKeranjang == null) {
                $s = new Keranjang;
                $s->barang_id       = $req->barang_id;
                $s->harga           = $barang->harga;
                $s->diskon          = $barang->diskon;
                $s->harga_jual      = $barang->harga_jual;
                $s->jumlah    = $req->jumlah;
                $s->total     = $barang->harga_jual * $req->jumlah;
                $s->toko_id   = $id;
                $s->save();
            } else {
                $update = $checkKeranjang;
                $update->harga          = $barang->harga;
                $update->diskon         = $barang->diskon;
                $update->harga_jual     = $barang->harga_jual;
                $update->jumlah         = $req->jumlah;
                $update->total          = $barang->harga_jual * $req->jumlah;
                $update->save();
            }
            $req->flash();
            return back();
        } else {
            DB::beginTransaction();
            try {
                $keranjang = Keranjang::where('toko_id', $id)->get();
                if ($keranjang->count() == 0) {
                    toastr()->error('keranjang Pesanan Kosong');
                    $req->flash();
                    return back();
                }
                $n = new Penjualan;
                $n->tanggal         = $req->tanggal;
                $n->nota            = $req->nota;
                $n->nama_pelanggan  = $req->nama_pelanggan;
                $n->total           = $req->total;
                $n->toko_id         = $id;
                $n->save();

                $keranjang->map(function ($item) {
                    if ($item->jumlah > Barang::find($item->barang_id)->stok) {
                        $status = true;
                    } else {
                        $status = false;
                    }
                    $item->status = $status;
                    return $item;
                });

                if ($keranjang->where('status', true)->count() > 0) {
                    toastr()->error('Stok ' . $keranjang->where('status', true)->first()->barang->nama . ' Tidak Mencukupi');
                    return back();
                }

                foreach ($keranjang as $item) {
                    $pd = new PenjualanDetail;
                    $pd->penjualan_id   = $n->id;
                    $pd->barang_id      = $item->barang_id;
                    $pd->harga          = $item->harga;
                    $pd->diskon         = $item->diskon;
                    $pd->harga_jual     = $item->harga_jual;
                    $pd->jumlah         = $item->jumlah;
                    $pd->total          = $item->harga * $item->jumlah;
                    $pd->toko_id        = $id;
                    $pd->save();

                    //update stok
                    $update_stok = $item->barang;
                    $update_stok->stok = $update_stok->stok - $item->jumlah;
                    $update_stok->save();

                    //delete keranjang belanja
                    $item->delete();
                }
                DB::commit();
                toastr()->success('Transaksi Berhasil disimpan');
                return redirect('/penjualan/toko/' . $id);
                // all good
            } catch (\Exception $e) {
                DB::rollback();
                toastr()->error($e);
                return back();
                // something went wrong
            }
        }
    }
    public function transaksibatal($id)
    {
        $keranjang = Keranjang::where('toko_id')->get();
        foreach ($keranjang as $item) {
            $item->delete();
        }
        toastr()->success('Transaksi Di batalkan');
        return back();
    }
}
