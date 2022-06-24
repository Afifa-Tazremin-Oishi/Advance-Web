<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{

    //display customer all information for (customer)
     public function showCustomerProfile()
     {
         $customer = Customer::where('id', session()->get('id'))->first();
         return view('pages.dashboard.dashboard')->with('customer', $customer);
     }

     //Edit customer profile info by (customer)
    function EditCustomerProfile($id)
    {
        $customer = Customer::find($id);
        return view('pages.customer.editCustomerProfile', ['customer' => $customer]);
    }

    // update customer profile info by (customer)
    function updateCustomerProfile(Request $request)
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
        $check = Customer::where([
            ['email', '=', $email]
        ])->first();

        $Customer = Customer::find($request->id);
        if ($Customer->email == $request->email) {
            
            $var = Customer::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->update();
            $request->session()->flash('customer-update', 'Profile Update successfully');
            return redirect('customerDashboard');
        }
        if ($check) {
            $request->session()->flash('database-error', 'Email already taken! use another one!');
            return redirect('editCustomerProfile/' . $request->id);
        } else {
            $var = Customer::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->update();
            $request->session()->flash('customer-update', 'Profile Update successfully');
            return redirect('customerDashboard');
        }
    }
    //add customer profile image by (customer)
    public function addCustomerPhoto(Request $request)
    {
        $this->validate(
            $request,
            [
                'image' => 'required',
                'role' => 'required',
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'status' => 'required',
            ],
        );
        $var = Customer::where('id', session()->get('id'))->first();
        $var->name = $request->name;
        $var->email = $request->email;
        $var->address = $request->address;
        $var->password = $request->password;
        $var->phone = $request->phone;
        $var->role = $request->role;
        $var->status = $request->status;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('uploads/customerProfile/', $fileName);
            $var->image =  $fileName;
        }
        $var->update();
        $request->session()->flash('image-added', 'Uploaded profile picture!');
        return redirect('customerDashboard');
    }
    // send data to changeSellerImage page for change image by (seller)
    function changeCustomerImage($id)
    {
        $customer = Customer::find($id);
        return view('pages.customer.changeCustomerImage', ['customer' => $customer]);
    }
    //change profile image by (customer)
    function updateCustomerImage(Request $request)
    {
        $this->validate(
            $request,
            [
                'image' => 'required',
                'role' => 'required',
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'status' => 'required'
            ],
        );
        $var = CUstomer::find($request->id);
        $var->name = $request->name;
        $var->email = $request->email;
        $var->address = $request->address;
        $var->password = $request->password;
        $var->phone = $request->phone;
        $var->role = $request->role;
        $var->status = $request->status;

        if ($request->hasFile('image')) {
            $destination = 'uploads/customerProfile/' . $var->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('uploads/customerProfile/', $fileName);
            $var->image =  $fileName;
        }
        $var->update();
        $request->session()->flash('image-update', 'Image changed successfully!');
        return redirect('customerDashboard');
    }

    public function customerList()
    {
        $allCustomers = Customer::all();

        // if (session('role') == 'admin') {
        //     return view('pages.customer.customerList', ['allCustomers' => $allCustomers]);
        // } else
        //     return view('pages.error.error');
        return view('pages.customer.customerList', ['allCustomers' => $allCustomers]);
    }

    function approvedCustomerEdit($id)
    {
        $customer = Customer::find($id);
        return view('pages.customer.updateCustomerStatus', ['status' => $customer]);
    }

    function approvedCustomer(Request $request)
    {
        $this->validate(
            $request,
            [
                'status' => 'required'
            ],
        );
        $customer = Customer::find($request->id);
        $customer->id = $request->id;
        $customer->status = $request->status;
        $customer->update();

        $request->session()->flash('customer-approved', 'Customer status update!');
        return redirect('customerList');
    }
    //pass value for addCustomer page
    public function allCustomer()
    {
        $allCustomers = Customer::all();
        return view('pages.customer.addCustomer', ['allCustomers' => $allCustomers]);
    }
    // delete customer account by customer
    function deleteCustomerAccount(Request $request)
    {
        $customer = Customer::where('id', $request->id)->first();
        $destination = 'uploads/customerProfile/' . $customer->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $customer->delete();
        session()->flush();
        // $request->session()->flash('order-delete', 'Order Deleted Successfully!');
        return redirect('/');
    }
    // ADD customer
    public function listingCustomer(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:4|max:20',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
                'status' => 'required',
                'role' => 'required',
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
                'role.required' => 'Select your user role!'
            ]
        );
        $email = $request->email;
        //duplicate email check
        $check = Customer::where([
            ['email', '=', $email]

        ])->first();
        if ($check) {
            $request->session()->flash('database-error', 'Email already taken! use another one!');
            return redirect('addCustomer');
        } else {
            $var = new Customer();
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->role = $request->role;
            $var->status = $request->status;
            $var->save();
            $request->session()->flash('customer-added', 'Customer Added!');
            return redirect('addCustomer');
        }
    }
    // delete customer by admin
    function deleteCustomer(Request $request)
    {
        $customer = Customer::where('id', $request->id)->first();
        $destination = 'uploads/customerProfile/' . $customer->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $customer->delete();
        $request->session()->flash('customer-delete', 'Customer Deleted Successfully!');
        return redirect('customerList');
    }
     // send data to editCustomer page for edit by admin
     function EditCustomer($id)
     {
         $customers = Customer::find($id);
         return view('pages.customer.editCustomer', ['customers' => $customers]);
     }
     //update customer info by admin
    function updateCustomer(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:4|max:20',
                'email' => 'required|email',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'address' => 'required',
                'status' => 'required',
                'role' => 'required',
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
                'role.required' => 'Select your user role!'
            ]
        );

        $email = $request->email;
        $check = Customer::where([
            ['email', '=', $email]
        ])->first();
        $customer = Customer::find($request->id);

        if ($customer->email == $request->email) {
            $var = Customer::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->role = $request->role;
            $var->status = $request->status;
            $var->update();
            $request->session()->flash('customer-update', 'Customer Updated Successfully!');
            return redirect('customerList');
        }
        if ($check) {
            $request->session()->flash('database-error', 'Email already taken! use another one!');
            return redirect('editCustomer/' . $request->id);
        } else {
            $var = Customer::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->role = $request->role;
            $var->status = $request->status;
            $var->update();
            $request->session()->flash('customer-update', 'Customer Updated Successfully!');
            return redirect('customerList');
        }
    }
    //show every single customer all orders
    public function customerOrders($id)
    {
        $customers = Customer::find($id);
        $customer = Customer::where('id', $customers->id)->first();
        $customerOrders =  $customer->orders; // function 
        return view('pages.customer.customerOrders')->with(['customer' => $customers, 'orders' => $customerOrders]);
    }
     //show every single customer all productRatings
     public function customerP_rating($id)
     {
         $customers = Customer::find($id);
         $customer = Customer::where('id', $customers->id)->first();
         $customerP_ratings =  $customer->p_ratings; // function 
         return view('pages.rating.customersAll_P_rating')->with(['customer' => $customers, 'ratings' => $customerP_ratings]);
     }
     public function customerS_rating($id)
     {
         $customers = Customer::find($id);
         $customer = Customer::where('id', $customers->id)->first();
         $customerS_ratings =  $customer->s_ratings; // function 
         return view('pages.rating.customersAll_S_rating')->with(['customer' => $customers, 'ratings' => $customerS_ratings]);
     }
}
