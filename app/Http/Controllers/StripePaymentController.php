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

class StripePaymentController extends Controller
{
    public function stripe($order_id): View
    {
        return view('stripe', compact('order_id'));
    }

    public function stripePost(Request $request, $order_id): RedirectResponse
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $order = Order::where('order_id', $order_id)->firstOrFail();
        $total = $order->total;

        $charge = Stripe\Charge::create([
            "amount" => $total * 100,
            "currency" => "bdt",
            "source" => $request->stripeToken,
            "description" => "Order Payment"
        ]);

        if ($charge->status === 'succeeded') {

            $order->update(['status' => 1]);

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

            Mail::to($order->email)->send(new InvoiceMail($order_id));

            return redirect()->route('order.success', $order_id);
        }

        return back()->with('error', 'Payment failed');
    }
}
