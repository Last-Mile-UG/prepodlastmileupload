<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{Orders,OrderDetail};

class OrderController extends Controller
{
    protected $routePrefix = 'admin.';
    
    public function index()
    {
        $records = new Orders();
        $paginate = config()->get('app.pagination');
        $records = $records->paginate($paginate);    
        return view($this->routePrefix.'orders.index', compact('records'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $record = new Orders();
        $record = $record->with(['details', 'user.detail'])->find($id);  
        $detailmodel = new OrderDetail();
        $detailrecord = $detailmodel->where('order_id',$id)->get();
        // print_r($detailrecord->toArray());
        // exit;      
        return view($this->routePrefix.'orders.detail', compact('record','detailrecord'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
