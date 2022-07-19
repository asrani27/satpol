<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        $data = Link::get();
        return view('superadmin.link.index', compact('data'));
    }

    public function edit($id)
    {
        $data = Link::find($id);
        return view('superadmin.link.edit', compact('data'));
    }

    public function update(Request $req, $id)
    {
        Link::find($id)->update($req->all());
        toastr()->success('Berhasil Di Update');
        return redirect('/link');
    }
}
