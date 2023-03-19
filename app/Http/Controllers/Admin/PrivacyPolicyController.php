<?php    
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Setting;
use DB;
use Hash;
use Illuminate\Support\Arr;
use File;
    
class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		 
         $setting = Setting::first();		 
		 return view('admin.privacy_policy.edit',compact('setting'));
    }
    
    
    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        
         $setting = Setting::find($id);
		 
		 $setting->update($request->all()); 
               
        $setting->save();
           
		
        return redirect()->route('admin.privacy_policy.index')->with('success','Privacy Policy updated successfully');
    }
    
   
}