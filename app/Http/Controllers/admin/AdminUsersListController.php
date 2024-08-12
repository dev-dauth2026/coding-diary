<?php

namespace App\Http\Controllers\admin;


use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUsersListController extends Controller
{
    public function users(){
        $users = User::orderBy('created_at','desc')->get();
        $roles = Role::orderBy('name','asc')->get();
        return view('admin.users', compact('users','roles'));
    }

    public function roleUpdate(Request $request, User $user){
        $user->role_id = $request->input('role_id');

        $user->save();

        return redirect()->back()->with('success','User role has been successfully updated.'); 
    }
}
