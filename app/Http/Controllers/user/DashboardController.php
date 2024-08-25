<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('user_dashboard.dashboard');
    }
    public function account(){
        return view('user_dashboard.account');
    }

}
