<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ChangeUserName extends Controller
{
    public function changeUserName(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|exists:users,email|unique:users,email'
        ]);

        if($validator->fails()){
            return redirect()->route('account.account')->withInput()->withErrors($validator);
        };
    
        Auth::user()->update([
            'name' =>$request->name,
            'email' => $request->email
        ]);
    
        return redirect()->route('account.account')->with('status', 'Name and Email has been updated sucessfully.');
    }

    public function changeProfilePicture(Request $request){
        $validator = Validator::make($request->all(),[
            'profile_picture' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return redirect()->route('account.account')->withErrors($validator);
        }

        $user = Auth::user();

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
        
        return redirect()->route('account.account')->with('status','Profile Picture has been successfully updated.');
    }

  
}
