<?php

namespace App\Http\Controllers;

use Gate;
use App\{User, UserDetail};
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    // public function create()
    // {
    //     $countries = config()->get('constants.countries');
    //     return view('profile.create', compact('countries'));
    // }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function store(ProfileRequest $request)
    // {

    //     $data = $request->all();
    //     extract($data);
        

    //     $user = new User();

    //     $user->name = $name;
    //     $user->email = $email;
    //     $user->password = Hash::make($password);
    //     $user->role = $role;
    //     $user->save();


    //     $userDetail = new UserDetail();

    //     $userDetail->user_id = $user->id;
    //     $userDetail->type = $role;
    //     $userDetail->display_name = $display_name;
    //     $userDetail->fname = $first_name;
    //     $userDetail->lname = $last_name;
    //     $userDetail->phone = $phone;
    //     $userDetail->address = $address;
    //     $userDetail->city = $city;
    //     $userDetail->state = $state;
    //     $userDetail->country = $postal_code;
    //     $userDetail->image = $country;
    //     $userDetail->image = 'storage/'.$photo->store('uploads','public');
    //    $userDetail->save();
        
        

    //     return back()->withStatus(__('User successfully created.'));
    // }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function password(PasswordRequest $request)
    // {
    //     auth()->user()->update(['password' => Hash::make($request->get('password'))]);

    //     return back()->withPasswordStatus(__('Password successfully updated.'));
    // }

   
}
