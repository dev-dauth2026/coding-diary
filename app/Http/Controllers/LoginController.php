<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // This method will show login for customer
    public function login(){
        return view('login');
    }

    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validator->passes()) {

            $user = User::where('email', $request->email)->first();
        
            if ($user) {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password]) && $user->email_verified_at !== null) {
                    $request->session()->forget('verify_email');
        
                    return redirect()->route('account.dashboard')->with('loggedIn', 'You have been successfully logged in.');
                } elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    // Email exists but not verified, update the subscription timestamp
        
                    // Store email in session
                    session(['verify_email' => $request->email]);
        
                    event(new Registered($user)); 

                    Auth::logout();
        
                    return to_route('account.login')->with('message', 'You had already registered but please check your email to verify.');
                } else {
                    return redirect()->route('account.login')->withErrors($validator)->withInput();
                }
            }else{
                return redirect()->route('account.login')->with('error','There is no account associated with this email.');
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

            
            event(new Registered($user));

            session(['verify_email' => $request->email]);

            return redirect()->route('account.login')->with('message', 'Congratulation, You have been successfully registerd. Please check your email to verify!');


        }

        if($validator->fails()){
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        }


    }

    public function verifyEmail(Request $request, $id, $hash)
    {
        
        if(session('subscription_email')){

                $subscription = Subscription::findOrFail($id);

                if (! hash_equals((string) $hash, sha1($subscription->email))) {
                    return to_route('home')->with('status','Invalid verification link');
                }
                if ($subscription->email_verified_at) {
                    return to_route('home')->with('status','Email already verified!');
                }

                $subscription->update(['email_verified_at' => Carbon::now()]);

                $request->session()->forget('subscription_email');

                return to_route('home')->with('status','Email verified successfully!');

            } elseif(session('verify_email')){
                $user = User::findOrFail($id);

                if (! hash_equals((string) $hash, sha1($user->email))) {
                    if(session('verify_email')){
                        return to_route('account.login')->with('status','Invalid verification link');
                    }
                }
        
                if ($user->email_verified_at) {
                    return to_route('account.login')->with('status','Email already verified!');
                }

                $user->update(['email_verified_at' => Carbon::now()]);

                $request->session()->forget('verify_email');

                 return to_route('account.login')->with('message','Email verified successfully!');
            }
    }

    public function verificationResend(Request $request){
        $request->validate(['email' => 'required|email']);

        // Check if the email already exists
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($user->email_verified_at) {
                return redirect('/')->withErrors(['email' => 'Email already verified!']);
            } else {
                // Email exists but not verified, update the user timestamp

                event(new Registered($user)); 

                return to_route('account.login')->with('message', 'Email verification link has been resent. please check your email to verify.');
            }
        } else{
            $user = User::create($request->only('email'));

            event(new Registered($user));  // Trigger verification notice
    
            return back()->with('message', 'Thanks for subscribing! Please check your email to verify.');  
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
