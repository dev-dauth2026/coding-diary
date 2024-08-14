<?php

namespace App\Http\Controllers\admin;


use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminUsersListController extends Controller
{
    public function users(){
        $users = User::orderBy('created_at','desc')->get();
        $roles = Role::orderBy('name','asc')->get();
        $totalUsers = User::whereHas('role', function($query){
            $query->where('name','customer');
        })->count();
        $totalAdminUsers = User::whereHas('role', function($query){
            $query->where('name','admin');
        })->count();
        return view('admin.users', compact('users','roles','totalUsers','totalAdminUsers'));
    }

    public function roleUpdate(Request $request, User $user){
        $user->role_id = $request->input('role_id');

        $user->save();

        return redirect()->back()->with('success','User role has been successfully updated.'); 
    }

    public function userEdit(User $user){
        $roles = Role::orderBy('name','asc')->get();
        return view('admin.edit_user',compact('user','roles'));

    }

    public function userUpdate(Request $request,User $user){
        $user->name= $request->name;
        $user->email= $request->email;
        $user->role_id= $request->role_id;
        if(!empty($request->password)  ){
            $validator = Validator::make($request->all(),[
                'password' =>'required|min:8|confirmed',
                'password_confirmation' =>'required|min:8'
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator);
            }
            $user->password = $request->password;
        }

        $user->save();

        return redirect()->route('admin.users')->with('success','The user has been successfully updated.');


    }

    public function userDestroy(User $user){
        $user->delete();

        return redirect()->back()->with('success','The user has been successfully removed.');

    }

    public function userFilterByRole(Request $request){

        $filteredRole = $request->role_id;
       
        if(!empty($request->role_id) && $request->role_id !=='all'){

            $users = User::query()->where('role_id',$filteredRole)->orderBy('created_at','desc')->get();
        }elseif($request->role_id =='all'){
            $users = User::get();
        }
        // $users = User::when($request->role_id, function($query) use($request){
        //     return $query->where('role_id',$filteredRole);  
        // })->orderBy('created_at','DESC')->get();
        $roles = Role::orderBy('name','asc')->get();
        $totalUsers = User::whereHas('role', function($query){
            $query->where('name','customer');
        })->count();
        $totalAdminUsers = User::whereHas('role', function($query){
            $query->where('name','admin');
        })->count();
        
        return view('admin.users', compact('users','roles','totalUsers','totalAdminUsers','filteredRole'));


    }
}
