<?php namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\{Orders,OrderDetail};
use App\Http\Controllers\MailController;
use Exception;
use Kreait\Firebase\Factory;
use Stripe\Order;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    protected $routePrefix = 'vendor.';

    public function index()
    {
        

        $records = new Orders();
        $paginate = config()->get('app.pagination');
        $records = $records->whereHas('details', function($q){
            $q->where('vendor_id', auth()->user()->id);
        })->with(['details','user.products'])->paginate($paginate);
        return view($this->routePrefix.'orders.index', compact('records'));
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
        $record = new Orders();
        $record = $record->whereHas('details')-> with(['details' =>function($q)
        {
            $q->where('vendor_id',auth()->user()->id)->get();
        }
        
        , 'user.detail'])->find($id);
        
        // print_r($record->toArray());
        // exit;
        $detailmodel = new OrderDetail();
        $detailrecord = $detailmodel->where('order_id',$id)
        ->where('vendor_id',auth()->user()->id)->get();
        // print_r($detailrecord->toArray());
        // exit;
        return view($this->routePrefix.'orders.detail', compact('record','detailrecord'));
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
    public function status(Request $request, $id)
    {
        $model = new Orders();
        $modelDetail = new OrderDetail();
        try 
        {
            $data = $request->all();
            extract($data);
            $record = $model->find($id);
            $recordDetails = $modelDetail->where('order_id',$id)->where('vendor_id',auth()->user()->id)->get();
            
            
            switch ($selectionbox) {
                case "pending":
                    $record->status  =  $selectionbox;
                    $record->save();
                    foreach($recordDetails as $detail){

                        $detail->status = $record->status;
                        $detail->save();
                    }
                    // print_r($recordDetail->toArray());
                    // exit;

                return redirect()->back();
                break;
            case "accept":
                $record->status  =  $selectionbox;
                $record->save();
                foreach($recordDetails as $detail){

                    $detail->status = $record->status;
                    $detail->save();
                }
                // print_r($recordDetail->toArray());
                // exit;
                return redirect()->back();
                break;
            case "pickedup":
                $record->status  =  $selectionbox;
                $record->save();
                foreach($recordDetails as $detail){

                    $detail->status = $record->status;
                    $detail->save();
                }
                // print_r($recordDetail->toArray());
                // exit;
                return redirect()->back();
                break;
            case "delivering":
                $record->status  =  $selectionbox;
                $record->save();
                foreach($recordDetails as $detail){

                    $detail->status = $record->status;
                    $detail->save();
                }
                return redirect()->back();
                break;  
            case "delivered":
                $record->status  =  $selectionbox;
                $record->save();
                foreach($recordDetails as $detail){

                    $detail->status = $record->status;
                    $detail->save();
                }
                return redirect()->back();
                break;  
            case "cancelled":
                $record->status  =  $selectionbox;
                $record->save();
                foreach($recordDetails as $detail){

                        $detail->status = $record->status;
                        $detail->save();
                    }
                return redirect()->back();
                break;    
                
            case "vendor_cancelled":
                $record->status  =  $selectionbox;
                $record->save();
                foreach($recordDetails as $detail){
                        $detail->status = $record->status;
                        $detail->save();
                    }
                if($record->user->detail->language == 1){
                    $subject = 'Your Order is Cancelled - ('.$record->order_id.')';
                    $body ='Hello (Mr. / Ms.) '.$record->user->name.', <br> Your order ('.$record->order_id.') ) has been cancelled by the Vendor.
                    <br> Thank you - Sincerely, <br> The Last Mile Community';
                }else{
                    $subject = 'Ihre Bestellung ist storniert - ('.$record->order_id.')';
                    $body ='Hallo (Herr/Frau) '.$record->user->name.', <br> Ihre Bestellung ('.$record->order_id.') ) wurde vom Verkäufer storniert.
                    <br> Vielen Dank - Mit freundlichen Grüßen, <br> Die Last Mile Community';
                }
                $mail = new MailController($subject, $body, $record->user->email);
                $mail->basic_email();
                return redirect()->back();
                break;                
            default:
            break;
            }

        } catch (Exception $e) {
            return redirect()->back();
        }
      
        
    }
    public function riderRequest($id)
    {
        
        try
        {
                $model = new Orders();
                $record = $model->whereHas('details')->with([ 
                    'details'=>function($q)
                    {
                        $q->where('vendor_id',auth()->user()->id);
                    },
                    'user.locations','details.users.locations'])->find($id);
                    $rec = $record->details;        
                    
                    $data = $rec[0]->users->locations;               
                    $a =$data;
        
                    $factory = (new Factory)->withServiceAccount(__DIR__.'/firebaseKey.json');
                    $database = $factory->createDatabase();
                    $reference = $database->getReference('Request');
                    $key = $reference->push()->getkey();
                    
        
                    $posFrom = [
                        'latitude'=> $a[0]->latitude, 
                        'longitude'=> $a[0]->longitude];
                    $posTo = [
                        'latitude'=> $record->latitude,
                        'longitude'=>  $record->longitude];
                    $firestore = $factory->createFirestore();
                    $db = $firestore->database();
                    $theta = $record->longitude-$a[0]->longitude;
                    $distance = sin(deg2rad($record->latitude)) * sin(deg2rad($a[0]->latitude)) +  cos(deg2rad($record->latitude)) * cos(deg2rad($a[0]->latitude)) * cos(deg2rad($theta));
                    $distance = acos($distance);
                    $distance = rad2deg($distance);
                    $miles = $distance * 60 * 1.1515;
                    $milesstring = sprintf("%.2f",$miles);
                    $mileshort = (double)$milesstring;
                    $dur = ($miles/40)*60;
                    $durstring = sprintf("%.2f",$dur);
                    $durshort = (double)$durstring;
                    // $date = date('Y-m-d',strtotime($record->created_at));
                    $date = Carbon::now()->toDateString();
                    $time = Carbon::now()->toTimeString();
                    $ref = $db->collection('requests')->document($key);
                    $ref->set([
                        'acceptedByName'=>null,
                        'date'=>$date,
                        'distance'=>$mileshort,
                        'userID'=> $key,
                        'notes'=>"",
                        'placeFrom'=>$a[0]->address,
                        'placeTo'=>$record->address,
                        'positionFrom'=> $posFrom,
                        'positionTo'=>$posTo,
                        'servicePrice'=> "0",
                        'status'=>"pending",
                        'serviceName'=> "Delivery",
                        'serviceTypeID'=> "",
                        'time'=> $time,
                        'userFullName'=> $record->user->name,
                        'isAccepted'=> false,
                        'isJourneyCancelled'=> false,
                        'isJourneyEnded'=> false,
                        'isJourneyStarted'=> false,
                        'isPickedUp'=> false,
                        'vendor_id'=>$rec[0]->vendor_id,
                        'user_id'=>$record->user_id,
                        'userFullName'=>$record->user->name,
                        'order_id'=>$record->id,
                    ]);
          
                    if($record->user->detail->language == 1){
                        $subject = 'Your Order is Confirmed - ('.$record->order_id.')';
                        $body ='Hello (Mr. / Ms.) '.$record->user->name.', <br> Your order ('.$record->order_id.') has been accepted and is on the way.
                        <br> Track your Order here: '.config('app.url').'/home <br> Thank you - Sincerely, <br> The Last Mile Community';
                    }else{
                        $subject = 'Ihre Bestellung wurde bestätigt - ('.$record->order_id.')';
                        $body ='Hallo (Herr/Frau) '.$record->user->name.', <br> Ihre Bestellung ('.$record->order_id.') wurde angenommen und ist auf dem Weg zu Ihnen.
                        <br> Verfolgen Sie Ihre Bestellung hier: '.config('app.url').'/home <br> Vielen Dank - Mit freundlichen Grüßen, <br> Die Last Mile Community';
                    }
                    $mail = new MailController($subject, $body, $record->user->email);
                    $mail->basic_email();

                    return redirect()->back();
                } 
                catch (Exception $e)
                {
                    return redirect()->back();
                }            
    }
}
