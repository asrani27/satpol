<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(Request $req)
    {
        if ($req->password != $req->confirmpassword) {
            toastr()->error('Konfirmasi Password Tidak Sama');
            $req->flash();
            return back();
        }

        $check = User::where('username', $req->username)->first();
        if ($check == null) {
            $role = Role::where('name', 'masyarakat')->first();
            $n = new User;
            $n->name = $req->name;
            $n->username = $req->username;
            $n->email = $req->email;
            $n->telp = $req->telp;
            $n->password = bcrypt($req->password);
            $n->save();

            $n->roles()->attach($role);
            Auth::loginUsingId($n->id);

            return redirect('/');
        } else {
            toastr()->error('Username sudah ada');
            $req->flash();
            return back();
        }
    }
}
