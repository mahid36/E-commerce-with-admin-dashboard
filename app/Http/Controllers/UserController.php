<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{
function edit_profile(){
return view ('backend.user.edit_profile');
 }
 function update_profile(Request $request){
    if($request->photo){
        $request->validate([
            'photo' => 'mimes:png,jpg,jpeg'
        ]);

        if (Auth::user()->photo != null) {
            $delete_from = public_path('uploads/users/' . Auth::user()->photo);
            if (file_exists($delete_from)) {
                unlink($delete_from);
            }
        }

        $extension = $request->photo->extension();
        $file_name = uniqid().'.'.$extension;
        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->photo);
        $image->toPng()->save(public_path('uploads/users/'.$file_name));

        User::find(Auth::id())->update([
            'name' => $request->name,
            'photo' => $file_name,
        ]);

        return back()->with('success', 'Profile Updated Successfully');
    }
    else{
        User::find(Auth::id())->update([
            'name' => $request->name
        ]);
        return back()->with('success', 'Profile Updated Successfully');
    }
}

function update_password(request $request){
$request->validate([
    'current_password'=>'required',
    'new_password'=>['required','confirmed'],
    'new_password_confirmation'=>'required'
]);
if (Hash::check($request->current_password, Auth::user()->password)) {
    User::find(Auth::id())->update([
        'password' => bcrypt($request->new_password),
    ]);
    return back()->with('pass_update', 'Password Changed');
} else {
    return back()->with('wrong', 'Password did not match');
}

 }
}
