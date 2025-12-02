<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    function customer_store(Request $request){
         $request->validate([
            'name'=>'required',
            'email'=>['required','unique:customers'],
            'password'=>['required','confirmed'],
            'password_confirmation'=>'required',
        ]);
        Customer::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
             if(Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect()->route('index');
            }


        //    return back()->with('success','Registered Successfully');
    }
    function customer_signin(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        if(Customer::where('email', $request->email)->exists()){
            if(Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect()->route('index');
            }
            else{
                return back()->with('wrong_pass','Wrong Password');
            }

        }
        else{
            return back()->with('nt_exists','Email does not exists');
        }
    }
    function customer_profile(){
        return view('frontend.profile');
    }
    function customer_logout(){
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login');
    }
    function customer_update(Request $request){

    }

}
