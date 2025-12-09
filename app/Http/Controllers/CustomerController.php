<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CustomerController extends Controller
{
    function customer_store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>['required', 'unique:customers'],
            'password'=>['required', 'confirmed'],
            'password_confirmation'=>'required',
        ]);
        Customer::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

         if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' =>        $request->password])) {
            return redirect()->route('index');
        }
        // return back()->with('success', 'Registered Successfully');
    }

    function customer_signin(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        if(Customer::where('email', $request->email)->exists()){
            if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('index');
            }
            else{
                return back()->with('wrong_pass', 'Wrong Password');
            }
        }
        else{
            return back()->with('nt_exists', 'Email Does not Exist');
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
        if($request->password){
            if($request->photo){
                //password ache and photo ache

                if(password_verify($request->current_password, Auth::guard('customer')->user()->password)){
                    if(Auth::guard('customer')->user()->photo != null){
                        $delete_from = public_path('uploads/customer/'.Auth::guard('customer')->user()->photo);
                        unlink($delete_from);
                    }
                    $extension = $request->photo->extension();
                    $file_name = uniqid().'.'.$extension;
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($request->photo);
                    $image->save(public_path('uploads/customer/'.$file_name));

                    Customer::find(Auth::guard('customer')->id())->update([
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'country'=>$request->country,
                        'address'=>$request->address,
                        'password'=>bcrypt($request->password),
                        'photo'=>$file_name,
                    ]);
                    return back()->with('success', 'Profile updated');
                }
                else{
                    return back()->with('wrong_current', 'Current Password Incorrect');
                }
            }
            else{
                //password ache and photo nai
                if(password_verify($request->current_password, Auth::guard('customer')->user()->password)){

                    Customer::find(Auth::guard('customer')->id())->update([
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'country'=>$request->country,
                        'address'=>$request->address,
                        'password'=>bcrypt($request->password),
                    ]);
                    return back()->with('success', 'Profile updated');
                }
                else{
                    return back()->with('wrong_current', 'Current Password Incorrect');
                }
            }
        }
        else{
            if($request->photo){
                //password nai and photo ache
                if(Auth::guard('customer')->user()->photo != null){
                    $delete_from = public_path('uploads/customer/'.Auth::guard('customer')->user()->photo);
                    unlink($delete_from);
                }
                $extension = $request->photo->extension();
                $file_name = uniqid().'.'.$extension;
                $manager = new ImageManager(new Driver());
                $image = $manager->read($request->photo);
                $image->save(public_path('uploads/customer/'.$file_name));

                Customer::find(Auth::guard('customer')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'country'=>$request->country,
                    'address'=>$request->address,
                    'photo'=>$file_name,
                ]);
                return back()->with('success', 'Profile updated');
            }
            else{
                //password nai and photo nai
                Customer::find(Auth::guard('customer')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'country'=>$request->country,
                    'address'=>$request->address,
                ]);
                return back()->with('success', 'Profile updated');
            }
        }
    }
}
