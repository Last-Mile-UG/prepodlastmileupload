<?php namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{Products, Service, User, ProductSubscriptionRequest, ProductVariant};
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $routePrefix = 'vendor.';

    public function index()
    {
        $records = new Products();
        $records = $records->where('vendor_id', auth()->user()->id)->paginate(config('app.pagination'));
        return view($this->routePrefix.'products.index', compact('records'));
    }

    public function create()
    {
        $services =  new Service();
        $services = $services->where('status', 1)->where('vendor_id', auth()->user()->id)->get();
        return view($this->routePrefix.'products.create', compact('services'));
    }

    public function store(Request $request)
    {
        // print_r($request->toArray());exit;
        $data = $request->all();
        extract($data);

        try{
            $product = new Products();
            $product->name = $prod_name;
            $product->service = $service;
            $product->vendor_id = auth()->user()->id;
            $product->description = $prod_desc;
            $product->price = $price;
            $product->start_time = $start_time ?? null;
            $product->end_time = $end_time ?? null ;
            $product->delivery_times = $delivery_time ?? null;
            $product->deals = 'no deals';
            $product->subscription = $subscription;
            $product->status = $status;
            $product->featured = $feature;
    
            if(request()->hasFile('photo')){
                $image = request()->file('photo')->getClientOriginalName();
                $imageNewName = $image;
                $file = request()->file('photo');
                $file->storeAs('images/product',$imageNewName, ['disk' => 'public']);
                $product->image = $imageNewName;
            }
            $product->save();

            $productVarient = new ProductVariant();
            $productVarient->product_id = $product->id;
            $productVarient->vendor_id = auth()->user()->id;
            $productVarient->description = $prod_desc;
            $productVarient->price = $price;
    
            if(request()->hasFile('photo')){
                $image = request()->file('photo')->getClientOriginalName();
                $imageNewName = $image;
                $file = request()->file('photo');
                $file->storeAs('images/product',$imageNewName, ['disk' => 'public']);
                $productVarient->image = $imageNewName;
            }            
            $productVarient->save();

        }catch(Exception $e){

            return redirect()->back()->with($e->getMessage());
        }

        return back()->withStatus(__('Product successfully created.'));
    }

    public function show($id)
    {
       
    }

    public function edit($id)
    {
        $services =  new Service();
        $services = $services->where('vendor_id', auth()->user()->id)->get();
        $record = new Products();
        $record = $record->find($id);
        return view($this->routePrefix.'products.update', compact('record', 'services'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        extract($data);

        // print_r($data);exit;
        try{
            $product = new Products();
            $product = $product->find($id);
            $product->name = $prod_name;
            $product->service = $service;
            $product->vendor_id = auth()->user()->id;
            $product->description = $prod_desc;
            $product->price = $price;
            $product->start_time = $start_time ?? null;
            $product->end_time = $end_time ?? null ;
            $product->delivery_times = $delivery_time ?? null;
            $product->subscription = $subscription;

            if(request()->hasFile('photo')){
                $image = request()->file('photo')->getClientOriginalName();
                $imageNewName = $image;
                $file = request()->file('photo');
                $file->storeAs('images/product',$imageNewName, ['disk' => 'public']);
                $product->image = $imageNewName;
            }
            $product->save();
            
            $productVarient = new ProductVariant();
            $productVarient = $productVarient->where('product_id', $id)->first();
            $productVarient->product_id = $product->id;
            $productVarient->vendor_id = auth()->user()->id;
            $productVarient->description = $prod_desc;
            $productVarient->price = $price;
    
            if(request()->hasFile('photo')){
                $image = request()->file('photo')->getClientOriginalName();
                $imageNewName = $image;
                $file = request()->file('photo');
                $file->storeAs('images/product',$imageNewName, ['disk' => 'public']);
                $productVarient->image = $imageNewName;
            }            
            $productVarient->save();
            
        }catch(Exception $e){

        }

        return back()->withStatus(__('Record successfully updated.'));
    }

    public function destroy($id)
    {
        $record = new Products();
        $record = $record->findOrFail($id);
        $record->delete();

        return redirect()->back()->withStatus(__('Product successfully deleted.'));
    }

    public function subscriptionRequest(){
        $records = new ProductSubscriptionRequest();
        $records = $records->with(['user','product.user'])->where('vendor_id', auth()->user()->id)->paginate(config('app.pagination'));
        return view($this->routePrefix.'products.request', compact('records'));
    }

    public function subscriptionStatus(Request $request){
        $record = new ProductSubscriptionRequest();
        $record = $record->find($request->id);
        $record->status = $request->status;
        $record->save();
        return response()->json($record);
    }

    public function productBulkUpload(){
        $services =  new Service();
        $services = $services->where('status', 1)->where('vendor_id', auth()->user()->id)->get();
        return view($this->routePrefix.'products.bulkupload', compact('services'));
    }

    public function saveBulkUpload(Request $request){
       
        $data = $request->all();
        extract($data);        
        // print_r($subscription);exit;
        try{
            if(isset($data['csv_file'])){
                DB::beginTransaction();
                Storage::disk('product-csvs')->putFileAs('', $request->file('csv_file'), 'product'.auth()->user()->id.'.csv'); //saving file
                $filename = Storage::disk('product-csvs')->path('product'.auth()->user()->id.'.csv');               
                $file = fopen($filename, "r");

                while ( ($fileData = fgetcsv($file, 200, ",")) !==FALSE ) {
                    $obj = [];
                    foreach($fileData as $nestedData){
                        $obj['service'] =  $service;
                        $obj['vendor_id'] = auth()->user()->id;
                        $obj['name'] = $fileData[0];
                        $obj['description'] = $fileData[1];
                        $obj['image'] = auth()->user()->id.'-'.$fileData[2];
                        $obj['price'] = $fileData[3];
                        if($subscription == 1){
                            $obj['start_time'] = $fileData[4];
                            $obj['end_time'] = $fileData[5];                        
                            $obj['delivery_times'] = $fileData[6];
                            $obj['deals'] = $fileData[7];
                        }
                        else{
                            $obj['delivery_times'] = $fileData[4];
                            $obj['deals'] = $fileData[5];
                        }                        
                    }
                        $product = new Products();
                        $product->name = $obj['name'];
                        $product->service = $service;
                        $product->vendor_id = auth()->user()->id;
                        $product->description = $obj['description'];
                        $product->image = $obj['image'];
                        $product->price = $obj['price'];
                        $product->start_time = isset($obj['start_time']) && $obj['start_time'] ? $obj['start_time'] : null;
                        $product->end_time = isset($obj['end_time']) && $obj['end_time'] ? $obj['end_time'] : null;
                        $product->delivery_times = $obj['delivery_times'];
                        $product->deals = $obj['deals'];
                        $product->subscription = $subscription;
                        $product->save();
                        
                        $productVarient = new ProductVariant();
                        $productVarient->product_id = $product->id;
                        $productVarient->vendor_id = auth()->user()->id;
                        $productVarient->description = $obj['description'];
                        $productVarient->image = $obj['image'];
                        $productVarient->price = $obj['price'];
                        $productVarient->save();

                        if($subscription != 1){
                            if(isset($fileData[6]) && $fileData[6]){                                
                                $productVarient = new ProductVariant();
                                $productVarient->product_id = $product->id;
                                $productVarient->vendor_id = auth()->user()->id;
                                $productVarient->description = $fileData[6];
                                $productVarient->image = auth()->user()->id.'-'.$fileData[7];
                                $productVarient->price = $fileData[8];
                                $productVarient->save();
                            }

                            if(isset($fileData[9]) && $fileData[9]){                                
                                $productVarient = new ProductVariant();
                                $productVarient->product_id = $product->id;
                                $productVarient->vendor_id = auth()->user()->id;
                                $productVarient->description = $fileData[9];
                                $productVarient->image = auth()->user()->id.'-'.$fileData[10];
                                $productVarient->price = $fileData[11];
                                $productVarient->save();
                            }

                            if(isset($fileData[12]) && $fileData[12]){                                
                                $productVarient = new ProductVariant();
                                $productVarient->product_id = $product->id;
                                $productVarient->vendor_id = auth()->user()->id;
                                $productVarient->description = $fileData[12];
                                $productVarient->image = auth()->user()->id.'-'.$fileData[13];
                                $productVarient->price = $fileData[14];
                                $productVarient->save();
                            }

                            if(isset($fileData[15]) && $fileData[15]){                                
                                $productVarient = new ProductVariant();
                                $productVarient->product_id = $product->id;
                                $productVarient->vendor_id = auth()->user()->id;
                                $productVarient->description = $fileData[15];
                                $productVarient->image = auth()->user()->id.'-'.$fileData[16];
                                $productVarient->price = $fileData[17];
                                $productVarient->save();
                            }                                                        
                        }
                }               

                DB::commit();
                Storage::disk('product-csvs')->delete('product'.auth()->user()->id.'.csv');

            }
            return back()->withStatus(__('Product successfully created.'));
        }catch(Exception $e){
            // print_r($e->getMessage());exit;
            DB::rollback();
            return back()->withStatus(__('Something went wrong.'));
        }       
    }

    public function variantBulkUpload(){

    }

    public function saveVariantBulkUpload(){

    }

    public function fetchProducts(Request $request)
    {
        if($request->get('query'))
        {
         $query = $request->get('query');
         $products = new Products();
         $data = $products->where('name', 'LIKE', "%{$query}%")
        ->get();
       
           return response()->json($data);         
        }
    }
    public function status($id)
    {
        $model = new Products();
        $record = $model->where('vendor_id',auth()->user()->id)->find($id);
        $record->status = !$record->status;
        if($record->save())
        {
            return redirect()->back()->withStatus(__('Status Change Successfully.'));
        }
        else
        {
            return redirect()->route('productstatus');
        }

    }
    public function feature($id)
    {
        $model = new Products();
        $record = $model->where('vendor_id',auth()->user()->id)->find($id);
        $record->featured = !$record->featured;
        if($record->save())
        {
            return redirect()->back()->withStatus(__('Featured Change Successfully.'));
        }
        else
        {
            return redirect()->route('productstatus');
        }

    }
}
