<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Products, ProductVariant, Service, User,UserDetail,UserLocation,Orders,ProductSubscriptionRequest,OrderHistory,Transaction,BannerImage};
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileStore;
use Carbon\Carbon;
use Exception;
use Stripe\Product;
use Illuminate\Support\Facades\Validator;


class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function __construct()
    //  {
    //      $this->middleware('premium.customer');
    //  }
    public function index()
    {
        // \Cookie::queue(\Cookie::make('cookieName1', 'valueasdasd1', 1));
        // // \Cookie::queue('cookie_name', 'its value', 2);
        // return \Cookie::get('cookieName1');
        // return Cart::content()->toArray();
        // return Cart::destroy();
        // print_r(auth()->user());exit;
        $vendorId = 3;
        $productsModel = new Products();
        $records = $productsModel->withCount('reviews')->with(['category', 'user', 'reviews', 'variants.reviews'])->where('vendor_id', $vendorId)->get();
        $products = $records;
        foreach($products as $key=>$value)
        {         
            $id = $value->id;
            $avgQuery = DB::select("SELECT AVG(rating) AS averageRating FROM product_reviews WHERE product_id=$id");
            $avgRating = head($avgQuery)->averageRating;
            $products->avgRating = $avgRating ?? 0;
        }
        $cartCount = count(Cart::content());
        $categories = new Service();
        $categories = $categories->where('vendor_id', $vendorId)->get();
       
        return view('site.index', compact(['products', 'cartCount', 'categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addToCart(Request $request){
        $data = $request->all();
        extract($data);
        $variantModel = new ProductVariant();
        $variant = $variantModel->find($variantId);
        $productsModel = new Products();
        $product = $productsModel->with(['user', 'category', 'variants'])->find($variant->product_id);
        $vendor = UserDetail::where('user_id', $product->user->id)->first();
        $vendorAddress = $vendor->address;

        Cart::setGlobalTax(0);
        Cart::add(
            $variantId, $product->name, $quantity ?? 1, $variant->price, 1,[
                'image' => $variant->image, 
                'vendorName' => $product->user->name,
                'vendorId' => $product->user->id,
                'vendorAddress' => $vendorAddress,
                'description' => $variant->description,
                'category' => $product->category->title,
                'subscription' => 0,
            ]
        );
        
        $result['count'] = count(Cart::content());
        $result['items'] =  Cart::content();
        $result['total'] = Cart::total();
        
        return response()->json($result);
    }
    public function productsubscription(Request $request)
    {
        $data = $request->all();
        extract($data);
        $variantModel = new ProductVariant();
        $variant = $variantModel->find($variantId);
        $productsModel = new Products();
        $product = $productsModel->with(['user', 'category', 'variants'])->find($variant->product_id);
        Cart::setGlobalTax(0);
        Cart::add(
            $variantId, $product->name, $quantity ?? 1, $variant->price, 1,[
                'image' => $variant->image, 
                'vendorName' => $product->user->name,
                'vendorId' => $product->user->id,
                'description' => $variant->description,
                'category' => $product->category->title,
                'subscription' => 1,
                'cycle' => $cycle,
                'date' => $date,
                'time' => $time,
            ]
        );
        $result['count'] = count(Cart::content());
        $result['items'] =  Cart::content();
        $result['total'] = Cart::total();
        return response()->json($result);
       
    }


    public function getProductDataById($productId){        
        $productsModel = new Products();
        $product = $productsModel->with(['user', 'category', 'variants'])->find($productId);        
        $result['product'] = $product;
        $result['count'] = count(Cart::content()); 
        return response()->json($result);
    }

    public function getVariantDataById($id){
        $variantModel = new ProductVariant();
        $result = $variantModel->find($id);
        return response()->json($result);
    }

    public function cartList(){

    }

    public function fetchByProductId($id){
        $productsModel = new Products();
        $records = $productsModel->withCount('reviews')->with('variants')->find($id);

        return response()->json($records);
    }

    public function nearShops(Request $request)
    {
        try
        {
            $data = $request->all();
            extract($data);
            $vendors = new User();
            $shops = $vendors->whereHas('products')->whereHas('locations',function($q) use($getLatitude,$getLongitude){
                $q->selectRaw("user_locations.id, user_locations.user_id, user_locations.title, user_locations.address, user_locations.latitude, user_locations.longitude, 
                ( 6371000 * acos( cos( radians(?) ) *
                cos( radians( latitude ) )
                * cos( radians( longitude ) - radians(?)
                ) + sin( radians(?) ) *
                sin( radians( latitude ) ) )
                ) AS distance", [$getLatitude, $getLongitude , $getLatitude])
                ->having("distance", "<", config('app.shop_radius'))
                ->orderBy("distance",'asc');                    
            })->withCount('reviews')->with(['detail', 'reviews'])->whereIn('role', ['vendor', 'premium_vendor'])->get();
            $cartCount = count(Cart::content());
            return view('site.explore-shops', compact(['cartCount', 'shops']));    
        }
        catch (Exception $e)
        {
            return redirect()->back();
        }

    }
    public function allShops(){
        $vendors = new User();
        $shops = $vendors->whereHas('detail')->whereHas('products')->withCount('reviews')->with(['detail', 'reviews'])->whereIn('role', ['vendor', 'premium_vendor'])->get();
        $cartCount = count(Cart::content());
        return view('site.explore-shops', compact(['cartCount', 'shops']));
    }

   public function vendorProductsPage($vendorId){
        $currentVendor = UserDetail::where('user_id', $vendorId)->first();
        $productsModel = new Products();
        $records = $productsModel->withCount('reviews')->with(['category', 'user', 'reviews', 'variants.reviews'])->where('vendor_id', $vendorId)->get();
        $products = $records;

        foreach($products as $key=>$value)
        {         
            $id = $value->id;
            $avgQuery = DB::select("SELECT AVG(rating) AS averageRating FROM product_reviews WHERE product_id=$id");
            $avgRating = head($avgQuery)->averageRating;
            $products->avgRating = $avgRating ?? 0;
        }
        $cartCount = count(Cart::content());
        $categories = new Service();
        $categories = $categories->where('vendor_id', $vendorId)->get();
        $items = Cart::content();
        $cartCount = count($items);
        $cartTotal = Cart::total();
       
        return view('site.vendor-products-index', compact(['products', 'cartCount', 'categories', 'vendorId','items','cartTotal', 'currentVendor']));
   }

   public function categoryProducts($vendorId, $catId){
    // print_r($a);
    // print_r($b);
    // return response()->json($vendorId);


    $productsModel = new Products();
        $records = $productsModel->whereHas('category', function($q) use($catId){
            $q->where('id', $catId);
        })->withCount('reviews')->with(['category', 'user', 'reviews', 'variants.reviews'])->where('vendor_id', $vendorId)->get();
        $products = $records;

        foreach($products as $key=>$value)
        {         
            $id = $value->id;
            $avgQuery = DB::select("SELECT AVG(rating) AS averageRating FROM product_reviews WHERE product_id=$id");
            $avgRating = head($avgQuery)->averageRating;
            $products->avgRating = $avgRating ?? 0;
        }
        $cartCount = count(Cart::content());
        $categories = new Service();
        $categories = $categories->where('vendor_id', $vendorId)->get();

        return response()->json($products);
        // return view('site.vendor-products-index', compact(['products', 'cartCount', 'categories', 'vendorId']));
   }
   public function profile()
   {
        $cartCount = count(Cart::content());        
        $model = new User();
        $record = $model->with('detail')->find(auth()->user()->id);
        
        return view('site.profile', compact(['cartCount','record']));
   }
   public function profileEdit(ProfileStore $request,$id)
   {
        try
        {   
            $data = $request->all();
            extract($data);
            $model = new User();
            $record = $model->find($id);
            $record->password = (isset($password) && $password) ? Hash::make($password) : $record->password;
            $record->save();
            $modeldetail = new UserDetail();
            $recorddetail = $modeldetail->where('user_id',$id)->first();
            $recorddetail->phone = $phone ??  $recorddetail->phone;
            $recorddetail->birthday = $birthday ??  $recorddetail->birthday;
            $recorddetail->save();
            
        
        
            return redirect()->back();     
        }
        catch (Exception $e) {
            return redirect()->back()->with('error',$e);
        }
      
   }
   public function profileLanguage($id)
   {
      
       $model = new UserDetail();
       $model = $model->where('user_id',$id)->first();
       $model->language = !$model->language;
       $model->save();
       return response()->json($model);
   }
   public function address()
   {
        $user = new UserLocation();
        $user = $user->where('user_id',auth()->user()->id)->latest()->paginate(config('app.pagination_length'));
        // $record = $model->where('user_id',auth()->user()->id)->first(); 
        // print_r($user->toArray());
        // exit;
        $cartCount = count(Cart::content());
      
        return view('site.address', compact(['cartCount','user']));
   }
   public function addressstore(Request $request)
   {

       try
       {
        $data = $request->all();
        extract($data);
            $model = new UserLocation();
            $model->user_id = auth()->user()->id; 
            $model->title = $request->input('title');
            $model->address = $request->input('address');
            $model->latitude = $request->input('latitude');
            $model->longitude = $request->input('longitude');    
            $model->save();
            return redirect()->back()->with('success','Record Inserted Successfully');
       }
       catch (Exception $e)
       {
        return redirect()->back()->with('error',$e); 
       }
   }
   public function allorders()
   {
    //    print_r(auth()->user()->id);
    //    exit;
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
       
        $banner = new BannerImage();
        $banners = $banner->get();
    //    print_r($banners->toArray());exit;

        $cartCount = Cart::count();
        // print_r(json_encode($orders));exit;
        return view('site.allorders', compact(['orders', 'cartCount','unsubscribeOrders','subscriptionOrders','banners']));
    }
   }
   public function return()
   {
        $cartCount = Cart::count();
       return view('site.return',compact('cartCount'));
   }
   public function wishlist()
   {
    $productModel = new Products();
    $products = $productModel->where('wishlist',1)->get();
    $cartCount = Cart::count();
    return view('site.wishlist',compact('cartCount','products'));
   }
   public function orderhistory()
   {
       $model = new Orders();
       $records = $model->where('user_id',auth()->user()->id)->with(['details.users.detail'])->latest()->paginate(config('app.pagination_length'));
    //    print_r($records->toArray());
    //    exit;
       $cartCount = Cart::count();
       return view('site.orderhistory',compact('cartCount','records'));
   }
   public function accountBalance()
   {
       $model = new Transaction();
       $record = $model->where('user_id',auth()->user()->id)->with(['orders.details','users'])->get();
    //    print_r($record->toArray());exit;
        $cartCount = Cart::count();
        return view('site.accountbalance',compact('cartCount','record'));
   }
   public function vendor()
   {
    $cartCount = Cart::count();
    return view('site.vendor',compact('cartCount'));
   }
   public function support()
   {
    $cartCount = Cart::count();
    return view('site.support',compact('cartCount'));
   }
   public function wishlistChange($id){
       $model = new Products();
       $record = $model->find($id);
       $record->wishlist = !$record->wishlist;
       $record->save();
       return $record;
   }

   public function privacypolicy()
   {
    $cartCount = Cart::count();
    return view('site.privacypolicy',compact('cartCount'));
   }
   public function termsofUser()
   {
    $cartCount = Cart::count();
    return view('site.terms',compact('cartCount'));
   }
  public function datenschutz()
  {
    $cartCount = Cart::count();
    return view('site.datenschutz',compact('cartCount'));
  }
  public function impressive()
  {
    $cartCount = Cart::count();
    return view('site.impressive',compact('cartCount'));
  }
  public function feature()
  {
      $model = new Products();
      $products = $model->where('featured',1)->latest()->get();
    $cartCount = Cart::count();
    return view('site.feature',compact('cartCount','products'));
  }
  public function cookie()
  {
    \Cookie::queue(\Cookie::make('Essentials','essentials', 2147483647));
    // return \Cookie::get('cookieName1');   
  }
  public function emailVerification(Request $request)
  {
     
   try{
        $data = $request->all();
        // print_r($data);exit;
        extract($data);
        $subject = 'Registration Request for - '.$role;
        $body ='(Mr. / Ms.) '.$name.', wants to register as a '.$role.' in The Last Mile Community. <br><br>Email: '.$email.'<br><br>Subject: '.$request->get('subject').'<br><br>Description:<br>'.$description;
        $mail = new MailController($subject, $body, config('app.mail_to_address'));
        $mail->basic_email();
        return redirect()->back()->with('sucessSnackBar','Request has been sent Successfully');
   }
   catch(Exception $e)
   {
       return redirect()->back();
   }
  }
  public function help()
  {
    $cartCount = Cart::count();
    return view('site.help',compact('cartCount'));
  }
  


}
