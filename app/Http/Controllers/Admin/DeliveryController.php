<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\{DeliveryCreate, DeliveryUpdate};
use DB;
use App\DeliveryOption;
class DeliveryController extends Controller
{
    protected $routePrefix = 'admin.';

    public function index(){
        $records = new DeliveryOption();
        $paginate = config()->get('app.pagination');
        $records = $records->paginate($paginate);

        return view($this->routePrefix.'delivery-options.index', compact('records'));
    }
    public function create(){
        return view($this->routePrefix.'delivery-options.create');
    }
    public function store(DeliveryCreate $request){
        $request->validated();
        $data = $request->all();
        extract($data);
        $delivery = new DeliveryOption();
        $delivery->title = $title;
        $delivery->price = $price;
        $delivery->status = $status;
        $delivery->save();
        return back()->withStatus(__('Record added successfully.'));
    }

    public function show($id) {
        $products = DB::select('select * from deliveries where id = ?',[$id]);
        $role = 'vendor';
        $services = DB::select('select * from services');
        $vendor = DB::select('select * from users where role = ?',[$role]);
        $delivery_option = DB::select('select options from delivery_options');
        return view($this->routePrefix.'delivery-options.update',compact('products','services','vendor', 'delivery_option'));
    }

    public function edit($id){
        $record = new DeliveryOption();
        $record = $record->find($id);
        return view($this->routePrefix.'delivery-options.update', compact('record'));
    }

    public function update(DeliveryUpdate $request, $id){
        $request->validated();
        $data = $request->all();
        extract($data);
        $delivery = new DeliveryOption();
        $delivery = $delivery->find($id);
        $delivery->title = $title;
        $delivery->price = $price;
        $delivery->status = $status;
        $delivery->save();

        return redirect()->route('delivery.index')->withStatus(__('Record successfully updated.'));
    }
    public function destroy($id)
    {
        $record = new DeliveryOption();
        $record = $record->findOrFail($id);
        $record->delete();

        return redirect()->back()->withStatus(__('Product successfully deleted.'));
    }
}
