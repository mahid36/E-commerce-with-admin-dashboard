<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
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
}
