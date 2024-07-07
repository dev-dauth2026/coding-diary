<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request)
    {
       $validator= Validator::make($request->all(),[
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::defaults()],
        ]);

        // Check if current password matches
        if ($validator->fails()){
            return redirect()->route('account.account')->withErrors($validator);
        }
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->route('account.account')->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        // Update the user's password
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('account.account')->with('status', 'Password successfully changed!');
    }

   
}
