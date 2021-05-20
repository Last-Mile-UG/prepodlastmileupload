<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{User, Products, Orders,VendorReviews,OrderDetail};
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;
use Carbon\Carbon;


use Gloudemans\Shoppingcart\Facades\Cart;
use Google\Cloud\Firestore\Admin\V1\Index\IndexField\Order;

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
        if(auth()->check() && auth()->user()->role == 'admin')
        {
            return view('admin.home');
        }
        elseif(auth()->check() && (auth()->user()->role == 'vendor' || auth()->user()->role == 'premium_vendor'))
        {            
            $id = auth()->user()->id;
            $model = new VendorReviews();
            $records = $model->where('vendor_id',$id)->get();
            $graph1 = self::orderGraph(); // graph1
            $records1 = collect($graph1);
            // print_r(auth()->user()->id);exit;
            $months = $records1->pluck('month');
            $totalOrders = $records1->pluck('total');
            $months = $months->toArray();
            $totalOrders = $records1->pluck('total')->toArray();

            $graph2 = self::orderGraph2();
            $record2 = collect($graph2);
            $MonthGraph2 = $record2->pluck('month')->toArray();
            $AverageGraph2 = $record2->pluck('total');


            $graph3 = self::orderGraph3();
            $record3 = collect($graph3);
            $dayGraph3 = $record3->pluck('day')->toArray();
            $AverageGraph3 = $record3->pluck('total');

            $graph4 = self::orderGraph4(); 
            $records4 = collect($graph4);
            $days = $records4->pluck('day')->toArray();
            $totalOrdersDays = $records4->pluck('total')->toArray();
            
            return view('home', compact('id','records', 'months', 'totalOrders','days','totalOrdersDays','MonthGraph2','AverageGraph2','dayGraph3','AverageGraph3'));
            
        }
        else
        {
            if(auth()->check()){                
                $ordersModel = new Orders();
                $orders = $ordersModel->with(['details' => function($q){
                    $q->with(['users', 'variant.product']);
                }])->where('user_id', auth()->user()->id)->get();

                $subscriptionOrders = $ordersModel->whereHas('details.variant.product', function($q){
                    $q->where('subscription',1);
                })->with(['details' => function($q){
                    $q->whereHas('variant.product', function($p){
                        $p->where('subscription',1);
                    })->with('users');
                }])->where('user_id', auth()->user()->id)->get();
        
                $unsubscribeOrders = $ordersModel->whereHas('details.variant.product', function($q){
                    $q->where('subscription',0);
                })->with(['details' => function($q){
                    $q->whereHas('variant.product', function($p){
                        $p->where('subscription',0);
                    })->with('users');
                }])->where('user_id', auth()->user()->id)->get();

                $vendoraccept = $ordersModel->whereHas('details', function($q){
                    $q->where('status','accept');
                })->with(['details' => function($q){
                    $q->where('status','accept')->with(['users']);
                }])->where('user_id', auth()->user()->id)->get(); 
                $cartCount = Cart::count();

                $riderorders = $ordersModel->whereHas('details',function($q)
                {$q->where('status','accept');})
                   ->with(['details' => function($q)
                   {
                       $q->where('status','accept');
                   }])->where('user_id', auth()->user()->id)->get();
                   $allrider =collect();
                
                   $lat = $lng =null;
                   foreach($riderorders as $riderorderdetail)
                   { 
                       $model = OrderDetail::whereIn('status',['accept','pickedup','delivering'])->find($riderorderdetail->id);
                       if($model)
                       {
                           $allrider->push($model->driver_id);
     
                        }
                        
                    }
                    /*
                    $factory = (new Factory)->withServiceAccount(__DIR__.'/Api/firebaseKey.json');
                    $firestore = $factory->createFirestore();
                    $db = $firestore->database();
                    $ref = $db->collection('LM_Driver')->documents();
                    foreach($ref as $key=>$rider)
                    {
                        if($rider->exists())
                        {
                            $key=$key;
                            $id[]=$rider->id();
                            foreach($allrider as $driverId)
                            {

                                foreach($id as $ids)
                                {
                                    // dd($ids);
                                    if($ids == $driverId)
                                    {
                                        $data= $rider->data();
                                        $lat = $data['position']['latitude'];
                                        $lng =$data['position']['longitude']; 
                                        // dd($lng);exit;
                                     
                                    }
                                }
                            }
                            
                        }
                        
                        
                    }
                    */
                    // dd($allrider);
                
                return view('site.index', compact(['orders','cartCount','lat','lng']));
                // return view('site.dashboard', compact(['vendoraccept','orders','subscriptionOrders','unsubscribeOrders','cartCount','lat','lng']));
            }
        }
    }
      
            

            
  
    private static function orderGraph()
    {
        return DB::select("SELECT o.id, od.order_id as orderId, od.vendor_id,
        YEAR(o.created_at), 
        MONTHNAME(o.created_at) as month,
        COUNT(*) AS total
        FROM orders o LEFT JOIN order_details od on o.id=od.order_id 
        where od.vendor_id =". auth()->user()->id." and Year(o.created_at) =".Carbon::now()->year."
        GROUP BY MONTH(o.created_at)");
    }

    private static function orderGraph2()
    {
       
        return DB::select("SELECT o.id, od.order_id as orderId, od.vendor_id,YEAR(o.created_at), MONTHNAME(o.created_at) as month, COUNT(od.order_id) * SUM(o.price)   AS total FROM orders o LEFT JOIN order_details od on o.id= od.order_id where od.vendor_id = ".auth()->user()->id." and o.created_at >= ".Carbon::now()->subWeek()->format('Y-m-d')." GROUP BY Day(od.created_at)");


    }

    private static function orderGraph3()
    {
        return DB::select("SELECT o.id, od.order_id as orderId, od.vendor_id, o.created_at, DAY(o.created_at), DAYNAME(o.created_at) as day, SUM(od.total_price) / COUNT(*)  AS total FROM orders o LEFT JOIN order_details od on o.id= od.order_id where od.vendor_id = ".auth()->user()->id." and o.created_at >= ".Carbon::now()->subWeek()->format('Y-m-d')." GROUP BY Day(od.created_at)");
    }

    private static function orderGraph4()
    {

        return DB::select("SELECT o.id, od.order_id as orderId, od.vendor_id, o.created_at, DAY(o.created_at), DAYNAME(o.created_at) as day, COUNT(*) AS total FROM orders o LEFT JOIN order_details od on o.id= od.order_id where od.vendor_id = ".auth()->user()->id." and o.created_at >= ".Carbon::now()->subWeek()->format('Y-m-d')." GROUP BY Day(od.created_at)");
    }
}
