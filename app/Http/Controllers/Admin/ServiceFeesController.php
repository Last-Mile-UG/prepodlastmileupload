<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ServiceFees;
class ServiceFeesController extends Controller
{
    protected $routePrefix = 'admin.';

    public function index()
    {
        $records = new ServiceFees();
        $paginate = config()->get('app.pagination');
        $records = $records->paginate($paginate);
        return  view($this->routePrefix.'service-fees.index', compact('records'));
    }

    public function edit($id)
    {
        $record = new ServiceFees();
        $record = $record->find($id);
        return view($this->routePrefix.'service-fees.update', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $record = new ServiceFees();
        $record = $record->find($id);
        $record->price = $request->get('price');
        $record->save();

        return redirect()->route('service-fees.index');
    }
}
