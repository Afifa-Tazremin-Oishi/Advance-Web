<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Manager;

// use App\Models\Admin;

class LoginController extends Controller
{
    public function login(){
        return view('pages.login');
    }
    public function loginCheck(Request $request){
        $this->validate(
            $request,
            [
                
                'username' => 'required',
                'password'=>'required'
            ],
            [
                'username.required'=> 'Enter your username',
                'password.required'=>'Password required !',
                'password.min'=>'Minimum 6 character required !'
                
            ]
        );

        $managers = Manager::all();
        // $admins = Admin::all();
        $flag=False;
        //     foreach($admins as $user)
        // {
        //     if($user->username== $request->username && $user->password==md5($request->password))
        //         {   
        //             $flag=True;
        //             $request=session()->put('admin',$user->username);
        //             $request=session()->put('adminId',$user->adminId);
        //             return redirect()->route('dashboardAdmin');
        //         }
                
        // }
            foreach($managers as $user)
        {
            if($user->username== $request->username && $user->password==md5($request->password))
                {
                    $flag=True;
                    $request=session()->put('manager',$user->username);
                    $request=session()->put('managerId',$user->id);
                    return redirect()->route('dashboardManager');
                }
               
        }

        
        if($flag==False)
        {
           return ("User Id Or Password Not Matched");
           $errormsg = "User Id Or Password Not Matched";
           return view('pages.login')->with('errormsg',$errormsg);
        }
    }
}
