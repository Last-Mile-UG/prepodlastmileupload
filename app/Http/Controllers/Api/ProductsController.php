<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Products;
class ProductsController extends Controller
{
    public $successStatus = 200;

    public function list()
    {
        $records = new Products();
        $success['records'] = $records->with(['user.detail','user.locations','user.reviews' , 'reviews', 'variants.reviews'])->get();
        return response()->json(['success' => $success], $this->successStatus);
    }
    
    public function fetchByVendorId($id){
        $records = new Products();
        $records = $records->with(['category','reviews', 'variants.reviews'])->where('vendor_id', $id)->get();
        if($records->count() > 0 ){
            $success['records'] = $records;
            return response()->json(['success' => $success], $this->successStatus);
        }else{
            $error['message'] = 'Data not found';
            return response()->json(['error' => $error], 404);
        }
    }
}
