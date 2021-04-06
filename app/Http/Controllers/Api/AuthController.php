<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\{User, UserDetail};
use Exception;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public $successStatus = 200;

        public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'fname' => 'required|string',
            'lname' => 'required|string',
            // 'phone' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'birthday' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $message = 'User successfully Created';
        try{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = 'customer';
            $user->password = bcrypt($request->password);
            $user->save();

            $userDetail = new UserDetail();
            $userDetail->user_id = $user->id;
            $userDetail->user_name = $request->name;
            $userDetail->fname = $request->fname;
            $userDetail->lname = $request->lname;
            $userDetail->birthday = $request->birthday;
            // $userDetail->phone = $request->phone;
            $userDetail->email = $request->email;
            $userDetail->save();
            return response()->json(['success' => $message], $this->successStatus);
        }catch(Exception $e){
            return response()->json(['error' => 'unable to register'], 401);
        }
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $authUser = Auth::User();
            if(Auth::user()->role == 'customer'){
                $success['token'] = $authUser->createToken('LastMile')->accessToken;
                $user = new User();
                $success['user'] = $user->with(['detail', 'locations'])->find($authUser->id);
                return response()->json(['success' => $success], $this->successStatus);
            }
            else {
                return response()->json(['error' => 'unauthorised'], 401);
            }
        } else {
            return response()->json(['error' => 'unauthorised'], 401);
        }
    }

    public function logout(Request $request)
    {
        $success['message'] = 'Successfully logged out';
        $request->user()->token()->revoke();
        return response()->json([
            'success' => $success
        ]);
    }

    public function user(Request $request)
    {
        if($request->user()){
            $userDetail = new UserDetail();
            $userDetail = $userDetail->where('user_id', $user->id)->get();
            $success['userDetail'] = $userDetail;
        }
        $success['user'] = $request->user();
        return response()->json(['success' => $success]);
    }
}
