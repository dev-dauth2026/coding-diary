<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // This method will show login for customer
    public function index(){
        return view('login');
    }

    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if($validator->passes()){
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect()->route('account.dashboard')->with('loggedIn',' You have been successfully logged in.');
            }else{
                return redirect()->route('account.login')->withInput()->with('error','Either email or password is incorrect.');
            }

        }
  
        if($validator->fails()){
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }

    }

    public function register(){
        return view('register');
    }

    public function processRegister(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' =>'required|email|unique:users',
            'password' =>'required|confirmed|min:8',
            'password_confirmation' =>'required|min:8',
        ]);

        if($validator->passes()){

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'customer';
            $user->save();

            return redirect()->route('account.login')->with('success', 'Congratulation, You have been successfully registerd!');


        }

        if($validator->fails()){
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        }


    }

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login');
    }

    public function about(){
        return view('about');
    }

    

        


}
