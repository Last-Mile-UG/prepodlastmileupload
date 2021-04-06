<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use Exception;
use App\{Transaction, Orders, OrderDetail, User, UserCard, UserDetail, UserLocation, ProductSubscriptionRequest, ProductVariant, Products};
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public $successStatus = 200;
    
    public function checkout(Request $request){        
        
        $data = $request->all();
        extract($data);
        
        DB::beginTransaction();
        try
        {
            $cartItems = collect(json_decode($cartItems));
             
            $subscribeItems = $cartItems->where('subscribe',1);
            $subscribeItemsSum = array_sum(array_column($subscribeItems->toArray(), 'subtotal'));
            $subscribeCount = $subscribeItems->count();
            
            $unSubscribeItems = $cartItems->where('subscribe',0);
            $unSubscribeItemsSum = array_sum(array_column($unSubscribeItems->toArray(), 'subtotal'));
            $unsubscribeCount = $unSubscribeItems->count();
            
            $amount = $totalAmount;
            
            $totalAmount = str_replace(',', '', $amount);
            
            $message = 'Order Booking Successful';

            if(isset($userId) && $userId) //if userlogin
            {
                $user = new User();
                $loggedInUser = $user->find($userId);
                
                // if(!$payment_method_id)
                // {
                //     $userCard = new UserCard();                    
                //     $userCard->user_id = $userId;
                //     $userCard->card_name = $card_name;
                //     $userCard->number = $card_number;
                //     $userCard->exp_month = $exp_month;
                //     $userCard->exp_year = $exp_year;
                //     $userCard->cvc = $cvc;
                //     $userCard->save();
                // }
                
                $userLocation = new UserLocation();
                if(isset($address_id) && $address_id)
                {
                    $userAddress = $userLocation->find($address_id);
                }
                else
                {                    
                    $userLocation->user_id = $loggedInUser->id;
                    $userLocation->title = 'Current Address';
                    $userLocation->address = $address;
                    $userLocation->latitude = $latitude;	
                    $userLocation->longitude = $longitude;
                    $userLocation->save();                 
                    $userAddress = $userLocation->find($userLocation->id);                    
                }
               
            
                #region order and orderdetail
                    $order = new Orders();
                    $order->order_id = 'LM-'.time();
                    $order->user_id =  $loggedInUser->id;
                    $order->price = $totalAmount;
                    $order->driver_id = null;
                    $order->user_location_id = $userAddress->id;
                    $order->latitude = $userAddress->latitude;
                    $order->longitude = $userAddress->longitude;
                    $order->address = $userAddress->address;
                    $order->tax = $tax;
                    $order->save();
                    
                    foreach($cartItems as $item)
                    {
                        $orderDetail = new OrderDetail();
                        $orderDetail->order_id  = $order->id;
                        $orderDetail->product_variant_id  = $item->id;
                        $orderDetail->vendor_id  = $item->vendorId;
                        $orderDetail->quantity = $item->quantity;
                        $orderDetail->price = $item->price;
                        $orderDetail->total_price = $item->subtotal;
                        $orderDetail->save();
                        
                        if($item->subscribe == 1){
                            $variantModel = new ProductVariant();
                            $variant = $variantModel->find($item->id);
                            $productsModel = new Products();
                            $product = $productsModel->find($variant->product_id);
        
                            $subscription = new ProductSubscriptionRequest();
                            $subscription->product_id = $product->id;
                            $subscription->product_variant_id = $item->id;
                            
                            $subscription->order_id = $order->id;
                            $subscription->order_detail_id = $orderDetail->id;
                            $subscription->user_id = $loggedInUser->id;
                            $subscription->vendor_id = $item->vendorId;
                            $subscription->start_time = Carbon::now()->format('h:i:s');
                            $subscription->request_date = Carbon::parse($item->dated)->format('Y-m-d');
                            $subscription->billing_cycle = $item->package;
                            $subscription->status = 1;
                            $subscription->save();
                            self::subscribe($request->all(), $item->subtotal, $order->id, $loggedInUser, $item->package);
                        }
                    }
                    
                    #endregion
                    #region transaction
                    if($unsubscribeCount > 0){
                        $paymentObject = self::unsubscribe($request->all(), $unSubscribeItemsSum);
                        $transaction = new Transaction();
                        $transaction->user_id = $loggedInUser->id;
                        $transaction->order_id = $order->id;
                        $transaction->price = $unSubscribeItemsSum;
                        $transaction->object = json_encode($paymentObject);
                        $transaction->save();
                    }
                #endregion              
            }
            else //Anonymous User Flow
            {

                $user = new User();
                $user->name = 'guest@'.time();
                $user->email = 'guest@'.time().'.com';
                $user->password = Hash::make('1234');
                $user->role = 'guest';
                $user->status = 1;
                $user->save();
                if($user)
                {
                    $userDetail = new UserDetail();
                    $userDetail->user_id = $user->id;
                    $userDetail->user_name = $user->name;
                    $userDetail->email = $user->email;
                    $userDetail->status = 1;
                    $userDetail->save();
                }
                // if(!$payment_method_id)
                // {
                //     $userCard = new UserCard();                    
                //     $userCard->user_id = $user->id;
                //     $userCard->card_name = $card_name;
                //     $userCard->number = $card_number;
                //     $userCard->exp_month = $exp_month;
                //     $userCard->exp_year = $exp_year;
                //     $userCard->cvc = $cvc;
                //     $userCard->save();
                // }
                    $userLocation = new UserLocation();
                    $userLocation->user_id = $user->id;
                    $userLocation->title = 'Current Address';
                    $userLocation->address = $address;
                    $userLocation->latitude = $latitude;	
                    $userLocation->longitude = $longitude;
                    $userLocation->save();
                    $userAddress = $userLocation->find($userLocation->id);  

                if($unsubscribeCount > 0){
                #region order and orderdetail
                    $order = new Orders();
                    $order->order_id = 'LM-'.time();
                    $order->user_id =  $user->id;
                    $order->price = $unSubscribeItemsSum;
                    $order->driver_id = null;
                    $order->user_location_id = $userAddress->id;
                    $order->latitude = $userAddress->latitude;
                    $order->longitude = $userAddress->longitude;
                    $order->address = $userAddress->address;
                    $order->tax = $tax;
                    $order->save();
                    foreach($unSubscribeItems as $item)
                    {
                        $orderDetail = new OrderDetail();
                        $orderDetail->order_id  = $order->id;
                        $orderDetail->product_variant_id  = $item->id;
                        $orderDetail->vendor_id  = $item->options->vendorId;
                        $orderDetail->quantity = $item->qty;
                        $orderDetail->price = $item->price;
                        $orderDetail->total_price = $item->subtotal;
                        $orderDetail->save();
                    }
                        if($item->options->subscribe == 1){
                           $message ="Your Order has been placed. To Avail Subscribtion Product please Signup";
                        }
                #endregion
                #region transaction

                    $paymentObject = self::unsubscribe($request->all(), $unSubscribeItemsSum);
                    $transaction = new Transaction();
                    $transaction->user_id = $user->id;
                    $transaction->order_id = $order->id;
                    $transaction->price = $unSubscribeItemsSum;  //what about tax ?????
                    $transaction->object = json_encode($paymentObject);
                    $transaction->save();
                }
                #endregion  
            }
            DB::commit();
            
            $success['records'] = $order;
            return response()->json(['success' => $success], $this->successStatus);
        }
      catch(Exception $e){          
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
      }
    }
    private static function unsubscribe($request, $amount)
    {
        extract($request);
        
        $stripe = new \Stripe\StripeClient(config('app.stripe_secret_key'));
        $token = $stripe->tokens->create([
            'card' => [ 
            'number' => $number,
            'exp_month' => $exp_month,
            'exp_year' => $exp_year,
            'cvc' => $cvc,
            ],
        ]);

        $paymentObject = $stripe->charges->create([
            'amount' => $amount*100,
            'currency' => 'usd',
            'source' => $token->id, 
            'description' => 'payment successfully made',
        ]);

        return $paymentObject;
    }
    private static function subscribe($request, $amount, $orderId, $user, $subscriptionInterval)
    {
        extract($request);
        $stripe = new \Stripe\StripeClient(config('app.stripe_secret_key'));
        $token = $stripe->tokens->create([
            'card' => [
            'number' => $number,
            'exp_month' => $exp_month,
            'exp_year' => $exp_year,
            'cvc' => $cvc,
            ],
        ]); 
        $plan = $stripe->plans->create([
            'amount' => $amount*100,
            'currency' => 'usd',
            'interval' => $subscriptionInterval,
            'product' => config('app.stripe_product_id'),
          ]);

        // customer creation
        $customer = $stripe->customers->create(
            array(
                "card" => $token->id,
                "name" => $user->name,
                "email" => $user->email //$email
            )
        );        
        
        $subscription = $stripe->subscriptions->create([
            "customer" => $customer->id,
            "items" => [
                ["price" => $plan->id],
            ]
        ]);
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->order_id = $orderId;
        $transaction->price = $amount;
        $transaction->object = json_encode($subscription);
        $transaction->save();
    }
}