<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Map;	
use App\Models\Coupon;	
use App\Models\Package;	
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\Audio;
use App\Models\Course;
use App\Models\User;
use Auth;	

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
	
        $this->middleware('auth:admin-web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
       $data = User::find(Auth::user()->id);
	if($data->role_id  == 1){
	    
        return view('admin.dashboard.admin');        
    }elseif($data->role_id   == 2){
         return view('admin.dashboard.rm');  
    }elseif($data->role_id   == 3){
        if($data->click_permission == 1){
            return redirect('admin/ca_find_orders');
        }else{
            return view('admin.dashboard.ca');
        }
        
           
    }elseif($data->role_id   == 4){
         return view('admin.dashboard.other');  
    }
   }
}
