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
use App\Models\ServiceDocuments;
use File;
use Image;

use Session;
    
class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        
        $data = ServicesType::orderBy('id','ASC')->get();
    
        $docs = Status::orderBy('id')->get();

         return view('admin.service_type.index',compact('data','docs'));
			
    }
    
   
     
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
         
           
        ]);
    
        $documents = null;
        if(!empty($request->status_id)){
           $documents = implode(',', $request->status_id);
        }
                         $service_document = new ServicesType;
                        $service_document->status_id = $documents;
                        $service_document->name = $request->name;
                        $service_document->status = 1;
                		$service_document->save(); 

        return redirect()->route('admin.service_type.index')->with('success','service Type created successfully');
    }
    
	
	public function create(Request $request){
	    
	    $status = Status::get();
	    
        return view('admin.service_type.create',compact('status'));
        
    }
    
    
	public function edit(Request $request,$id){
          $data = ServicesType::find($id);
         
          $status = Status::orderBy('id')->get();
          
           
        return view('admin.service_type.edit',compact('data','status'));
			
    }
    
    public function update(Request $request, $id)
    {
        $service=ServicesType::find($id);
    
             $this->validate($request, [
            'name' => 'required',
         
           
        ]);
       
        $documents = null;
      if(!empty($request->status_id)){
           $documents = implode(',', $request->status_id);
        }
         $required_field = null;
         if(!empty($request->required_field)){
           $required_field = implode(',', $request->required_field);
        }
        
                        $service->status_id = $documents;
                        $service->required_field = $required_field;
                        $service->name = $request->name;
                        $service->status = 1;
                		$service->save(); 
                 
        return redirect()->route('admin.service_type.index')
                        ->with('success','service Type updated successfully');
    }
    
    
    
   public function service_type(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = ServicesType::find($request->service_type_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/service_type')->with('success','ServicesType Active successfully');
        }else{
             $FetchData = ServicesType::find($request->service_type_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/service_type')->with('success','ServicesType Inactive successfully');
        }
			
    }
     public function destroy(Request $request)
     {
   $delete = ServicesType::where('id', $request->ServicesType_id)->delete();
    return redirect()->route('admin.service_type.index')
         ->withSuccess(__('ServicesType deleted successfully.'));
}
    
    
    
   
}