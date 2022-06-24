<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function studentRegistration(Request $request){
       
       
         return view('pages.student.studentRegistration');
        

    }
    // ---------------------------------------------------
    //  validation of student registration form
    //  ----------------------------------------------------
    public function studentRegistrationSubmit(Request $request){
        $validate=$request->validate([
            'name'=>'required|min:5|max:10',
            'email'=>'email',
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'address'=>'required'
        ],

        [
            'name.required'=>'Please put your name',
            'name.min'=>'Name must be greater than 5 charcters',
            'email'=>"Put your mail",
            'phone.required'=>"put your phone",
            'address.required'=>"put your address"

        ]
    );
       
        // return view('pages.student.studentRegistration');
        return "User Registered Succesfully.";

    }

   public function loginForm(){
    return view('pages.student.loginForm');
   }

   public function loginFormSubmit(Request $request){
    $validate=$request->validate([
        'email'=>'required',
        'password'=>'required',
       
    ],
    [
        'email.required'=>'Please put your email',
        'password.required'=>'Please put your password',
       

    ]);


    // return "ok";
    $email=array("user@gmail.com");
    $pass=array("12345678");
    $mail=$request->email;
    $password=$request->password;
    if( $mail==$email[0] &&  $password== $pass[0])
    return "Welcome...! login successfull.";
   }

}
