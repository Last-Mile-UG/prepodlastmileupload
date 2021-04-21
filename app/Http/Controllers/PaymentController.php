<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\StripeClient;
use App\{Transaction,
    Orders,
    OrderDetail,
    User,
    UserDetail,
    UserLocation,
    PremiumUserTransacion
};
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $data = $request->all();
        extract($data);
        DB::beginTransaction();
        try {
            $unSubscribeItems = Cart::content()->where('options.subscription', 0);
            if ($unSubscribeItems->isEmpty()) {
                return response()->json(['Message' => 'The cart is empty'], Response::HTTP_NOT_ACCEPTABLE);
            }

            $unSubscribeItemsSum = array_sum(array_column($unSubscribeItems->toArray(), 'subtotal'));
            $unsubscribeCount = $unSubscribeItems->count();
            $amount = Cart::total();
            $cartItems = Cart::content();
            $totalAmount = str_replace(',', '', $amount);

            if (auth()->check()) //if userlogin
            {
                $loggedInUser = auth()->user();

                $userLocation = new UserLocation();
                if ($address_id) {
                    $userAddress = $userLocation->find($address_id);
                } else {
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
                $order->order_id = 'LM-' . time();
                $order->user_id = auth()->user()->id;
                $order->price = $totalAmount;
                $order->driver_id = null;
                $order->user_location_id = $userAddress->id;
                $order->latitude = $userAddress->latitude;
                $order->longitude = $userAddress->longitude;
                $order->address = $userAddress->address;
                $order->tax = 2;  // check
                $order->save();

                // $vendorIds = [];
                foreach ($cartItems as $item) {
                    $orderDetail = new OrderDetail();
                    $orderDetail->order_id = $order->id;
                    $orderDetail->product_variant_id = $item->id;
                    $orderDetail->vendor_id = $item->options->vendorId;
                    $orderDetail->quantity = $item->qty;
                    $orderDetail->price = $item->price;
                    $orderDetail->total_price = $item->subtotal;
                    $orderDetail->save();
                }


                #endregion
                #region transaction
                $paymentObject = self::unsubscribe($request->all(), $unSubscribeItemsSum);
                $transaction = new Transaction();
                $transaction->user_id = auth()->user()->id;
                $transaction->order_id = $order->id;
                $transaction->price = $unSubscribeItemsSum;
                $transaction->object = json_encode($paymentObject);
                $transaction->save();
                #endregion
            } else //Anonymous User Flow
            {

                $user = new User();
                $user->name = 'guest@' . time();
                $user->email = 'guest@' . time() . '.com';
                $user->password = Hash::make('1234');
                $user->role = 'guest';
                $user->status = 1;
                $user->save();
                if ($user) {
                    $userDetail = new UserDetail();
                    $userDetail->user_id = $user->id;
                    $userDetail->user_name = $user->name;
                    $userDetail->email = $user->email;
                    $userDetail->status = 1;
                    $userDetail->save();
                }

                $userLocation = new UserLocation();
                $userLocation->user_id = $user->id;
                $userLocation->title = $address;
                $userLocation->address = $address_description;
                $userLocation->latitude = $latitude;
                $userLocation->longitude = $longitude;
                $userLocation->save();
                $userAddress = $userLocation->find($userLocation->id);

                #region order and orderdetail
                $order = new Orders();
                $order->order_id = 'LM-' . time();
                $order->user_id = $user->id;
                $order->price = $unSubscribeItemsSum;
                $order->driver_id = null;
                $order->user_location_id = $address_id;
                $order->latitude = $userAddress->latitude;
                $order->longitude = $userAddress->longitude;
                $order->address = $userAddress->address;
                $order->tax = 2;
                $order->save();
                foreach ($unSubscribeItems as $item) {
                    $orderDetail = new OrderDetail();
                    $orderDetail->order_id = $order->id;
                    $orderDetail->product_variant_id = $item->id;
                    $orderDetail->vendor_id = $item->options->vendorId;
                    $orderDetail->quantity = $item->qty;
                    $orderDetail->price = $item->price;
                    $orderDetail->total_price = $item->subtotal;
                    $orderDetail->save();
                }
                #endregion
                #region transaction
                #endregion
            }
            $session = $this->createCheckoutSession($unSubscribeItems);
            DB::commit();
            $cart = Cart::destroy();
            return ['session' => ['id' => $session->id]];
        } catch (Exception $e) {
            DB::rollback();
            Log::alert($e->getMessage());

            return response()->json(['Message' => 'Checkout failed'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function createCheckoutSession(Collection $items): Session
    {
        $lineItems = [];
        foreach ($items as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $item->price * 100,
                    'product_data' => [
                        'name' => $item->name,
                        'images' => [$item->options->image],
                    ],
                ],
                'quantity' => $item->qty,
            ];
        }
        $stripe = new StripeClient(config('app.stripe_secret_key'));

        return $stripe->checkout->sessions->create([
            'payment_method_types' => ['card', 'giropay'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => config('app.url') . '/success.html',
            'cancel_url' => config('app.url') . '/cancel.html',
        ]);
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
            'amount' => $totalAmount * 100,
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
            'amount' => $amount * 100,
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

        if ($subscription->status == 'incomplete') {
            // $subject = 'Your Order is Confirmed - ('.$record->order_id.')';
            // $body ='Hello (Mr. / Ms.) '.$user->name.', <br> Your order ('.$record->order_id.') has been accepted and is on the way.
            // <br> Track your Order here: '.config('app.url').'/home <br> Thank you - Sincerely, <br> The Last Mile Community';
            // $mail = new MailController($subject, $body, $user->email);
            // $mail->basic_email();
            // return redirect()->back()->withErrors('Failed To Subscribe');
        } else {
            if ($user->detail->language == 1) {
                $subject = 'Confirmation of Subscription Payment - (' . $record->order_id . ')';
                $body = 'Hello (Mr. / Ms.) ' . $user->name . ', <br> Your order (' . $record->order_id . ') has been accepted and is on the way.
                <br> Track your Order here: ' . config('app.url') . '/home <br> Thank you - Sincerely, <br> The Last Mile Community';
            } else {
                $subject = 'Bestätigung der Abo-Zahlung - (' . $record->order_id . ')';
                $body = 'Hallo (Herr/Frau) ' . $user->name . ', <br> Ihre Bestellung (' . $record->order_id . ') wurde angenommen und ist auf dem Weg.
                <br> Verfolgen Sie Ihre Bestellung hier: ' . config('app.url') . '/home <br> Vielen Dank - Mit freundlichen Grüßen, <br> Die Last Mile Community';
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
                    ["price" => config('app.stripe_premium_customer_plan_id')],
                ]
            ]);
            if ($subscription->status == 'incomplete') {
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
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back();
        }
    }
}
