<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Seller;
use App\Models\ServiceProvider;
use App\Models\Admin;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('pages.login.login');
    }
    public function loginValidation(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'role' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:5',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*#?&]/',
                ],
            ],

            [
                'password.regex' => 'Invalid password formate!',
                'password.required' => 'Password is required!',
                'email.required' => 'Email is required!',
                'email.email' => 'Invalid email address!',
                'role.required' => 'Select your user role!'
            ]
        );
        $role = $request->role;
        if ($role == 'customer') {
            $check = Customer::where([
                ['email', '=', $request->email],
                ['password', '=', $request->password]
            ])->first();

            
            if ($check) {
                session([
                    'id' => $check->id,
                    'name' => $check->name,
                    'email' => $check->email,
                    'role' => $check->role,
                    'image' => $check->image,
                    'phone' => $check->phone,
                    'address' => $check->address
                ]);
                return redirect()->route('customerDashboard');
            }
            $request->session()->flash(
                'database-error',
                'User Not Found!'
            );
            return redirect('login');
        }
        elseif ($role == 'seller') {
            $check = Seller::where([
                ['email', '=', $request->email],
                ['password', '=', $request->password]
            ])->first();

            if ($check) {
                if ($check->status == 'Pending') {
                    $request->session()->flash(
                        'pending-message',
                        'Your account is not approved! Try again Later!'
                    );
                } else {
                    session([
                        'id' => $check->id,
                        'name' => $check->name,
                        'email' => $check->email,
                        'role' => $check->role,
                        'image' => $check->image,
                        'phone' => $check->phone,
                        'address' => $check->address
                    ]);
                    // return view('pages.dashboard.dashboard');
                    return redirect()->route('sellerDashboard');
                }
            }
            $request->session()->flash(
                'database-error',
                'User Not Found!'
            );
            return redirect('login');
        } elseif ($role == 'service') {

            $check = ServiceProvider::where([
                ['email', '=', $request->email],
                ['password', '=',$request->password]
            ])->first();
            
            if ($check) {
                if ($check->status == 'Pending') {
                    $request->session()->flash(
                        'pending-message',
                        'Your account is not approved! Try again Later!'
                    );
                }
                else{
                    session([
                        'id' => $check->id,
                        'name' => $check->name,
                        'email' => $check->email,
                        'role' => $check->role,
                        'image' => $check->image,
                        'phone' => $check->phone,
                        'address' => $check->address
                    ]);
                    return redirect()->route('serviceProviderDashboard');
                }
            }
            
            $request->session()->flash(
                'database-error',
                'User Not Found!'
            );
            return redirect('login');
        } else {
            $check = Admin::where([ 
                ['email', '=', $request->email],
                ['password', '=', $request->password]
            ])->first();
            if ($check) {
                if ($check->status == 'Pending') {
                    $request->session()->flash(
                        'pending-message',
                         'Your account is not approved! Try again Later!');
                } else {
                    session([
                        'id' => $check->id,
                        'name' => $check->name,
                        'email' => $check->email,
                        'role' => $check->role,
                        'image' => $check->image,
                        'phone' => $check->phone,
                        'address' => $check->address
                    ]);
                    // return view('pages.dashboard.dashboard');
                    return redirect()->route('adminDashboard');
                }
            }
            $request->session()->flash(
                'database-error', 
                'User Not Found!');
            return redirect('login');
        }
    }
    public function logout(Request $request)
    {
        session()->flush();
        // $request->session()->flash('logout-message', 'Logout successfully!');
        return redirect('/');
    }
}
