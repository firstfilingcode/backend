<?php    
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Setting;
use DB;
use Hash;
use Illuminate\Support\Arr;
use File;
    
class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		 
         $setting = Setting::first();		 
		 return view('admin.settings.edit',compact('setting'));
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
        
		/* $this->validate($request, [
            'title_en' => 'required',           
            'title_ar' => 'required',           
            'message_en' => 'required',           
            'message_ar' => 'required'		
        ]);   */
    
       
         $setting = Setting::find($id);
		 
		 $setting->update($request->all()); 
                if($request->file('logo')){
                 $image = $request->file('logo');
                $path = $image->getRealPath();      
                $imageName =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'logo';
                $image->move($destinationPath, $imageName);  
        $setting->logo = $imageName;
        $setting->save();
             } 
		
                if($request->file('footer_logo')){
                 $image = $request->file('footer_logo');
                $path = $image->getRealPath();      
                $imageName =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'logo';
                $image->move($destinationPath, $imageName);  
        $setting->footer_logo = $imageName;
        $setting->save();
             } 
		
        return redirect()->route('admin.settings.index')->with('success','Setting updated successfully');
    }
    
   
}