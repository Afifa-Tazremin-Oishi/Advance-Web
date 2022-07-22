<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Manager;

use App\Models\Admin;

class RegistrationController extends Controller
{
    public function registration(){
        return view('pages.registration');
    }
    public function validateRegistration(Request $request){
        //using requests validate method
        $this->validate(
            $request,
            [
                'name'=>'required|min:4|max:50',
                'email'=>'email',
                'username'=>'required|min:5|max:20',
                'password'=>'required|confirmed|min:5',
                'password_confirmation'=>'required',
                'dob'=>'required',
                'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'gender'=>'required'
            ],
            [
                'name.required'=>'Name is required',
                'name.min'=>'Name should be more than 4 charecters'
            ]
            );
            $var = new Manager();
            $var->name= $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->username = $request->username;
            $var->password=md5($request->password_confirmation);
            $var->dob = $request->dob;
            $var->gender = $request->gender;
            $var->save();
        return redirect()->route('login');    
    }
}
