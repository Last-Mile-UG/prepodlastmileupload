<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{User,BannerImage};

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
        // dd(auth()->user()->role);
        if(auth()->user()->role == 'admin'){
            return view('admin.home');
        }
        elseif(auth()->user()->role == 'vendor' || auth()->user()->role == 'premium_vendor'){
            $id = auth()->user()->id;
            return view('home', compact('id'));
        }
    }
    protected $routePrefix = 'admin.';
    public function create()
    {
        return view($this->routePrefix.'banner.bannerimages');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        extract($data);
        $model = new BannerImage();
        $model->user_id = auth()->user()->id;
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/images/banners/',$filename);
            $model->image =$filename;
        }
        else
        {
            $model->Image = '';
        }
        $model->save();
        return view($this->routePrefix.'banner.bannerimages')->withStatus(__('Product successfully created.'));
    }
}
