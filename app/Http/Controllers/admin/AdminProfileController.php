<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class AdminProfileController extends Controller
{

    public function showProfile(){
        $admin = Auth::guard('admin')->user();
        return view('admin.profile',compact('admin'));
    }
    public function changeUserName(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',

        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        };
    
        Auth::guard('admin')->user()->update([
            'name' =>$request->name,
            'email' => $request->email
        ]);
    
        return redirect()->back()->with('success', 'Username has been updated sucessfully.');
    }

    public function changeProfilePicture(Request $request){
        $validator = Validator::make($request->all(),[
            'profile_picture' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $user = Auth::guard('admin')->user();

        if($request->hasFile('profile_picture')){

            // Delete old picture if exists
            if($user->profile_picture){
                Storage::delete($user->profile_picture);
            }

            //Store new profile picture
            $path = $request->file('profile_picture')->store('profile_picture');

            //update user profile picture path
            $user->profile_picture = $path;

        }
        $user->save();
        
        return redirect()->back()->with('success','Profile Picture has been successfully updated.');
    }

    public function destroyProfilePicture(){
        $admin = Auth::guard('admin')->user();
        $admin->profile_picture = null;

        $admin->save();

        return redirect()->back()->with('success', 'Profile Picture has been successfully removed.');
    }

    public function changePassword(Request $request)
    {
       $validator= Validator::make($request->all(),[
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::defaults()],
        ]);

        // Check if current password matches
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        if (!Hash::check($request->current_password, Auth::guard('admin')->user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        // Update the user's password
        Auth::guard('admin')->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Password successfully changed!');
    }

   
}
