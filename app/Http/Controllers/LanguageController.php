<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(Request $request, $local)
    {
        session(['App_LOCAL'=>$local]);
        return redirect()->back();
    }
}
