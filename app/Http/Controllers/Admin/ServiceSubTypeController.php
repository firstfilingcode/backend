<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\Services;
use App\Models\ServicesType;
use App\Models\Route;
use App\Models\Status;
use App\Models\DocType;
use App\Models\ServiceDetail;
use App\Models\ServiceSubType;
use File;
use Image;

use Session;
    
class ServiceSubTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        
        $data = ServiceSubType::select('service_sub_types.*','service_types.name as service_types')
                            ->leftJoin('service_types as service_types','service_sub_types.service_type_id','service_types.id')->orderBy('id','ASC')->get();;
    

         return view('admin.service_sub_type.index',compact('data'));
			
    }
    
   
     
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
         
           
        ]);
                       $service_sub = new ServiceSubType;
                        $service_sub->name = $request->name;
                        $service_sub->service_type_id = $request->service_type_id;
                        $service_sub->service_type_dropdown_id = $request->service_type_dropdown_id;
                        $service_sub->status = 1;
                		$service_sub->save(); 

        return redirect()->route('admin.service_sub_type.index')->with('success','service Sub Type created successfully');
    }
    
	
	public function create(Request $request){
	    

        return view('admin.service_sub_type.create');
        
    }
    
    
	public function edit(Request $request,$id){
          $data = ServiceSubType::find($id);
         
       
           
        return view('admin.service_sub_type.edit',compact('data'));
			
    }
    
    public function update(Request $request, $id)
    {
        $service=ServiceSubType::find($id);
    
             $this->validate($request, [
            'name' => 'required',
         
           
        ]);
       
    
  
                        $service->name = $request->name;
                         $service->service_type_id = $request->service_type_id;
                         $service->service_type_dropdown_id = $request->service_type_dropdown_id;
                        $service->status = 1;
                		$service->save(); 
                 
        return redirect()->route('admin.service_sub_type.index')
                        ->with('success','service Sub Type updated successfully');
    }
    
    
    
   public function service_sub_type(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = ServiceSubType::find($request->service_sub_type_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/service_sub_type')->with('success','Services Sub Type Active successfully');
        }else{
             $FetchData = ServiceSubType::find($request->service_sub_type_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/service_sub_type')->with('success','Services Sub Type Inactive successfully');
        }
			
    }
     public function destroy(Request $request)
     {
   $delete = ServiceSubType::where('id', $request->ServicesType_id)->delete();
    return redirect()->route('admin.service_sub_type.index')
         ->withSuccess(__('Services Sub Type deleted successfully.'));
}
    
    
    public function Search_service_Sub_type(Request $request,$id){
           
        if(!empty($id)){
        $headermenu = array();      
         
            $headermenu = ServiceSubType::where('service_type_id',$id)->get();
            
            $Data ='<option value="">Select</option>';
            foreach($headermenu as $category){
            $Data.='
            <option value="'.$category->id.'">'.$category->name.'</option>';
            }
            echo $Data;
            
        } 
    } 
    
    
   
}