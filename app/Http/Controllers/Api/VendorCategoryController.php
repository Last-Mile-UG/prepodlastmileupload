<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VendorCategory;
use Exception;

class VendorCategoryController extends Controller
{
    public function categories()
    {
        try{
            $model =  new VendorCategory();
            $record = $model->get();
            if($record->count() > 0)
                return response()->json(['records'=>$record]);
            else
                return response()->json(['error'=>'No records found']);
        }catch(Exception $e){
            return response()->json(['error'=>'Something Went Wrong'], 401);
        }
    }

    public function vendorBycategory($categoryId)
    {
        try{
            $model =  new VendorCategory();
            $record = $model->with(['vendors.reviews', 'vendors.detail:user_id,image', 'vendors.locations'])->find($categoryId);    
            if($record && $record->count() > 0)        
                return response()->json(['records'=>$record]);        
            else        
                return response()->json(['error'=>'No records found']);        
        }catch(Exception $e){
            return response()->json(['error'=>'Something Went Wrong'], 401);
        }
    }
}
