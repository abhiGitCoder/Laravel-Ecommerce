<?php

namespace App\Http\Controllers;
use Razorpay\Api\Api;
use Illuminate\Http\Request;

class RazorpayController extends Controller
{
    public $api;
    public function __construct(){
        $this->api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    }
    public function makeOrder(Request $req){
        $amount = $req->input('amount');
        $orderid=rand(111111,999999);
        $orderData = [
            'receipt'         => 'rcptid_11',
            'amount'          => $amount*100, 
            'currency'        => 'INR'
        ];
        
        $razorpayOrder = $this->api->order->create($orderData);
        
        return response()->json([
            'status' => 'success',
            'orderId' => $orderid, 
        ]);
        
    }
}