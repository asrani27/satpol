<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SlideController extends Controller
{
    public function index()
    {
        $data = Slide::get();
        return view('superadmin.slide.index', compact('data'));
    }

    public function edit($id)
    {
        $data = Slide::find($id);
        return view('superadmin.slide.edit', compact('data'));
    }

    public function update(Request $req, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($req->all(), [
                'file' => 'mimes:jpg,jpeg,png|max:10256'
            ]);

            if ($validator->fails()) {
                toastr()->error('File Harus Berupa JPG max 10MB');
                return back();
            }

            if ($req->hasFile('file')) {
                $filename = $req->file->getClientOriginalName();
                $filename = date('d-m-Y-') . rand(1, 9999) . $filename;
                $req->file->storeAs('/public/slideshow', $filename);
            }
            Slide::find($id)->update([
                'file' => $filename,
            ]);
            DB::commit();
            toastr()->success('Berhasil Di Simpan');
            return redirect('/slideshow');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Kegagalan Sistem');
            return back();
        }
    }
}
