<?php

namespace App\Http\Controllers;

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
