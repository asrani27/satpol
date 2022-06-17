<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use Illuminate\Http\Request;

class IndikatorController extends Controller
{
    public function indikator()
    {
        $data = Indikator::get();
        return view('superadmin.indikator.index', compact('data'));
    }
}
