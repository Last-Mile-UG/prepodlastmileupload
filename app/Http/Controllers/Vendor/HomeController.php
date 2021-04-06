<?php namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(auth()->user()->role);exit;
        if(auth()->user()->role == 'admin'){
           return view('admin.home', compact('records'));
        }
        elseif(auth()->user()->role == 'vendor' || auth()->user()->role == 'premium_vendor'){
            
            $id = auth()->user()->id;
            return view('home', compact('id'));
        }
    }
}
