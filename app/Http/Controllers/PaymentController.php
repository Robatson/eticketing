<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddEvent;

class PaymentController extends Controller
{
    //
   
    public function paymentView($slug)
{
    
    $event =AddEvent::where('slug',$slug)->first();

    return view('payment.payment', compact('event'));
}
}
