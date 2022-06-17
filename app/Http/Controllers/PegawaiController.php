<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function pegawai()
    {
        $data = Pegawai::orderBy('id', 'DESC')->get();
        return view('superadmin.pegawai.index', compact('data'));
    }
    public function pegawaicreate()
    {
        return view('superadmin.pegawai.create');
    }
    public function pegawaistore(Request $req)
    {
        $attr = $req->all();

        $check = Pegawai::where('nik', $req->nik)->first();
        if ($check == null) {
            Pegawai::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/pegawai');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function pegawaiedit($id)
    {
        $data = Pegawai::find($id);
        return view('superadmin.pegawai.edit', compact('data'));
    }
    public function pegawaiupdate(Request $req, $id)
    {
        $attr = $req->all();
        $check = Pegawai::where('nik', $req->nik)->first();
        if ($check == null) {
            //simpan
            Pegawai::find($id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/pegawai');
        } else {
            if ($id == $check->id) {
                Pegawai::find($id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/pegawai');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function pegawaidelete($id)
    {
        try {
            Pegawai::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }

    public function pegawaiakun($id)
    {
        $k = Pegawai::find($id);
        $check = User::where('username', $k->nik)->first();
        if ($check == null) {
            $role = Role::where('name', 'pegawai')->first();
            $n = new User;
            $n->name = $k->nama;
            $n->username = $k->nik;
            $n->password = bcrypt($k->nik);
            $n->save();

            $n->roles()->attach($role);

            $k->update(['user_id' => $n->id]);

            toastr()->success('Berhasil Di buat, password : ' . $k->nik);
            return back();
        } else {
            toastr()->error('Username sudah ada');
            return back();
        }
    }


    public function pegawaireset($id)
    {
        $k = Pegawai::find($id)->user;
        $k->update([
            'password' => bcrypt(Pegawai::find($id)->nik),
        ]);
        toastr()->success('Berhasil Di reset, password : ' . Pegawai::find($id)->nik);
        return back();
    }
}
