<?php

namespace App\Http\Controllers;

use App\Models\Newslettersubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function newsletterSubscription(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:newslettersubscriptions',
        ]);

        if($validator->fails()){
            return redirect()->route('account.home')->withInput()->withErrors($validator);
        }

        $subscribe = new Newslettersubscription();
        $subscribe->email = $request->email;
        $subscribe->save();

        return redirect()->route('account.home')->with('subscribed', 'You have been successfully subscribed.');
    }
}
