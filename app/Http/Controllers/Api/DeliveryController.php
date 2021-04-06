<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DeliveryOption;

class DeliveryController extends Controller
{
    public function deliveryOption()
    {
        $model = new DeliveryOption();
        $record = $model->get();
        return response()->json(['success'=>$record]);

    }
}
