<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\{User,UserLocation,UserCard,DeliveryOption};
use Exception;
use Illuminate\Http\Request;



class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Cart::content();
        $cartCount = count($items);
        $cartTotal = Cart::total();
        
        return view('site.cart.index', compact(['items', 'cartCount', 'cartTotal']));
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

    public function checkout(){ 
        
       
      $user = auth()->user();

       if(!is_null($user))
       {
        $model = new User();
        $record = $model->find(auth()->user()->id);
        $modellocation = new UserLocation();
        $recordlocation = $modellocation->where('user_id',auth()->user()->id)->get();
        $modelcard = new UserCard();
        $recordcard = $modelcard->where('user_id',auth()->user()->id)->get();
        $modaldelivery =  new DeliveryOption();
        $recordDelivery =  $modaldelivery->get();
        $items = Cart::content();
        $cartCount = count($items);
        $cartTotal = Cart::total();
        return view('site.cart.checkout', compact(['items', 'cartCount', 'cartTotal','record','recordlocation','recordcard','recordDelivery']));
        }
        else
        {
            $modaldelivery =  new DeliveryOption();
            $recordDelivery =  $modaldelivery->get();
            $items = Cart::content();
            $cartCount = count($items);
            $cartTotal = Cart::total();
            return view('site.cart.checkout',compact(['items','cartCount','cartTotal','recordDelivery']));

        } 
    }
    // public function checkoutlocation(Request $request)
    // {

    //   try
    //   {

    //     $request->validated();
    //     $data =$request->all();
    //     extract($data);
    //     $userlocation = new UserLocation();
    //     $userlocation->user_id = auth()->user()->id;
    //     $userlocation->title = $name;
    //     $userlocation->address = $address;
    //     $userlocation->save();
    //   } 
    //   catch (Exception $e)
    //   {
    //       return redirect()->back()->with('error',$e);
    //   } 
    // }


    public function removecart(Request $request)
    {
        // print_r($request->all(););exit;
        try
        {
            $items = Cart::remove($request->rowId);
            return redirect()->back();
        }
        catch (Exception $e)
        {
            return redirect()->back()->with($e->getMessage());
        }
        
    }

    public function updateCartQuantity(Request $request)
    {

        try {
            
            
               $data =  $request->all();
               extract($data);

            $items = Cart::update($rowId,$quant);
            
        }
         catch (Exception $e)
        {
            //throw $th;
        }
    }


}
