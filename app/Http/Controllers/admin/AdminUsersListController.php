<?php

namespace App\Http\Controllers\admin;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUsersListController extends Controller
{
    public function users(){
        $users = User::orderBy('created_at','desc')->get();
        return view('admin.users', compact('users'));
    }
}
