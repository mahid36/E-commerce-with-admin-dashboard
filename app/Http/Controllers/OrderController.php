<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    function orders(){
        $orders = Order::all();
        return view('backend.order.orders', [
            'orders'=>$orders
        ]);
    }
}
