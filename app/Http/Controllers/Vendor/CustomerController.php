<?php namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{User, Orders, OrderDetail};
class CustomerController extends Controller
{
    protected $routePrefix = 'vendor.';

    public function index(){        
        $paginate = config()->get('app.pagination');
        $orders = new Orders();
        $records = $orders->whereHas('details')->whereHas('user')->with(['user.detail', 'details' => function($q){
            $q->where('vendor_id', auth()->user()->id);
        }])->groupBy('user_id')->paginate($paginate);

        // $od = new OrderDetail();
        // $od = $od->where('vendor_id', 2)->get();
        // print_r($orders->toArray());exit;


        // $records = new User();
        // $paginate = config()->get('app.pagination');
        // $records = $records->with(['detail','orderDetails' => function($q){
        //     $q->where('vendor_id', auth()->user()->id);
        // }])->paginate($paginate);

        // print_r($records[0]->orders[0]->details->where('vendor_id', 30)->toArray());exit;
        // print_r($records);exit;
        // print_r($records->toArray());exit;
        return view($this->routePrefix.'customers.index', compact('records'));
    }

}
