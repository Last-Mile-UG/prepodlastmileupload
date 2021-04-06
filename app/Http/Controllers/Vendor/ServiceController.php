<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;

class ServiceController extends Controller
{
    protected $routePrefix = 'vendor.';

    public function index()
    {
        $records = new Service();
        $paginate = config()->get('app.pagination');
        $records = $records->where('vendor_id', auth()->user()->id)->paginate($paginate);

        return view($this->routePrefix.'services.index', compact('records'));
    }


    public function create()
    {
        return view($this->routePrefix.'services.create');
    }


    public function store(Request $request)
    {
        $record = new Service();
        $record->title = $request->get('title');
        $record->vendor_id = auth()->user()->id;
        $record->save();

        return redirect()->back()->withStatus(__('Record successfully created.'));
    }


    public function show($id)
    {
        $services = DB::select('select * from services where id = ?',[$id]);
        return view($this->routePrefix.'services.update',compact('services'));
    }


    public function edit($id)
    {
        $record = new Service();
        $record = $record->findOrFail($id);

        return view($this->routePrefix.'services.update', compact('record'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        extract($data);
        $service = new Service();
        $service = $service->find($id);
        $service->title = $name;
        $service->status = $status;
        $service->save();
        return redirect()->route('services.index')->withStatus(__('Record successfully updated.'));
    }


    public function destroy($id)
    {
        $record = new Service();
        $record = $record->findOrFail($id);
        $record->delete();

        return redirect()->back()->withStatus(__('Record successfully deleted.'));
    }
}
