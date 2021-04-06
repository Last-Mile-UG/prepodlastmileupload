<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Gloudemans\Shoppingcart\Facades\Cart;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\CartHistory;

class CartController extends Controller
{
    public $successStatus = 200;

    public function __construct(){
        // Cart::setGlobalTax(0);
    }

    // public function getAll()
    // {
    //     return Cart::content();
    // }

    // public function getById($id)
    // {
    //     return Cart::get($id);
    // }

    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:product_variants,id',
            'name' => 'required|string',
            'qty' => 'required|integer',
            'price' => 'required',
        ]);

        $message = 'Cart Item successfully Added';
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try{
            $data = $request->all();        
            extract($data);
            $cart = new CartHistory;
            $cart->product_variant_id = $id;  
            $cart->name = $name;
            $cart->quantity = $qty;
            $cart->price = $price;
            $cart->total = $price;
            $cart->save();
            
            return response()->json(['success' => $message], $this->successStatus);
        }catch(Exception $e){
            return response()->json(['error' => 'Something went wrong'], 401);
        }

        return response()->json(['success' => $message], $this->successStatus);
    }

    // public function update($id, $qty)
    // {
    //     return Cart::update($id, $qty);
    // }

    // public function delete()
    // {
    //     Cart::destroy();
    // } 
}