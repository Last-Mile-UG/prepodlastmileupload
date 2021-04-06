<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{OrderDetail, Orders,User,ProductSubscriptionRequest};
use App\Http\Controllers\MailController;
use Exception;
use Google\Cloud\Firestore\Admin\V1\Index\IndexField\Order;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    public function getOrder($id)
    {
        $model = new Orders();
        // $record = $model->where('user_id',$id)->with(['details' => function($q)
        // {
        //     $q->groupBy('order_id');
        //     // $q->get();
        // }
        // ,'details.users'])->get();

        $record = $model->where('user_id',$id)->with(['details' => function($q){
            $q->select('id', 'order_id', 'vendor_id')->get();
        }])->get();
        if($record->count() > 0)
        {
            return response()->json(['success'=>$record]);
        }
        else
        {
            return response()->json(['error'=>'something went wrong']); 
        }        
    }
    public function orderDetail($id)
    {
        $model = new User();
        $record = $model->with(['orders.details.users'])->find($id);
        $var = 0;
        foreach($record->orders as $orders)
        {
          $var = $var + $orders->price;
        }
         $orderPrice =$var;
       
         if($record->count() > 0)
        {
            $success = ['success'=>$record,'total_price'=>$orderPrice];
            return response()->json(['success'=>$success]);
        }
        else
        {
            return response()->json(['error'=>'something went wrong']); 
        }        
    }
    public function orderstatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'riderId' => 'required|string',
            'orderId' => 'required',
            'status' => 'required|string',
            'vendorId'=>'required',
            
            ]);
        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try
        {
            extract($request->all());
            $factory = (new Factory)->withServiceAccount(__DIR__.'/firebaseKey.json');
            $firestore = $factory->createFirestore();
            $db = $firestore->database();
            $ref = $db->collection('LM_Driver')->documents();
            foreach($ref as $key=>$rider)
            {
                if($rider->exists())
                {
                    $key=$key;
                    $id[]=$rider->id();
                    foreach($id as $ids)
                    {
                        if($ids == $riderId)
                        {
                            $data= $rider->data();
                        
                        }
                    }
                    
                }
            }
                $modelDetail = new OrderDetail();
                if($status=='accept')
                {
                    $orderDetail = $modelDetail->where(['order_id'=> $orderId, 'vendor_id'=> $vendorId])->update(['status'=>$status,'driver_id'=>$riderId]);
                    $orderDetailrecord = $modelDetail->where(['order_id'=> $orderId, 'vendor_id'=> $vendorId])->get();

                    $orderModel = new Orders();
                    $order = $orderModel->find($orderDetailrecord->first()->order_id);
                    if($order){
                        $subject = 'The Rider is on the Way - ('.$order->order_id.')';
                        $body ='Hello (Mr. / Ms.) '.$order->user->name.',<br> The Rider is on the Way! <br> Thank you - Sincerely, <br> The Last Mile Community';
                        $mail = new MailController($subject, $body, $order->user->email);
                        $mail->basic_email();
                    }                
                }
                else
                {
                    $orderDetail = $modelDetail->where(['order_id'=> $orderId, 'vendor_id'=> $vendorId])->update(['status'=>$status]);
                    $orderDetailrecord = $modelDetail->where(['order_id'=> $orderId, 'vendor_id'=> $vendorId])->get();

                    if($status == 'delivered'){
                        $orderModel = new Orders();
                        $order = $orderModel->find($orderDetailrecord->first()->order_id);
                        if($order){
                            $subject = 'Order is delivered - ('.$order->order_id.')';
                            $body ='Hello (Mr. / Ms.) '.$order->user->name.',<br> Your order has been delivered! <br> Thank you - Sincerely, <br> The Last Mile Community';
                            $mail = new MailController($subject, $body, $order->user->email);
                            $mail->basic_email();
                            $mail = new MailController($subject, $body, config('app.mail_to_address'));
                            $mail->basic_email();
                        }
                    }
                }
                return response()->json(['success'=>$orderDetailrecord ]);
            } 
            catch (Exception $e)
            {
                return response()->json(['error'=>$e->getMessage()]);
            }        
    }
    public function subscribeRecord($id)
    {
        $model = new  Orders();
        $record = $model->whereHas('productSubscribe')->with(['productSubscribe','user'])->where('user_id',$id)->get();  
        return response()->json(['success'=>$record ]);
    }
    public function userBuyProduct($id)
    {
        try 
        {
            $model = new OrderDetail();
            $records = $model->whereHas('orders',function($q) use($id)
            {
                $q->select('order_id')->where('user_id',$id);
            })->with(['orders:id,order_id','users','variant'])->get();
            $success['records'] =$records;
            if($success)
            {
                return response()->json(['Success'=>$success]);
            }
            else
            {
                return response()->json(['error'=>'invalid Id']);
            }
        } 
        catch (Exception $e) 
        {
            return response()->json(['error'=>$e->getMessage()]);
        }

    }
    public function pickupOrdes($id)
    {
        try 
        {
            
            $model = new OrderDetail();
            $record = $model->whereHas('orders',function($q)use($id)
            {
                $q->where('user_id',$id);
            })->where('status','pickedup')->with(['orders'])->get();
            if($record->count() > 0)
            {
                return response()->json(['success'=>$record]);
            }
            else
            {
                return response()->json(['error'=>'no records']);
                
            }
        }
        catch (Exception $e) {
            return response()->json(['error'=>'something went wrong']);

        }
    }
    public function ordervarinte($id)
    {
    //   $model =  new OrderDetail();
    //   $record = $model->whereHas('orders',function($q) use($id)
    //   {
    //       $q->where('user_id',$id);
    //   })->select('product_variant_id')->get();
    //   foreach($record as $rec)
    //     {
    //       $id = $rec;
    //     $modeluser = new User();
    //     $modelrecord = $modeluser->whereHas('productvariant')->with(['productvariant' => function($q) use($id)
    //     {
    //       $q->where('id',$id)->get();
    //     }])->get();
    //     }
    //     $success['records']=$record;
    //     $success['records']['users']=$modelrecord;
    //     return response()->json(['success'=>$success]); 
        $model =  new Orders();
        $orderid = $model->select('id')->get();
        foreach($orderid as $orderI)
        {
          
            $modeldetail = new OrderDetail();
            $id = $modeldetail->where('order_id',$orderI)->select('product_variant_id')->get();
        }
        // print_r($id);
        // exit;
        $record = $model->where('user_id',$id)->with(['details.users'=>function($q) use($id)
        {
           $q->whereHas('productvariant')->with(['productvariant'=>function($p) use($id)
           {
            $p->where('id',$id)->get();
           }])->get(); 
        }])->get();
        return response()->json(['success'=>$record]); 




    }
}

