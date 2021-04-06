<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public $successStatus = 200;

    public function getAllVendors(Request $request){        
        extract($request->all());
        $vendorObj = new User();
        $records = $vendorObj->with(['locations', 'detail', 'reviews'])->whereIn('role', ['vendor', 'premium_vendor']);
        if(isset($featured) && $featured){
            $records = $records->whereHas('detail', function($q){
                $q->where('featured', 1);
            });
        }
        $records = $records->get();
        if($records->count() > 0 ){
            $success['records'] = $records;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            $error['message'] = 'Data not found';
            return response()->json(['error' => $error], 404);
        }
    }

    public function getVendorService($id){
        $vendorObj = new User();
        $records = $vendorObj->whereHas('products')->with(['service.products.variants','products.reviews'])->find($id);
        if($records->count() > 0 ){
            $success['records'] = $records;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            $error['message'] = 'Data not found';
            return response()->json(['error' => $error], 404);
        }
    }    
}
