<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\{User,UserDetail, UserLocation, DeliveryOption, Orders, VendorCategory};
use Exception;
use DB;

class VendorController extends Controller
{
    protected $routePrefix = 'admin.';

    public function index()
    {
        $records = new User();
        $paginate = config()->get('app.pagination');
        $records = $records->whereHas('detail')->with('detail')->whereIn('role', ['vendor', 'premium_vendor'])->paginate($paginate);
        return view($this->routePrefix.'vendors.index', compact('records'));
    }

    public function create()
    {
        $deliveryOptions = new DeliveryOption();
        $deliveryOptions = $deliveryOptions->where('status', 1)->get();
        $vendorCategory =  new VendorCategory();
        $vendorCategory = $vendorCategory->get();
        return view($this->routePrefix.'vendors.create', compact('deliveryOptions','vendorCategory'));
    }

    public function store(Request $request)
    {
        // print_r($request->all());exit;
        $data = $request->all();
        extract($data);
        
        try{
            DB::beginTransaction();
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->role = $role;
            $user->created_by = auth()->user()->id;
            $user->save();
            $user->vendorCategories()->attach($categories);
            if(isset($deliveryOption))
            $user->deliveryOptions()->attach($deliveryOption);
            
            $userDetail = new UserDetail();
            $userDetail->user_id = $user->id;
            $userDetail->user_name = $name;
            $userDetail->fname = $fname;
            $userDetail->lname = $lname;
            $userDetail->birthday = $birthday;
            $userDetail->phone = $phone;
            $userDetail->email = $email;
            $userDetail->address = $address;
            $userDetail->opening_time = $openingtime;
            $userDetail->closing_time = $closingtime;
            
            if(request()->hasFile('photo')){
                $image = request()->file('photo')->getClientOriginalName();
                $imageNewName = $image;
                $file = request()->file('photo');
                $file->storeAs('images/profile',$imageNewName, ['disk' => 'public']);
                $userDetail->image = $imageNewName;
            }
            $userDetail->save();
            
            
            $location= new UserLocation();
            $location->latitude = $latitude;
            $location->user_id = $user->id;
            $location->longitude = $longitude;
            $location->address = $address;
            $location->save();

            DB::commit();
            return back()->withStatus(__('Record successfully created.'));
        }
        catch(Exception $e){
            DB::rollback();
            \Log::error($e->getMessage());
            return back()->with($e->getMessage());


        }
    }

    public function show($id)
    {
        $records = new Orders();
        $paginate = config()->get('app.pagination');
        $records = $records->whereHas('details')->with(['details' => function($q){
            $q->where('vendor_id', auth()->user()->id);
        }, 'user.products'])->paginate($paginate);
        return view($this->routePrefix.'vendors.detail', compact('records'));
    }

    public function edit($id)
    {
        $record = new User();
        $record = $record->with(['detail', 'locations', 'deliveryOptions'])->find($id);
        $deliveryOptions = new DeliveryOption();
        $deliveryOptions = $deliveryOptions->where('status', 1)->get();
        $vendorCategory =  new VendorCategory();
        $vendorCategory = $vendorCategory->with('vendors')->get();
        // print_r($vendorCategory->toArray());exit;

        return view($this->routePrefix.'vendors.update', compact('record', 'deliveryOptions','vendorCategory'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        extract($data);

        try{
            DB::beginTransaction();
            $user = new User();
            $user = $user->find($id);
            $user->name = $name;
            $user->email = $email;
            $user->password = $password ? Hash::make($password) : $user->password;
            $user->role = $role;
            $user->created_by = auth()->user()->id;
            $user->save();
            $user->vendorCategories()->detach();
            $user->deliveryOptions()->detach();
            if(isset($deliveryOption)){
                $user->deliveryOptions()->attach($deliveryOption);
            }
            if(isset($categories) && count($categories) > 0){
                $user->vendorCategories()->attach($categories);
            }

            $userDetail = new UserDetail();
            $userDetail = $userDetail->where('user_id', $id)->first();
            $userDetail->user_id = $id;
            $userDetail->user_name = $name;
            $userDetail->fname = $fname;
            $userDetail->lname = $lname;
            $userDetail->phone = $phone;
            $userDetail->email = $email;
            $userDetail->address = $address;
            $userDetail->opening_time = $opening_time;
            $userDetail->closing_time = $closing_time;

            if(request()->hasFile('photo')){

                $image = request()->file('photo')->getClientOriginalName();
                $imageNewName = $image;
                $file = request()->file('photo');
                $file->storeAs('images/profile',$imageNewName, ['disk' => 'public']);
                $userDetail->image = $imageNewName;
            }

            $userDetail->save();

            $location = new UserLocation();
            $location = $location->where('user_id', $id)->first();
            $location->latitude = $latitude;
            $location->user_id = $id;
            $location->longitude = $longitude;
            $location->address = $address;
            $location->save();

            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            // print_r($e->getMessage());exit;
            \Log::error($e->getMessage());
        }
        return back()->withStatus(__('Record successfully updated.'));
    }

    public function destroy($id)
    {
        $record = new User();
        $record = $record->find($id);
        $record->delete();
        return redirect()->back()->withStatus(__('Record successfully Deleted.'));
    }

    public function markFeatured($id)
    {
        $record = new UserDetail();
        $record = $record->where('user_id', $id)->first();
        $record->featured = !$record->featured;
        $record->save();
        return redirect()->back()->withStatus(__('Record successfully Updated.'));
    }
}
