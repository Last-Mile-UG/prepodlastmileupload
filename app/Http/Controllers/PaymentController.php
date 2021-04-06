<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use App\{Transaction, Orders, OrderDetail, User, UserCard, UserDetail, UserLocation, ProductSubscriptionRequest, ProductVariant, Products,PremiumUserTransacion};
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {        
        // print_r($request->toArray());	
        // exit;


        $subscribeItems = Cart::content()->where('options.subscription',1);
        $subscribeItemsSum = array_sum(array_column($subscribeItems->toArray(), 'subtotal'));
        $subscribeCount = $subscribeItems->count();
        $data= $request->all();
        extract($data);
        DB::beginTransaction();
        try
        {
            
            $unSubscribeItems = Cart::content()->where('options.subscription',0);        
            $unSubscribeItemsSum = array_sum(array_column($unSubscribeItems->toArray(), 'subtotal'));
            $unsubscribeCount = $unSubscribeItems->count();
            
            $amount = Cart::total();
            $cartItems = Cart::content();
            $totalAmount = str_replace(',', '', $amount);
            $message = 'Order Booking Successful';

            if(auth()->check()) //if userlogin
            {
                $loggedInUser = auth()->user();
                
                if(!$payment_method_id)
                {
                    $userCard = new UserCard();                    
                    $userCard->user_id = auth()->user()->id;
                    $userCard->card_name = $card_name;
                    $userCard->number = $card_number;
                    $userCard->exp_month = $exp_month;
                    $userCard->exp_year = $exp_year;
                    $userCard->cvc = $cvc;
                    $userCard->save();
                }
                
                $userLocation = new UserLocation();
                if($address_id)
                {
                    $userAddress = $userLocation->find($address_id);
                }
                else
                {                    
                    $userLocation->user_id = auth()->user()->id;
                    $userLocation->title = $address;
                    $userLocation->address = $address_description;
                    $userLocation->latitude = $latitude;	
                    $userLocation->longitude = $longitude;
                    $userLocation->save();                 
                    $userAddress = $userLocation->find($userLocation->id);                    
                }
               
            
                #region order and orderdetail
                    $order = new Orders();
                    $order->order_id = 'LM-'.time();
                    $order->user_id =  auth()->user()->id;
                    $order->price = $totalAmount;
                    $order->driver_id = null;
                    $order->user_location_id = $userAddress->id;
                    $order->latitude = $userAddress->latitude;
                    $order->longitude = $userAddress->longitude;
                    $order->address = $userAddress->address;
                    $order->tax = 2;  // check 
                    $order->save();
                    
                    // $vendorIds = [];
                    foreach($cartItems as $item)
                    {
                        $orderDetail = new OrderDetail();
                        $orderDetail->order_id  = $order->id;
                        $orderDetail->product_variant_id  = $item->id;
                        $orderDetail->vendor_id  = $item->options->vendorId;
                        $orderDetail->quantity = $item->qty;
                        $orderDetail->price = $item->price;
                        $orderDetail->total_price = $item->subtotal;
                        $orderDetail->save();
                        
                        // array_push($vendorIds, $item->options->vendorId);

                        if($item->options->subscription == 1){
                            $variantModel = new ProductVariant();
                            $variant = $variantModel->find($item->id);
                            $productsModel = new Products();
                            $product = $productsModel->find($variant->product_id);
        
                            $subscription = new ProductSubscriptionRequest();
                            $subscription->product_id = $product->id;
                            $subscription->product_variant_id = $item->id;
                            
                            $subscription->order_id = $order->id;
                            $subscription->order_detail_id = $orderDetail->id;
                            $subscription->user_id = auth()->user()->id;
                            $subscription->vendor_id = $item->options->vendorId;
                            $subscription->start_time = $item->options->time;
                            $subscription->request_date = $item->options->date;
                            $subscription->billing_cycle = $item->options->cycle;
                            $subscription->status = 1;
                            $subscription->save();
                            
                            self::subscribe($request->all(), $item->subtotal, $order->id, $loggedInUser, $item->options->cycle);
                        }
                    }

                        // $vendorIds = array_unique($vendorIds);                    
                        // foreach($endorIds as $id){
                        //     $vendor = new User();
                        //     $vendor = $vendor->find($id);

                        //     $orderDetail = new OrderDetail();
                        //     $orderDetail->where('order_id', $order->id)->get();
                        //     $subject = 'You have a new Order - '.$order->order_id;
                        //     $body = '';
                        //     $body .='Hello (Mr. / Ms.) '.$vendor->name.', <br>You have received an order set to be delivered: (Set Delivery Time) <br> Please see the below order details: <br>';                        
                        //     $body .= 'Order Amount: '.$order->price;
                        //     $body .= 'Order Amount: '.$order->price;
                        //     $body .= 'Order Amount: '.$order->price;
                        //     $body .= 'Order Amount: '.$order->price;
                        //     $body .= 'Shop Now-'.config('app.url');
    
                        //     $mail = new MailController($subject, $body, $vendor->email);
                        //     $mail->basic_email();

                        // }


                    #endregion
                    #region transaction
                    if($unsubscribeCount > 0){
                        $paymentObject = self::unsubscribe($request->all(), $unSubscribeItemsSum);
                        $transaction = new Transaction();
                        $transaction->user_id = auth()->user()->id;
                        $transaction->order_id = $order->id;
                        $transaction->price = $unSubscribeItemsSum;
                        $transaction->object = json_encode($paymentObject);
                        $transaction->save();
                    }
                #endregion 
                $route = 'home';

                if($loggedInUser->detail->language == 1){
                    $subject = 'Welcome to the Last Mile Community';
                    $body ='Hello (Mr. / Ms.) '.$loggedInUser->name.'<br> Welcome to the Last Mile Community. You now have joined the local network of shops and
                    services built for the sustainable shopping. <br> Shop Now as a registered member or join premium membership for free deliveries, increased
                    delivery options and premium benefits from selected shops. <br> Shop Now- ('.config('app.url').') <br> Thank you - Sincerely, <br> The Last Mile Community';
                }
                else{
                    $subject = 'Willkommen bei der Last-Mile-Community';
                    $body ='Hallo (Herr / Frau) '.$loggedInUser->name.'<br> herzlich willkommen in der Last Mile Community. Sie sind nun Teil des lokalen Netzwerks von
                    Geschäften und Dienstleistungen, das für den nachhaltigen Einkauf aufgebaut wurde. <br> Shoppen Sie jetzt als registriertes Mitglied oder werden Sie Premium-Mitglied für kostenlose
                    Lieferungen, erweiterte Lieferoptionen und Premium-Vorteile ausgewählter Shops. <br> Jetzt einkaufen- ('.config('app.url').') <br> Vielen Dank - mit freundlichen Grüßen, <br> Die Last Mile Community';
                }
                $mail = new MailController($subject, $body, $loggedInUser->email);
                $mail->basic_email();
         
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
                if(!$payment_method_id)
                {
                    $userCard = new UserCard();                    
                    $userCard->user_id = $user->id;
                    $userCard->card_name = $card_name;
                    $userCard->number = $card_number;
                    $userCard->exp_month = $exp_month;
                    $userCard->exp_year = $exp_year;
                    $userCard->cvc = $cvc;
                    $userCard->save();
                }
                    $userLocation = new UserLocation();
                    $userLocation->user_id = $user->id;
                    $userLocation->title = $address;
                    $userLocation->address = $address_description;
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
                    $order->user_location_id = $address_id;
                    $order->latitude = $userAddress->latitude;
                    $order->longitude = $userAddress->longitude;
                    $order->address = $userAddress->address;
                    $order->tax = 2;
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
                    if($subscribeCount > 0){
                       $message ="Your Order has been placed. To Avail Subscribtion Product please Signup";
                    }
                #endregion
                #region transaction

                    $paymentObject = self::unsubscribe($request->all(), $unSubscribeItemsSum);
                    $transaction = new Transaction();
                    $transaction->user_id = $user->id;
                    $transaction->order_id = $order->id;
                    $transaction->price = $unSubscribeItemsSum; // what about tax? 
                    $transaction->object = json_encode($paymentObject);
                    $transaction->save();
                }
                #endregion  
                $route = 'site';

                if($loggedInUser->detail->language == 1){
                    $subject = 'Welcome to the Last Mile Community';
                    $body ='Hello (Mr. / Ms.) '.$user->name.'<br> Welcome to the Last Mile Community. You now have joined the local network of shops and
                    services built for the sustainable shopping. <br> Shop Now as a registered member or join premium membership for free deliveries, increased
                    delivery options and premium benefits from selected shops. <br> Shop Now- ('.config('app.url').') <br> Thank you - Sincerely, <br> The Last Mile Community';
                }else{
                    $subject = 'Willkommen bei der Last-Mile-Community';
                    $body ='Hallo (Herr / Frau) '.$loggedInUser->name.'<br> herzlich willkommen in der Last Mile Community. Sie sind nun Teil des lokalen Netzwerks von
                    Geschäften und Dienstleistungen, das für den nachhaltigen Einkauf aufgebaut wurde. <br> Shoppen Sie jetzt als registriertes Mitglied oder werden Sie Premium-Mitglied für kostenlose
                    Lieferungen, erweiterte Lieferoptionen und Premium-Vorteile ausgewählter Shops. <br> Jetzt einkaufen- ('.config('app.url').') <br> Vielen Dank - mit freundlichen Grüßen, <br> Die Last Mile Community';
                }

                $mail = new MailController($subject, $body, $user->email);
                $mail->basic_email();
            }
            DB::commit();
            $cart = Cart::destroy();
            return redirect()->route($route)->with(['message' => $message]);
        }
      catch(Exception $e){ 
            DB::rollback();
            return redirect()->back();
      }
    }
    private static function unsubscribe($request, $totalAmount)
    {
        extract($request);
        
        $stripe = new \Stripe\StripeClient(config('app.stripe_secret_key'));
        $token = $stripe->tokens->create([
            'card' => [ 
            'number' => $card_number,
            'exp_month' => $exp_month,
            'exp_year' => $exp_year,
            'cvc' => $cvc,
            ],
        ]);

        $paymentObject = $stripe->charges->create([
            'amount' => $totalAmount*100,
            'currency' => 'eur',
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
            'number' => $card_number,
            'exp_month' => $exp_month,
            'exp_year' => $exp_year,
            'cvc' => $cvc,
            ],
        ]); 
        $plan = $stripe->plans->create([
            'amount' => $amount*100,
            'currency' => 'eur',
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

        if($subscription->status == 'incomplete'){
            // $subject = 'Your Order is Confirmed - ('.$record->order_id.')';
            // $body ='Hello (Mr. / Ms.) '.$user->name.', <br> Your order ('.$record->order_id.') has been accepted and is on the way.
            // <br> Track your Order here: '.config('app.url').'/home <br> Thank you - Sincerely, <br> The Last Mile Community';
            // $mail = new MailController($subject, $body, $user->email);
            // $mail->basic_email();
            // return redirect()->back()->withErrors('Failed To Subscribe');
        }
        else
        {
            if($user->detail->language == 1){
                $subject = 'Confirmation of Subscription Payment - ('.$record->order_id.')';
                $body ='Hello (Mr. / Ms.) '.$user->name.', <br> Your order ('.$record->order_id.') has been accepted and is on the way.
                <br> Track your Order here: '.config('app.url').'/home <br> Thank you - Sincerely, <br> The Last Mile Community';
            }
            else{
                $subject = 'Bestätigung der Abo-Zahlung - ('.$record->order_id.')';
                $body ='Hallo (Herr/Frau) '.$user->name.', <br> Ihre Bestellung ('.$record->order_id.') wurde angenommen und ist auf dem Weg.
                <br> Verfolgen Sie Ihre Bestellung hier: '.config('app.url').'/home <br> Vielen Dank - Mit freundlichen Grüßen, <br> Die Last Mile Community';
            }
            $mail = new MailController($subject, $body, $user->email);
            $mail->basic_email();
            return redirect()->back()->withErrors('Failed To Subscribe');
        }

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->order_id = $orderId;
        $transaction->price = $amount;
        $transaction->object = json_encode($subscription);
        $transaction->save();
    }

    public function premiumCustomer()
    {
       
        $cartCount = count(Cart::content());        
        return view('site.premium', compact(['cartCount']));
    }
    public function basicUser()
    {
        $model = new User();
        $record = $model->find(auth()->user()->id);
        $record->customer_type = 1;
        $record->save();
        return redirect()->route('site');        
    }
    public function premiumUser(Request $request)
    {
        // print_r($request->all());exit;
        extract($request->all());
        try {
            DB::beginTransaction();
            $stripe = new \Stripe\StripeClient(config('app.stripe_secret_key'));
             // customer creation
            $customer = $stripe->customers->create(
                array(
                    "card" => $stripeToken,
                    "name" => $cardholder,
                    "email" => auth()->user()->email //$email
                )
            );        
            
            $subscription = $stripe->subscriptions->create([
                "customer" => $customer->id,
                "items" => [
                    ["price" =>config('app.stripe_premium_customer_plan_id')],
                ]
            ]);
            if($subscription->status == 'incomplete'){
                return redirect()->back()->withErrors('Failed To Subscribe');
            }
            
            $transaction = new PremiumUserTransacion();
            $transaction->user_id = auth()->user()->id;
            $transaction->price = config('app.premium_customer_package_price');
            $transaction->object = json_encode($subscription);
            $transaction->save();
            
            $model = new User();
            $record = $model->find(auth()->user()->id);
            $record->customer_type = 2;
            $record->role = "premium_customer";
            $record->save();
            DB::commit();

            return redirect()->route('site');
        }
        catch (Exception $e)
        {
            DB::rollback();
            return redirect()->back();
        }
    }
}