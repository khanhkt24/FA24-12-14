<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function showHistories()
    {
        $paymentHistories = DB::table('payment_histories')->get();
        return view('client.payment_histories', compact('paymentHistories'));
    }
    
}

