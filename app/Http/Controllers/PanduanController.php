<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanduanController extends Controller
{
    public function syarat()
    {
        return view('pages.syarat');
    }

    public function kebijakan()
    {
        return view('pages.kebijakan');
    }
    public function panduan()
    {
        return view('pages.panduan');
    }
    public function detailPanduan()
    {
        return view('pages.detailpanduan');
    }
    public function hubungidev()
    {
        return view('pages.hubungidev');
    }
}
