<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Hash;
use App\{User, UserDetail};
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use DB;

class UserController extends Controller
{
    public function index(User $model)
    {
        $records = new UserDetail();
        $records = $records->paginate(config('app.pagination'));

        return view('users.index', compact('records'));
    }

    public function create()
    {
        $countries = config()->get('constants.countries');
        return view('users.create', compact('countries'));
    }

    public function store(ProfileRequest $request)
    {
        
        $data = $request->all();
        extract($data);

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->role = $role;
        $user->created_by = auth()->user()->id;
        $user->save();

        $userDetail = new UserDetail();
        $userDetail->user_id = $user->id;
        $userDetail->type = $role;
        $userDetail->display_name = $display_name;
        $userDetail->created_by = auth()->user()->id;
        $userDetail->email = $email;
        $userDetail->name = $name;
        $userDetail->fname = $first_name;
        $userDetail->lname = $last_name;
        $userDetail->phone = $phone;
        $userDetail->address = $address;
        $userDetail->city = $city;
        $userDetail->state = $state;
        $userDetail->country = $postal_code;
        $userDetail->image = $country;
        $userDetail->image = 'storage/'.$photo->store('uploads','public');
        $userDetail->save();

        return back()->withStatus(__('Record successfully created.'));
    }

    public function show($id) {
        $countries = config()->get('constants.countries');
        $users = DB::select('select * from users where id = ?',[$id]);
        $usersDet = DB::select('select * from user_details where user_id = ?',[$id]);
        return view('users.update',compact('users', 'countries','usersDet'));
     }

    public function edit($id)
    {
        $countries = config()->get('constants.countries');


        return view('users.update', compact('countries'));
    }

    public function update(Request $request,$id)
    {
        $img = $request->photo;
        $name = $request->input('name');
        $display_name = $request->input('display_name');
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');
        $email = $request->input('email');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $city = $request->input('city');
        $state = $request->input('state');
        $postal_code = $request->input('postal_code');
        $country = $request->input('country');
        $photo = 'storage/'.$img->store('uploads','public');

        // DB::update('update users set name = ?, email = ?, password = ?, where id = "$id"',[$name,$email,$password,$id]);

        DB::table('users')
        ->where('id', $id)
        ->update([
            'name'  => $name ,
            'email' => $email ,
            'password'  => $password ,

        ]);
        DB::table('user_details')
        ->where('user_id', $id)
        ->update([
            'email' => $email ,
            'name'  => $name ,
            'display_name'  => $display_name ,
            'fname'  => $first_name ,
            'lname'  => $last_name ,
            'phone'  => $phone ,
            'address'  => $address ,
            'city'  => $city ,
            'state'  => $state ,
            'country'  => $postal_code ,
            'image'  => $photo ,

        ]);
        // DB::update('update user_details set email = ? , name = ? , display_name = ? , fname = ? , lname = ? , phone = ? , address = ? , city = ? , state = ? , country = ? , image = ? ,  where id = ?',[$email,$name,$display_name,$first_name,$last_name,$phone,$address,$city,$state,$countries,$photo,$id]);
      return redirect()->route('user.index')->withStatus('Record successfully updated');
    }

    public function destroy($id)
    {
        $record = new User();
        $record = $record->findOrFail($id);
        $record->delete();

        return redirect()->back()->withStatus(__('Record successfully deleted.'));
    }

    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
    public function profile(){
        $record = new User();
        $record = $record->where('id', auth()->user()->id)->first();

        return view('profile.index', compact('record'));
    }
    public function showProfile($id){
        $record = new User();
        $record = $record->where('id', $id)->with('detail')->first();
        return view('profile.update', compact('record'));


    }
    public function updateProfile(Request $update, $id){
        $data = $update->all();
        extract($data);
        DB::table('users')
        ->where('id', $id)
        ->update([
            
            'password'  => Hash::make($password),
            'opening_time'=>$opening_time,
            

        ]);
        $record = User::find($id);
       
        $record->password =  (isset($password) && $password) ? Hash::make($password) : $record->password;
        $modeldetails = new UserDetail();
        $recorddetails = $modeldetails->where('user_id',$id)->first();
     

        return back()->withStatus('updated');




    }

}
