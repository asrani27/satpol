<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GantiPasswordController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('gantipass', compact('data'));
    }

    public function update(Request $req)
    {
        if (!Hash::check($req->old_password, Auth::user()->password)) {
            toastr()->error('Password Lama Tidak Sama');
            return back();
        }
        if ($req->password != $req->confirmpassword) {
            toastr()->error('Password Baru Tidak Sesuai');
            return back();
        } else {

            Auth::user()->update([
                'password' => bcrypt($req->password),
            ]);

            Auth::logout();
            toastr()->success('Berhasil Di Update, Login Dengan Password Baru');
            return redirect('/');
        }
    }
}
