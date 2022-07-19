<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Slide;
use App\Models\Berita;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        //detect device 
        $agent = new Agent;

        if ($agent->isDesktop()) {
            return redirect('/login');
        }

        $slide = Slide::get();
        $website = Link::where('nama', 'website')->first()->link;
        $jdih = Link::where('nama', 'jdih')->first()->link;
        $ppid = Link::where('nama', 'ppid')->first()->link;
        $elapor = Link::where('nama', 'elapor')->first()->link;
        $whatsapp = Link::where('nama', 'whatsapp')->first()->link;
        $instagram = Link::where('nama', 'instagram')->first()->link;
        $facebook = Link::where('nama', 'facebook')->first()->link;
        $berita = Berita::orderBy('id', 'DESC')->take(3)->get();
        return view('welcome', compact('slide', 'website', 'jdih', 'ppid', 'elapor', 'whatsapp', 'instagram', 'facebook', 'berita'));
    }
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
