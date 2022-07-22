<?php

namespace App\Http\Controllers;
use App\Models\User;


use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function userList()
    {
        $allUsers = User::all();
        return view('pages.userList', ['allUsers' => $allUsers]);
    }
    function deleteUser(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->delete();
        $request->session()->flash('user-delete', 'User Deleted Successfully!');
        return redirect('userList');
    }
    public function allUser()
    {
        $allUsers = User::all();
        return view('pages.addUser', ['allUsers' => $allUsers]);
    }
    public function listingUser(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:4|max:20',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
               
                'password' => [
                    'required',
                    'string',
                    'min:10',             
                    'regex:/[a-z]/',     
                    'regex:/[A-Z]/',     
                    'regex:/[0-9]/',      
                    'regex:/[@$!%*#?&]/' 

                ],
            ],
            [
                'phone.required' => 'Phone is required!',
                'phone.regex' => 'Invalid phone number!',
                'address.required' => 'Address is required!',
                'password.required' => 'Password is required!',
                'password.regex' => 'Invalid password formate!',
                'password.min' => 'Must contain 10 characters!',
                'name.required' => 'Name is required!',
                'email.required' => 'Email is required!',
                'email.email' => 'Invalid email address!',
                'name.min' => 'Insert more than 5 characters!',
                'name.max' => 'Insert less than 20 characters!',
               
            ]
        );
        $email = $request->email;
        $check = User::where([
            ['email', '=', $email]
        ])->first();
        if ($check) {
            $request->session()->flash('database-error', 'Email already taken!');
            return redirect('addUser');
        } else {
            $var = new User();
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
           
            $var->save();
            $request->session()->flash('user-added', 'User Added!');
            return redirect('addUser');
        }
    }
    function EditUser($id)
    {
        $users = User::find($id);
        return view('pages.api.editUser', ['users' => $users]);
    }
    function updateUser(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:4|max:20',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
               
                'password' => [
                    'required',
                    'string',
                    'min:10',             // must be at least 10 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&]/' // must contain a special character

                ],
            ],
            [
                'phone.required' => 'Phone is required!',
                'phone.regex' => 'Invalid phone number!',
                'address.required' => 'Address is required!',
                'password.required' => 'Password is required!',
                'password.regex' => 'Invalid password formate!',
                'password.min' => 'Must contain 10 characters!',
                'name.required' => 'Name is required!',
                'email.required' => 'Email is required!',
                'email.email' => 'Invalid email address!',
                'name.min' => 'Insert more than 5 characters!',
                'name.max' => 'Insert less than 20 characters!',
              
            ]
        );
        $var = User::find($request->id);
        $var->name = $request->name;
        $var->email = $request->email;
        $var->phone = $request->phone;
        $var->address = $request->address;
        $var->password = $request->password;
      
        $var->update();
        $request->session()->flash('user-update', 'User Updated Successfully!');
        return redirect('userList');
    }



    // update profile
    public function showUserProfile(){

        $user = User::where('id',Session()->get('id'))->first();
        return view('pages.dashboard')->with('user',$user);
       }
       
        function EditUserProfile($id)
        {
            $user = User::find($id);
            return view('pages.editUserProfile', ['user' => $user]);
        }
        function updateUserProfile(Request $request)
        {
            $this->validate(
                $request,
                [
                    'name' => 'required|min:4|max:20',
                    'email' => 'required|email',
                    'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                    'address' => 'required',
                    'password' => [
                        'required',
                        'string',
                        'min:10',             // must be at least 10 characters in length
                        'regex:/[a-z]/',      // must contain at least one lowercase letter
                        'regex:/[A-Z]/',      // must contain at least one uppercase letter
                        'regex:/[0-9]/',      // must contain at least one digit
                        'regex:/[@$!%*#?&]/' // must contain a special character
    
                    ],
                ],
                [
                    'phone.required' => 'Phone is required!',
                    'phone.regex' => 'Invalid phone number!',
                    'address.required' => 'Address is required!',
                    'password.required' => 'Password is required!',
                    'password.regex' => 'Invalid password formate!',
                    'password.min' => 'Must contain 10 characters!',
                    'name.required' => 'Name is required!',
                    'email.required' => 'Email is required!',
                    'email.email' => 'Invalid email address!',
                    'name.min' => 'Insert more than 5 characters!',
                    'name.max' => 'Insert less than 20 characters!',
                ]
            );
            $var = User::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->update();
            $request->session()->flash('user-update', 'Profile Update successfully');
            return redirect('userDashboard');
           
        }
        

        // For Api 
        // show all user
        public function UserAPIInfo(){
            return User::all()->toJson();
        }
        // post all user
        public function UserAPIPost(Request $request){
            $var = new User();
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
           
            $var->save();
            return redirect('http://127.0.0.1:8000/');
           
          }  }

