<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;

class ManagerController extends Controller
{
    //
    public function dashboard(){
        $manager = Manager::where('id',Session()->get('managerId'))->first();
        return view('pages.dashboard')->with('manager',$manager);
    }
    public function editManagerInfo(){
        $manager = Manager::where('id',Session()->get('managerId'))->first();
        return view('pages.edituser')->with('user',$manager);
    }
    public function managerInfoUpdate(Request $request){
        $this->validate(
            $request,
            [
                'name'=>'required|min:4|max:50',
                'email'=>'email',
                'username'=>'required|min:5|max:20',
                'dob'=>'required',
                'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'gender'=>'required'
            ],
            [
                'name.required'=>'Name is needed',
                'name.min'=>'Name should be more than 4 charecters'
            ]
            );

        $var = Manager::where('id',$request->id)->first();
        $var->name= $request->name;
        $var->email = $request->email;
        $var->phone = $request->phone;
        $var->username = $request->username;
        $var->dob = $request->dob;
        $var->gender = $request->gender;
        $var->save();
        return redirect()->route('dashboardManager');
    }
}
