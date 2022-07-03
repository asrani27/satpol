<?php

namespace App\Http\Controllers;

use App\Models\BaseUrl;
use App\Models\Keluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BerandaController extends Controller
{
    public function index()
    {
        $baru = Keluhan::where('status', 0)->count();
        return view('superadmin.beranda', compact('baru'));
    }

    public function masyarakat()
    {
        $data = Keluhan::where('user_id', Auth::user()->id)->get();
        return view('masyarakat.beranda', compact('data'));
    }

    public function pegawai()
    {
        $data = Keluhan::where('status', '!=', 0)->orderBy('id', 'DESC')->get();
        return view('pegawai.beranda', compact('data'));
    }

    public function finishTask($id)
    {
        $data = Keluhan::find($id);
        return view('pegawai.selesai', compact('data'));
    }

    public function selesaiTask(Request $req, $id)
    {
        $data = Keluhan::find($id);

        if ($data->status == 2) {
            toastr()->error('telah Diselesaikan');
            return redirect('/');
        }

        DB::beginTransaction();
        try {
            $validator = Validator::make($req->all(), [
                'file' => 'mimes:jpg,jpeg|max:10256'
            ]);

            if ($validator->fails()) {
                toastr()->error('File Harus Berupa JPG max 10MB');
                return back();
            }

            if ($req->hasFile('file')) {
                $filename = $req->file->getClientOriginalName();
                $filename = date('d-m-Y-') . rand(1, 9999) . $filename;
                $req->file->storeAs('/public/foto', $filename);
                $foto_selesai = $filename;
            } else {
                $foto_selesai = null;
            }

            $up = $data;
            $up->foto_selesai = $foto_selesai;
            $up->keterangan = $req->keterangan;
            $up->status = 2;
            $up->solver = Auth::user()->pegawai->id;
            $up->save();
            DB::commit();
            toastr()->success('Berhasil Di Simpan');
            return redirect('/pegawaisatpol');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Kegagalan Sistem');
            return back();
        }
        return view('pegawai.selesai', compact('data'));
    }
}
