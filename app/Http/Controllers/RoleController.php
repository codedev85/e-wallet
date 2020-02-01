<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Wallet;

class RoleController extends Controller
{
    //
    public function addRole(){

        return view('role.add-role');
    }

    public function postRole(Request $request){

        $role = $request->input('role');


        $validatedData = $request->validate([
            'role' => 'required|string',
        ]);
        $newRole = new Role();
        $newRole->name = $role;
        $newRole->save();
        return back()->with('success','Saved Successfully!');
    }

    public function createAdmin(){
        $roles = Role::all();
        return view('admin.create')->with('roles',$roles);
    }

    public function postAdmin(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required',
        ]);
        $username = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $c_password = $request->input('c_password');
        $roleId = $request->input('role');

    if($password == $c_password){

        $newUser = new User();
        $newUser->name = $username;
        $newUser->email =$email;
        $newUser->role_id = $roleId;
        $newUser->password = Hash::make($password);
        $newUser->save();


        $wallet = new Wallet();
        $wallet->user_email = $email;
        $wallet->credit = 0;
        $wallet->debit = 0;
        $wallet->balance = 0;
        $wallet->save();

        return redirect('home')->with('success','User Created Successfully!');

    }else{
        return back()->with('warning','The password does not match');
    }
    }

    public function allAdmin(){

        $alladmin = User::all();
        return view('admin.all-users')->with('alladmin',$alladmin);
    }


}
