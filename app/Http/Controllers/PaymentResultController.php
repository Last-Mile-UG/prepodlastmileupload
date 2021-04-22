<?php

namespace App\Http\Controllers;

class PaymentResultController extends Controller
{
    function successAction()
    {
        return view('payment.success');
    }

    function cancelAction()
    {
        return view('payment.cancel');
    }
}
