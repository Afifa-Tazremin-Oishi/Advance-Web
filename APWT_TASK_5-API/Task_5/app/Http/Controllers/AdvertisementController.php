<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;

class AdvertisementController extends Controller
{
    //
   
    public function showList()
    {
        return view('pages.advertisement.advertisementList');
    }
    public function listingAdvertisement(Request $request)
    {
        $this->validate(
            $request,
            [
                'Location' => 'required|min:4|max:20',
                'Address' => 'required',
                'Floor' => 'required',
                'Details' => 'required',
               
            ],
            [
                'Location.required' => 'Required Field',
                'Address.min' => 'Must not be less than 4 characters!',
                'Floor.max' => 'Must be less than 10 characters!',
                'Details.required' => 'Required Field',
                
            ]
        );

        $advertisement = new Advertisement();
        $advertisement->Location = $request->Location;
        $advertisement->Address = $request->Address;
        $advertisement->Floor = $request->Floor;
        $advertisement->Details = $request->Details;
        
        $advertisement->save();
        $request->session()->flash('advertisement-added', 'Advertisement Added!');
        return redirect('addAdvertisement');
    }
    public function allAdvertisement()
    {
        $allAdvertisements = Advertisement::all();
        return view('pages.advertisement.addAdvertisement', ['allAdvertisements' => $allAdvertisements]);
    }
    public function advertisementList()
    {
        $allAdvertisements = Advertisement::all();
        return view('pages.advertisement.advertisementList', ['allAdvertisements' => $allAdvertisements]);
    }
    function deleteAdvertisement(Request $request)
    {
        $advertisement = Advertisement::where('id', $request->id)->first();
       
        $advertisement->delete();

        $request->session()->flash('advertisement-delete', 'Advertisement Deleted Successfully!');

        return redirect('advertisementList');
    }
   
    
    
    
    
}
