<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{User,UserCard};
use Exception;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    public function cardlist($id)
    {
        try {
            $model = new UserCard();
            $record = $model->where('user_id',$id)->get();
            if($record->count() > 0)
            {
                return response()->json(['success'=>$record]);
            }
            else
            {
                return response()->json(['error'=>'SomeThing Went Wrong']);
            }
        } catch (Exception $e) {
            return response()->json(['error'=>$e]);
        }
    }

    public function cardStore(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'card_name' => 'required',
            'number' => 'required',
            'exp_month' => 'required',
            'exp_year' => 'required',
            'cvc'=>'required'            
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try 
        {
            $data = $request->all();
            extract($data);
            $record = new UserCard();
            $record->user_id = $id;
            $record->card_name = $card_name;
            $record->number = $number;
            $record->exp_month = $exp_month;
            $record->exp_year = $exp_year;
            $record->cvc = $cvc;
            $record->save();
            
            return response()->json(['success'=>$record]);
        }
        catch (Exception $e)
        {
            return response()->json(['error' => 'Something Went Wrong']);
        }
    }
    public function cardUpdate(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'card_name' => 'required',
            'number' => 'required',
            'exp_month' => 'required',
            'exp_year' => 'required',
            'cvc'=>'required'            
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        try 
        {
            $data = $request->all();
            extract($data);
            $model = new UserCard();
            $usercard = $model->find($id);
            // print_r($usercard->toArray());
            // exit;
            $usercard->card_name = $card_name;
            $usercard->number = $number;
            $usercard->exp_month = $exp_month;
            $usercard->exp_year = $exp_year;
            $usercard->cvc = $cvc;
            $usercard->save();


            $modelcard =  new UserCard();
            $record  = $modelcard->where('user_id',$usercard->user_id)->get();
            return response()->json(['success'=>$record]);
        }
        catch (Exception $e)
        {
            return response()->json(['error' => 'Something Went Wrong']);
        }
    }
    public function cardDelete($id)
    {
       try 
        {
            
        $model = new UserCard();
        $usercard = $model->find($id);
        $usercard->delete();
        return response()->json(['success'=>'Record Delete SuccessFully']);
        }
        catch (Exception $e)
        {
            return response()->json(['error' => 'Something Went Wrong']);
        }
    }
}
