<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\{User, UserDetail, DeliveryOption, Orders};
use DB;
use Exception;

// use Edujugon\PushNotification\PushNotification;

class CustomerController extends Controller
{
    protected $routePrefix = 'admin.';

    public function index()
    {
        // $push = new PushNotification('apn');
        // $push->setUrl('http://newPushServiceUrl.com');

        $records = new User();
        $paginate = config()->get('app.pagination');
        $records = $records->whereHas('detail')->with('detail')->where('role', 'customer')->paginate($paginate);
        return view($this->routePrefix.'customers.index', compact('records'));
    }

    public function create()
    {
        return view($this->routePrefix.'customers.create');
    }


    public function store(Request $request)
    {
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

            $userDetail = new UserDetail();
            $userDetail->user_id = $user->id;
            $userDetail->user_name = $name;
            $userDetail->fname = $fname;
            $userDetail->lname = $lname;
            $userDetail->birthday = $birthday;
            $userDetail->phone = $phone;
            $userDetail->email = $email;
            $userDetail->address = $address;

            if(request()->hasFile('photo')){
                $image = request()->file('photo')->getClientOriginalName();
                $imageNewName = $image;
                $file = request()->file('photo');
                $file->storeAs('images/profile',$imageNewName, ['disk' => 'public']);
                $userDetail->image = $imageNewName;
            }
            $userDetail->save();

            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            \Log::error($e->getMessage());
        }
        return back()->withStatus(__('Record successfully created.'));
    }

    public function show($id)
    {
        $records = new Orders();
        $paginate = config()->get('app.pagination');
        $records = $records->whereHas('details')->where('user_id', $id)->paginate($paginate);

        return view($this->routePrefix.'customers.detail', compact('records'));
    }


    public function edit($id)
    {
        $record = new User();
        $record = $record->with(['detail', 'locations', 'deliveryOptions'])->find($id);
        $deliveryOptions = new DeliveryOption();
        $deliveryOptions = $deliveryOptions->where('status', 1)->get();

        return view($this->routePrefix.'customers.update', compact('record', 'deliveryOptions'));
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

            $userDetail = new UserDetail();
            $userDetail = $userDetail->where('user_id', $id)->first();
            $userDetail->user_id = $id;
            $userDetail->user_name = $name;
            $userDetail->phone = $phone;
            $userDetail->email = $email;
            $userDetail->address = $address;

            if(request()->hasFile('photo')){
                $image = request()->file('photo')->getClientOriginalName();
                $imageNewName = $image;
                $file = request()->file('photo');
                $file->storeAs('images/profile',$imageNewName, ['disk' => 'public']);
                $userDetail->image = $imageNewName;
            }
            $userDetail->save();

            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
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
}
