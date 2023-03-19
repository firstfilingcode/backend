<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\DocType;
use File;
use Image;
use Session;
    
class ServiceDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
   public function create(Request $request){
	    
	    
        return view('admin.service_document.create');
        
    }
    
  public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            
        ]);
    
        $input = $request->all();
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
        $service_document = DocType::create($input);
       
        return redirect()->route('admin.service_document.index')
                        ->with('success','Document Types created successfully');
    }
    
    public function index(Request $request){
        
	    $data = DocType::all();
	    
        return view('admin.service_document.index',compact('data'));
        
    }
    
    public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = DocType::find($request->document_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/service_document')->with('success','Service Document Inactive successfully');
        }else{
             $FetchData = DocType::find($request->document_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/service_document')->with('success','Service Document Active successfully');
        }
		
    }
    
    public function show(Request $request,$id){
        
        $data = DocType::find($id);
        
        return view('admin.service_document.show',compact('data'));
    }
    public function edit(Request $request, $id){    
        
	    $data = DocType::find($id);
	    
        return view('admin.service_document.edit',compact('data'));
        
    }
    
    public function update(Request $request, $id)
    {
       
        $this->validate($request, [
            'name' => 'required',
        ]);
        $data = DocType::find($id);
        $input = $request->all();
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
        $data->update($input);
         return redirect()->route('admin.service_document.index')
                        ->with('success','Service Document updated successfully');
    }
    
    
        public function destroy(Request $request)
     {
   $delete = DocType::where('id', $request->Service_delete_id)->delete();
    return redirect()->route('admin.service_document.index')
         ->withSuccess(__('Service Document deleted successfully.'));
}
   
   
   	public function service_documentdeleteAll(Request $request)
    {
        
        	foreach( $request->service_document as $value){

        	    DocType::find($value)->delete();
        	   
        	}
        
           return redirect()->route('admin.service_document.index')
                        ->with('success','Service Document deleted successfully');
       	
       
    }
}