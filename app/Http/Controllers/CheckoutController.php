<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderProduct;
use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
class CheckoutController extends Controller
{
    function getCity(Request $request){
        $cities = City:: where('country_id',$request->country_id)->get();
        $str = '<option value="">-- Select City --</option>';
        foreach($cities as $city){
            $str .= '<option value="'.$city->id.'">'.$city->name.'</option>';
        }
        echo $str;
    }
    function store_checkout(Request $request){
        $request->validate([
            'company'=>'required',
            'mobile'=>'required',
            'address'=>'required',
            'country_id'=>'required',
            'city_id'=>'required',
            'zip'=>'required',
            'additional'=>'required',
            ]);

            $order_id = uniqid();
            Order::insert([
                'order_id'=>$order_id,
                'customer_id'=>Auth::guard('customer')->id(),
                'total'=> $request->sub_total + $request->charge - $request->discount,
                'discount'=>$request->discount,
                'payment_method'=>$request->payment_method,
                'charge'=>$request->charge,
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->mobile,
                'address'=>$request->address,
                'country_id'=>$request->country_id,
                'city_id'=>$request->city_id,
                'zip'=>$request->zip,
                'company'=>$request->company,
                'additional'=>$request->additional,
                'created_at'=>Carbon::now(),
            ]);

             $carts= Cart:: where('customer_id',Auth::guard('customer')->id())->get();
                foreach($carts as $cart){
                  OrderProduct::insert([
                    'order_id'=>$order_id,
                    'customer_id'=>Auth::guard('customer')->id(),
                    'product_id'=>$cart->product_id,
                    'color_id'=>$cart->color_id,
                    'size_id'=>$cart->size_id,
                    'price'=>Inventory::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first()->discount_price,
                    'quantity'=>$cart->quantity,
                    'created_at'=>Carbon::now(),

                  ]);
                  Inventory::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->decrement('quantity',$cart->quantity);
                }
            Cart:: where('customer_id',Auth::guard('customer')->id())->delete();

            Mail::to($request->email)->send(new InvoiceMail($order_id));


            return redirect()->route('order.success',$order_id);
    }
    function order_success($id){
        return view('frontend.order_success',[
            'order_id'=>$id,
        ]);
    }
}
