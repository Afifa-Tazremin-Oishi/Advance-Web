<?php

namespace App\Http\Controllers;

use App\Models\login;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Requests\StoreloginRequest;
use App\Http\Requests\UpdateloginRequest;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreloginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreloginRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\login  $login
     * @return \Illuminate\Http\Response
     */
    public function show(login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit(login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateloginRequest  $request
     * @param  \App\Models\login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateloginRequest $request, login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy(login $login)
    {
        //
    }
    public function teacherLogin(){
        return view ("pages.teacher.teacherLogin");
    }
    public function teacherLoginSubmit(Request $request){
        $validate=$request->validate([
            'email'=>'required',
            'password'=>'required',
           
        ],
        [
            'email.required'=>'Please put your email',
            'password.required'=>'Please put your password',
           
    
        ]);

        $teacher=Teacher::where("email",$request->email)
        ->where("password",$request->password)
        ->first();
        if ($teacher){
            // return "hi";
            $request->session()->put("user",$teacher->name);

            return redirect()->route("teacherDash");
        }
        return back();
    }

    public function teacherDash(){
        return view ("pages.teacher.teacherDash");
    }
     public function logout(){
        session()->forget('user');
        return redirect()->route('teacherlogin');
    }
}
