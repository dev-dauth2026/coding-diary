<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Events\Registered;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Check if the email already exists
        $subscription = Subscription::where('email', $request->email)->first();

        if ($subscription) {
            if ($subscription->email_verified_at) {
                return redirect('/')->withErrors(['email' => 'Email already verified!']);
            } else {
                // Email exists but not verified, update the subscription timestamp

                // Store email in session
                session(['subscription_email' => $request->email]);

                event(new Registered($subscription)); 

                return to_route('home')->with('message', 'You had already subscribed but please check your email to verify.');
            }
        } else{
            $subscription = Subscription::create($request->only('email'));
            // Store email in session
            session(['subscription_email' => $request->email]);

            event(new Registered($subscription));  // Trigger verification notice
    
            return back()->with('message', 'Thanks for subscribing! Please check your email to verify.');  
        }

        
    }

    public function verificationResend(Request $request){
        $request->validate(['email' => 'required|email']);

        // Check if the email already exists
        $subscription = Subscription::where('email', $request->email)->first();

        if ($subscription) {
            if ($subscription->email_verified_at) {
                return redirect('/')->withErrors(['email' => 'Email already verified!']);
            } else {
                // Email exists but not verified, update the subscription timestamp

                event(new Registered($subscription)); 

                return to_route('home')->with('message', 'Email verification link has been resent. please check your email to verify.');
            }
        } else{
            $subscription = Subscription::create($request->only('email'));

            event(new Registered($subscription));  // Trigger verification notice
    
            return back()->with('message', 'Thanks for subscribing! Please check your email to verify.');  
        }
    }

    
    public function verifyEmail(Request $request, $id, $hash)
    {
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

    }

 
}

