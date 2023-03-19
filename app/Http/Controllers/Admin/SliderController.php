<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\Slider;
use File;
use Image;
use Session;
    
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        
        $data = Slider::all();

         return view('admin.slider.index',compact('data'));
			
    }
    
   
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
           // 'photo' => 'required',
        ]);
    
    $photo = "";
        if($request->file('photo')){
            
                $image = $request->file('photo');
                $path = $image->getRealPath();      
                $photo =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'slider';
                $image->move($destinationPath, $photo);
             }
             
             
        $input = $request->all();
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
        $input['photo'] = $photo;
        $slider = Slider::create($input);
       
        return redirect()->route('admin.slider.index')
                        ->with('success','service created successfully');
    }
    
    
	
	public function create(Request $request){
	    
        return view('admin.slider.create');
        
    }
    
	public function edit(Request $request,$id){
          $data = Slider::find($id);
        return view('admin.slider.edit',compact('data'));
			
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $user = Slider::find($id);
        $input = $request->all();
        $photo = "";
         if($request->file('photo')){
            
                $image = $request->file('photo');
                $path = $image->getRealPath();      
                $photo =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'slider';
                $image->move($destinationPath, $photo);
             }
    
         
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
        
        
        $user->update($input);
        $user->update(['photo' => $photo]);
      
       
        return redirect()->route('admin.slider.index')
                        ->with('success','slider updated successfully');
    }
    
    
   public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = Slider::find($request->slider_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/slider')->with('success','slider Active successfully');
        }else{
             $FetchData = Slider::find($request->slider_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/slider')->with('success','slider Inactive successfully');
        }
		
        return view('admin.slider.show');
			
    }
    
     public function destroy(Request $request)
     {
   $delete = Slider::where('id', $request->slider_delete_id)->delete();
    return redirect()->route('admin.slider.index')
         ->withSuccess(__('Slider deleted successfully.'));
}
    
    
   
}