<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\Clint;
use File;
use Image;
use Session;
    
class ClintsController extends Controller
{
    
    public function create(Request $request){
	    
	    
        return view('admin.clints.create');
        
    }
    
     public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
           
        ]);
    
    $photo = "";
        if($request->file('photo')){
            
                $image = $request->file('photo');
                $path = $image->getRealPath();      
                $photo =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'clints';
                $image->move($destinationPath, $photo);
             }
             
             
        $input = $request->all();
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
        $input['photo'] = $photo;
        $clint = Clint::create($input);
        
       
        return redirect()->route('admin.clints.index')
                        ->with('success','Clints created successfully');
    }
    
    public function index(Request $request){
	    
	    $data = Clint::all();
	    
        return view('admin.clints.index',compact('data'));
        
    }
    
    public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = Clint::find($request->clints_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/clints')->with('success','Clints Active successfully');
        }else{
             $FetchData = Clint::find($request->clints_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/clints')->with('success','Clints Inactive successfully');
        }
		
    }
    
    
    public function edit(Request $request, $id){    
        
	    $data = Clint::find($id);
	    
        return view('admin.clints.edit',compact('data'));
        
    }
    
    
    public function update(Request $request, $id)
    {
       
        $this->validate($request, [
            'name' => 'required',
        ]);
        $clint = Clint::find($id);
        $input = $request->all();

        if($request->file('photo')){
            
                $image = $request->file('photo');
                $path = $image->getRealPath();      
                $photo =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'clints';
                $image->move($destinationPath, $photo);
                $clint->update(['photo' => $photo]);
              }
              
     $status = isset($request->status) ? 1 : 0;
       
         $clint->update(['name' => $request->name,'status' => $status]);
         
         return redirect()->route('admin.clints.index')
                        ->with('success','Clints updated successfully');
    }
    
    
   public function destroy(Request $request)
     {
   $delete = Clint::where('id', $request->clint_dalete_id)->delete();
    return redirect()->route('admin.clints.index')->withSuccess(__('Clints deleted successfully.'));
}

}