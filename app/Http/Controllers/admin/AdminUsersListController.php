<?php

namespace App\Http\Controllers\admin;


use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminUsersListController extends Controller
{
    public function users(Request $request){

        //Retrieve the roles for filter dropdown
        $roles = Role::orderBy('name','asc')->get();

        //Get filter and search query from the requestion
        $filteredRole = $request->has('role_id') ? $request->input('role_id') : 'all';
        $searchQuery = $request->has('search_username') ? $request->input('search_username') : '';


        //Build query with conditions
        $users = User::query();

        if($filteredRole !=='all' && !empty($searchQuery)){
            $users->where('role_id',$filteredRole)
                    ->where('name','LIKE', "%$searchQuery%")
                 ->orwhere('role_id',$filteredRole)
                 ->where('email', 'LIKE', "%$searchQuery%");
        }

        if(!empty($searchQuery) && $filteredRole =='all'){
            $users->where('name','LIKE', "%$searchQuery%")
                        ->orwhere('email', 'LIKE', "%$searchQuery%");
        }

        $users =$users->orderBy('created_at','desc')->get();

        //Calculate the total number of customer user
        $totalUsers = User::whereHas('role', function($query){
            $query->where('name','customer');
        })->count();

        //Calculate the total number of admin user
        $totalAdminUsers = User::whereHas('role', function($query){
            $query->where('name','admin');
        })->count();

        return view('admin.users', compact('users', 'roles', 'totalUsers', 'totalAdminUsers', 'filteredRole', 'searchQuery'));
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


   
}
