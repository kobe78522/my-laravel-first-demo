<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function pb(Request $req)
    {
        $lv = 54;
        $version = $req->input('version');

        return view('pb', [
            'ver' => $version,
            'lv' => $lv
        ]);
    }
}
