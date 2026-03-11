<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderProduct;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\InvoiceMail;
use App\Models\StripeOrder;

class StripePaymentController extends Controller
{
    public function stripe($order_id): View
    {
        $total = StripeOrder :: where('order_id',$order_id)->first()->total;
        return view('stripe',[
            'order_id' => $order_id,
            'total' => $total
        ]);
    }

    public function stripePost(Request $request, $order_id): RedirectResponse
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

         $stripe_order = StripeOrder::where('order_id', $order_id)->firstOrFail();
        $total = $stripe_order->total;

        $charge = Stripe\Charge::create([
            "amount" => $total * 100,
            "currency" => "bdt",
            "source" => $request->stripeToken,
            "description" => "Order Payment"
        ]);
             Order::insert([
                'order_id'=>$order_id,
                'customer_id'=>Auth::guard('customer')->id(),
                'total'=>  $stripe_order->total,
                'discount'=> $stripe_order->discount,
                'payment_method'=> $stripe_order->payment_method,
                'charge'=> $stripe_order->charge,
                'name'=> $stripe_order->name,
                'email'=> $stripe_order->email,
                'phone'=> $stripe_order->phone,
                'address'=> $stripe_order->address,
                'country_id'=> $stripe_order->country_id,
                'city_id'=> $stripe_order->city_id,
                'zip'=> $stripe_order->zip,
                'company'=> $stripe_order->company,
                'additional'=> $stripe_order->additional,
                'created_at'=>Carbon::now(),
            ]);

        if ($charge->status === 'succeeded') {


            $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();

            foreach ($carts as $cart) {
                OrderProduct::insert([
                    'order_id' => $order_id,
                    'customer_id' => Auth::guard('customer')->id(),
                    'product_id' => $cart->product_id,
                    'color_id' => $cart->color_id,
                    'size_id' => $cart->size_id,
                    'price' => Inventory::where('product_id',$cart->product_id)
                        ->where('color_id',$cart->color_id)
                        ->where('size_id',$cart->size_id)
                        ->first()->discount_price,
                    'quantity' => $cart->quantity,
                    'created_at' => Carbon::now(),
                ]);

                Inventory::where('product_id',$cart->product_id)
                    ->where('color_id',$cart->color_id)
                    ->where('size_id',$cart->size_id)
                    ->decrement('quantity', $cart->quantity);
            }

            Cart::where('customer_id', Auth::guard('customer')->id())->delete();

            Mail::to($stripe_order->email)->send(new InvoiceMail($order_id));

            return redirect()->route('order.success', $order_id);
        }

        return back()->with('error', 'Payment failed');
    }
}
