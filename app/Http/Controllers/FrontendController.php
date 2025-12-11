<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
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
}
