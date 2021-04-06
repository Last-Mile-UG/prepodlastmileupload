<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\BannerImage;
use Exception;

class BannerController extends Controller
{
    public $successStatus = 200;

    public function index()
    {
        try{
            $records = new BannerImage();
            $records = $records->get();
            if($records && $records->count() > 0 ){
                $success['records'] = $records;
                return response()->json(['success' => $success], $this->successStatus);
            }
            else{
                $error['message'] = 'Data not found';
                return response()->json(['error' => $error], 404);
            }
        }catch(Exception $e){
            $error['message'] = 'Something went wrong';
            return response()->json(['error' => $error], 500);
        }
    }
}