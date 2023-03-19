<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Setting;	

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
	
       
    }

      public function privacy(Request $request)
    {
		 
         $setting = Setting::first();		 
		 return view('privacy',compact('setting'));
    }
	
	  public function terms(Request $request)
    {
		 
         $setting = Setting::first();		 
		 return view('terms',compact('setting'));
    }
}
