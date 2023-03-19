<?php    
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\About;
use DB;
use Hash;
use Illuminate\Support\Arr;
use File;
use Carbon; 
class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		 
         $about = About::first();		 
		 return view('admin.about.edit',compact('about'));
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
        
    
       
         $about = About::find($id);
		 

		 $about->update($request->all()); 
                if($request->file('photo')){
                 $image = $request->file('photo');
                $path = $image->getRealPath();      
                $imageName =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'about';
                $image->move($destinationPath, $imageName);  
        $about->photo = $imageName;
        $about->save();
             } 
		
        return redirect()->route('admin.about.index')->with('success','About updated successfully');
    }
    
   
}