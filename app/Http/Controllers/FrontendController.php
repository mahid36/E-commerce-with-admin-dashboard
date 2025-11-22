<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        return view('frontend.product_details',[
            'product_info' =>$product_info,
        ]);
    }
}
