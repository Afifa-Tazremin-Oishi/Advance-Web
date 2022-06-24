<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\File;

class SellerController extends Controller
{
    // show all sellers in sellerList page for (admin)
    public function sellerList()
    {
        $allSellers = Seller::all();
        return view('pages.seller.sellerList', ['allSellers' => $allSellers]);
    }
    // send data to updateSellerStatus page for  approved seller status by (admin)
    function approvedSellerEdit($id)
    {
        $Seller = Seller::find($id);
        return view('pages.seller.updateSellerStatus', ['status' => $Seller]);
    }
    //approved seller status by (admin)
    function approvedSeller(Request $request)
    {
        $this->validate(
            $request,
            [
                'status' => 'required'
            ],
        ); 
        $seller = Seller::find($request->id);
        $seller->id = $request->id;
        $seller->status = $request->status;
        $seller->update();

        $request->session()->flash('seller-approved', 'Seller Status update!');
        return redirect('sellerList');
    }
    // pass value for addSeller page for add seller by (admin)
    public function allSeller()
    {
        $allSellers = Seller::all();
        return view('pages.seller.addSeller', ['allSellers' => $allSellers]);
    }
    // ADD seller by (admin)
    public function listingSeller(Request $request)
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
        $check = Seller::where([
            ['email', '=', $email]
        ])->first();
        if ($check) {
            $request->session()->flash('database-error', 'Email already taken!');
            return redirect('addSeller');
        } else {
            $var = new Seller();
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->role = $request->role;
            $var->status = $request->status;
            $var->save();
            
            $request->session()->flash('seller-added', 'Seller Added!');
            return redirect('addSeller');
        }
    }
    // delete sellers by (admin)
    function deleteSeller(Request $request)
    {
        $product = Seller::where('id', $request->id)->first();
        $destination = 'uploads/sellerProfile/' . $product->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $product->delete();
        $request->session()->flash('seller-delete', 'Seller Deleted Successfully!');
        return redirect('sellerList');
    }
     
    // send data to editSeller page for edit by (admin)
    function EditSeller($id)
    {
        $sellers = Seller::find($id);
        return view('pages.seller.editSeller', ['sellers' => $sellers]);
    }
    //update seller info by (admin)
    function updateSeller(Request $request)
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
        $check = Seller::where([
            ['email', '=', $email]
        ])->first();
        $sellers = Seller::find($request->id);

        if ($sellers->email == $request->email) {
            $var = Seller::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->role = $request->role;
            $var->status = $request->status;
            $var->update();
            $request->session()->flash('seller-update', 'Seller Updated Successfully!');
            return redirect('sellerList');
        }
        if ($check) {
            $request->session()->flash('database-error', 'Email already taken! use another one!');
            return redirect('editSeller/' . $request->id);
        } else {
            $var = Seller::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password =$request->password;
            $var->role = $request->role;
            $var->status = $request->status;
            $var->update();
            $request->session()->flash('seller-update', 'Seller Updated Successfully!');
            return redirect('sellerList');
        }
    }
    //every single seller Products for (seller)
    public function sellerProduct($id)
    {
        $sellers = Seller::find($id);
        $seller = Seller::where('id', $sellers->id)->first();
        $sellerProducts =  $seller->products; // function
        return view('pages.product.sellerProduct')->with(['seller' => $sellers, 'products' => $sellerProducts]);
    }
     //every single seller all order for (seller)
     public function sellerOrder($id)
     {
         $sellers = Seller::find($id);
         $seller = Seller::where('id', $sellers->id)->first();
         $sellerOrders=  $seller->orders; // function 
         return view('pages.order.sellerOrderList')->with(['seller' => $sellers, 'orders' => $sellerOrders]);
     }
     


































    //Show seller profile for (seller)
    public function showSellerProfile()
    {
        if (session('role') == 'seller') {
            $seller = Seller::where('id', Session()->get('id'))->first();
            return view('pages.dashboard.dashboard')->with('seller', $seller);
        }
    }





















    // delete seller account by seller own (seller)
    function deleteSellerAccount(Request $request)
    {
        $seller = Seller::where('id', $request->id)->first();
        $destination = 'uploads/sellerProfile/' . $seller->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $seller->delete();
        session()->flush();
        return redirect('/');
    }
    //Edit seller profile info by (seller)
    function EditSellerProfile($id)
    {
        $seller = Seller::find($id);
        return view('pages.seller.editSellerProfile', ['seller' => $seller]);
    }
    // update seller profile info by (seller)
    function updateSellerProfile(Request $request)
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
        $check = Seller::where([
            ['email', '=', $email]
        ])->first();
        $sellers = Seller::find($request->id);
        if ($sellers->email == $request->email) {
            $var = Seller::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->update();
            $request->session()->flash('seller-update', 'Profile Update successfully');
            return redirect('sellerDashboard');
        }
        if ($check) {
            $request->session()->flash('database-error', 'Email already taken! use another one!');
            return redirect('editSellerProfile/' . $request->id);
        } else {
            $var = Seller::find($request->id);
            $var->name = $request->name;
            $var->email = $request->email;
            $var->phone = $request->phone;
            $var->address = $request->address;
            $var->password = $request->password;
            $var->update();
            $request->session()->flash('seller-update', 'Profile Update successfully');
            return redirect('sellerDashboard');
        }
    }

    //add seller profile image by (seller)
    public function addSellerPhoto(Request $request)
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
        $var = Seller::where('id', session()->get('id'))->first();
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
            $file->move('uploads/sellerProfile/', $fileName);
            $var->image =  $fileName;
        }
        $var->update();
        $request->session()->flash('image-added', 'Uploaded profile picture!');
        return redirect('sellerDashboard');
    }
    // send data to changeSellerImage page for change image by (seller)
    function changeSellerImage($id)
    {
        $seller = Seller::find($id);
        return view('pages.seller.changeSellerImage', ['seller' => $seller]);
    }
    //change profile image by (seller)
    function updateSellerImage(Request $request)
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
        $var = Seller::find($request->id);
        $var->name = $request->name;
        $var->email = $request->email;
        $var->address = $request->address;
        $var->password = $request->password;
        $var->phone = $request->phone;
        $var->role = $request->role;
        $var->status = $request->status;

        if ($request->hasFile('image')) {
            
            $destination = 'uploads/sellerProfile/' . $var->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('uploads/sellerProfile/', $fileName);
            $var->image =  $fileName;
        }
        $var->update();
        $request->session()->flash('image-update', 'Image changed successfully!');
        return redirect('sellerDashboard');
    }
}
