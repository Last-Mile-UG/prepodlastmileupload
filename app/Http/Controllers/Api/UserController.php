<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{UserLocation,User,UserDetail};
use Illuminate\Support\Facades\Validator;
use Exception;

class UserController extends Controller
{
    public $successStatus = 200;

    public function getLocations($userId){
        $userLocation = new UserLocation();
        $records = $userLocation->where('user_id', $userId)->get();

        if($records->count() > 0 ){
            $success['records'] = $records;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            $error['message'] = 'Data not found';
            return response()->json(['error' => $error], 404);
        }
    }

    public function store(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',            
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try{
            $data = $request->all();
            extract($data);
            $userLocation = new UserLocation();
            $userLocation->user_id = $id;
            $userLocation->title = $title;
            $userLocation->latitude = $latitude;
            $userLocation->longitude = $longitude;
            $userLocation->address = $address;
            $userLocation->save();
    
            $location = new UserLocation();
            $records = $location->where('user_id', $id)->get();

            $success['records'] = $records;
            return response()->json(['success' => $success], $this->successStatus);

        }catch(Exception $e){
            $error['message'] = 'Something went wrong';
            return response()->json(['error' => $error], 500);
        }        
    }


    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',            
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try{
            $data = $request->all();
            extract($data);
            $Location = new UserLocation();
            $record = $Location->find($id);
            $record->title = $title;
            $record->latitude = $latitude;
            $record->longitude = $longitude;
            $record->address = $address;
            $record->save();
    
            $userLocation = new UserLocation();
            $records = $userLocation->where('user_id', $record->user_id)->get();

            $success['records'] = $records;
            return response()->json(['success' => $success], $this->successStatus);

        }catch(Exception $e){
            $error['message'] = 'Something went wrong';
            return response()->json(['error' => $error], 500);
        }        
    }
    public function userProfileUpdate(Request $request,$id)
    {
      
        $validator = Validator::make($request->all(), [
            'name' => 'nullable',
            'phone' => 'nullable',
            'birthday' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try 
       {
            $data = $request->all();
            extract($data);
            $model = new User();
            $record = $model->find($id);
            $record->name = $name ?? $record->name;
            $record->save();
           
            $modelDetail = new UserDetail();
            $recordDetail = $modelDetail->where('user_id',$id)->first();
            if($recordDetail)
            {
                $recordDetail->phone = $phone ?? $recordDetail->phone;
                $recordDetail->birthday = $birthday ?? $recordDetail->birthday;
                $recordDetail->save();

            }
            else
            {
                $recordDetail = 'No Details';
            }
            
            $success['records'] = $record;
            $success['Details'] = $recordDetail;
            return response()->json(['success' => $success], $this->successStatus);

        }
       catch (Exception $e)
       {
            // print_r($e->getMessage());
            // exit;
            $error['message'] = 'Something went wrong';
            return response()->json(['error' => $error], 500);
       }
    }
   
}
