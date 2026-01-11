<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Country;
use App\Models\City;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;


class FrontendController extends Controller
{
    function index(){
        $category = Category::all();
        $products = Product::all();
        $recent_products = Product::latest()->take(3)->get();
      return view('frontend.index',[
        'categories'=>$category,
        'products' =>$products,
        'recent_products'=>$recent_products,

      ]);
    }
    function product_details($slug){
        $product_id = Product::where('slug',$slug)->first()->id;
        $product_info = Product::find($product_id);
        $similler_products =Product::where('category_id', $product_info->category_id)->where('id','!=',$product_id)->get();

        //Colors-->

        $available_colors = Inventory::where('product_id',$product_id)
        ->groupBy('color_id')
        ->selectRaw('sum(color_id) as sum, color_id')
        ->get();

        //size---

        $available_sizes = Inventory::where('product_id',$product_id)
        ->groupBy('size_id')
        ->selectRaw('sum(size_id) as sum, size_id')
        ->get();
        return view('frontend.product_details',[
            'product_info' =>$product_info,
            'available_colors'=>$available_colors,
            'available_sizes'=>$available_sizes,
            'similler_products'=>  $similler_products,
        ]);
    }
    function customer_register(){
         return view('frontend.register');
    }
    function customer_login(){
        return view("frontend.login");
    }
    function checkout(Request $request){
        $carts= Cart:: where('customer_id',Auth::guard('customer')->id())->get();
        $coupon = $request->coupon;
        $coupon_dis = 0;
        if($coupon){
            if(Coupon::where('coupon',$coupon)->exists()){
                if(Carbon::now()->format('Y-m-d')<=Coupon::where('coupon',$coupon)->first()->validity){
                 $coupon_dis = Coupon::where('coupon',$coupon)->first()->amount;
                }
                else{
                    return back()->with('not_exists','Coupon code expired');

                }

            }
             else{
                    return back()->with('not_exists','Invalid coupon code');
                }
        }
        $countries = Country::all();
        $cities = City::all();
        return view('frontend.checkout',[
            'carts'=> $carts,
            'coupon_dis'=>$coupon_dis,
            'countries'=>$countries,
            'cities'=>$cities,
        ]);

    }
}
