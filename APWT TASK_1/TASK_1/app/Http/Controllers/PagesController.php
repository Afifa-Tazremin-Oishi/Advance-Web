<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        return view('home');

    }

    public function products(){
        $products=array("Banana", "Apple", "Orange","Tomato","Blue Berry","Broccoli");
         return view('products')
         ->with('products', $products);;
        //return $products;
    }

    public function teams(){
        $teams=array("Mr.X", "Mr.Y", "Mr.Z");
        return view('teams')
        ->with('teams', $teams);;
    }

    public function aboutUs(){
        return view('aboutUs');
    }

    public function contactUs(){
        return view('contactUs');
    }
}
