<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\Services;
use App\Models\ServicesType;
use App\Models\ServiceTypesDropdown;
use App\Models\Status;
use App\Models\DocType;
use App\Models\ServiceDetail;
use App\Models\ServiceDocuments;
use File;
use Image;

use Session;
    
class ServiceTypeDropdownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        
        $data = ServiceTypesDropdown::select('service_types_dropdown.*','service_types.name as service_type_name')
        ->leftjoin('service_types','service_types.id','service_types_dropdown.service_type_id')->orderBy('id','ASC')->get();
    
        $docs = Status::orderBy('id')->get();

         return view('admin.service_type_dropdown.index',compact('data','docs'));
			
    }
    
   
     
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'service_type_id' => 'required',
         
           
        ]);
    
   
                         $service_document = new ServiceTypesDropdown;
                        $service_document->name = $request->name;
                         $service_document->service_type_id = $request->service_type_id;
                        $service_document->status = 0;
                		$service_document->save(); 

        return redirect()->route('admin.service_type_dropdown.index')->with('success','service Type created successfully');
    }
    
	
	public function create(Request $request){
	    
	    $ServicesType = ServicesType::get();
	    
        return view('admin.service_type_dropdown.create',compact('ServicesType'));
        
    }
    
    
	public function edit(Request $request,$id){
          $data = ServiceTypesDropdown::find($id);
         
          
	    $ServicesType = ServicesType::get();
          
           
        return view('admin.service_type_dropdown.edit',compact('data','ServicesType'));
			
    }
    
    public function update(Request $request, $id)
    {
        $service=ServiceTypesDropdown::find($id);
    
             $this->validate($request, [
            'name' => 'required',
         
           
        ]);
       
      
        

                        $service->name = $request->name;
                         $service->service_type_id = $request->service_type_id;
                        $service->status = 0;
                		$service->save(); 
                 
        return redirect()->route('admin.service_type_dropdown.index')
                        ->with('success','service Type updated successfully');
    }
    
    
    
   public function service_type_dropdown(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = ServiceTypesDropdown::find($request->service_type_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/service_type_dropdown')->with('success','ServiceTypesDropdown Inactive successfully');
        }else{
             $FetchData = ServiceTypesDropdown::find($request->service_type_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/service_type_dropdown')->with('success','ServiceTypesDropdown Active  successfully');
        }
			
    }
     public function destroy(Request $request)
     {
   $delete = ServiceTypesDropdown::where('id', $request->ServicesType_id)->delete();
    return redirect()->route('admin.service_type_dropdown.index')
         ->withSuccess(__('ServiceTypesDropdown deleted successfully.'));
}
    
    
    
   
}