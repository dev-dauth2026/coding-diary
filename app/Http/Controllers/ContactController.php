<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function contact(){
        return view('contact');
    }

    public function processContact(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->route('account.contact')->withInput()->withErrors($validator);
        }

        if($validator->passes()){

            $user = User::where('email', $request->email)->first();

            $contact = new Contact();
            $contact->user_type =  $user?'user':'guest';;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->message = $request->message;
            
            $contact->save();

            return redirect()->route('account.contact')->with('success',"Form has been successfully submitted.");
        }


    }
}
