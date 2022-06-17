<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showlogin()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('superadmin')) {
                return redirect('/beranda');
            } elseif (Auth::user()->hasRole('pegawai')) {
                return redirect('/pegawaisatpol');
            } else {
                return redirect('/masyarakat');
            }
        } else {
            return view('login');
        }
    }

    public function login(Request $req)
    {
        if (Auth::attempt(['username' => $req->username, 'password' => $req->password], true)) {
            if (Auth::user()->hasRole('superadmin')) {
                return redirect('/beranda');
            } elseif (Auth::user()->hasRole('pegawai')) {
                return redirect('/pegawaisatpol');
            } else {
                return redirect('/masyarakat');
            }
        } else {
            toastr()->error('Username / Password Tidak Ditemukan');
            $req->flash();
            return back();
        }
    }
}
