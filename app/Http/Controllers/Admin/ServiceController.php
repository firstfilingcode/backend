<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\Services;
use App\Models\Route;
use App\Models\DocType;
use App\Models\ServiceDetail;
use App\Models\ServiceDocuments;
use App\Models\ServicesType;
use App\Models\Status;
use File;
use Image;

use Session;
    
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
 
        $data = Services ::select('services.*','route.page_name as pname','service_types.name as service_types')
                            ->leftJoin('routes as route','services.page_name','route.route')
                            ->leftJoin('service_types as service_types','services.service_type_id','service_types.id')->orderBy('id','DESC')->get();
        
         return view('admin.service.index',compact('data'));
			
    }
    
   
    public function store(Request $request)
    {
        
        $this->validate($request, [
           // 'name' => 'required',
            'ca_share' => 'required',
           
        ]);
       
        $status_id = null;
     if(!empty($request->status_id)){
                       $status_id = implode(',', $request->status_id);
     }
        $input = $request->all();
        $status = isset($request->status) ? 1 : 0;
        $input['slug'] = Str::slug($request->name);
        $input['status'] = $status;
        $input['status_id'] = $status_id;
        $service = Services::create($input);
        $service_id = $service['id'];
       for ($count = 0; $count <= count($request->category); $count++) {
                    if (isset($request->category[$count])) {
                         $statu = isset($request->web_status[$count]) ? 1 : 0;
                       $service_deta = new ServiceDetail;
                        $service_deta->service_id = $service_id;
                        $service_deta->category = $request->category[$count];
                        $service_deta->price = $request->price[$count];
                        $service_deta->short_des = $request->short_des[$count];
                         $service_deta->web_status = $statu;
                		$service_deta->save(); 
                    }
       }
                    
                    if(!empty($request->document_types_id)){
                       $documents = implode(',', $request->document_types_id);
                    
                       $service_document = new ServiceDocuments;
                        $service_document->service_id = $service_id;
                        $service_document->document_types_id = $documents;
                		$service_document->save(); 
                    }
        return redirect()->route('admin.service.index')
                        ->with('success','service created successfully');
    }
    
    
	
	public function create(Request $request){
	    $routes = Route::orderBy('id')->get();
	    $docs = DocType::orderBy('id')->get();
	    $service_type_id = 1;
        return view('admin.service.create',compact('routes','docs','service_type_id'));
        
    }
    
	public function edit(Request $request,$id){
          $data = Services::find($id);
          $routes = Route::orderBy('id')->get();
          $docs = DocType::orderBy('id')->get();
           $service_detail = ServiceDetail::where('service_id',$id)->get(); 
          
        return view('admin.service.edit',compact('data','routes','docs'),compact('service_detail'));
			
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            //'name' => 'required',
            'ca_share' => 'required',
        ]);
       
        $status_id = null;
     if(!empty($request->status_id)){
                       $status_id = implode(',', $request->status_id);
     }
      
        $user = Services::find($id);
        $input = $request->all();
        
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
        $input['status_id'] = $status_id;
        
       $user->update($input);
        for ($count = 0; $count <= count($request->category); $count++) {
                    if (isset($request->category[$count])) {
                    $service_deta = ServiceDetail::find($request->service_detail_id[$count]);
                        $statu = isset($request->web_status[$count]) ? 1 : 0;
                        $service_deta->service_id = $id;
                        $service_deta->category = $request->category[$count];
                        $service_deta->price = $request->price[$count];
                        $service_deta->short_des = $request->short_des[$count];
                        $service_deta->web_status =$statu;  
                		$service_deta->save(); 
                    }
       }
       $documents =null;
        if(!empty($request->document_types_id)){
                       $documents = implode(',', $request->document_types_id);
                    }
                    $service_document = ServiceDocuments::where('service_id',$id)->get()->first();
                    if(!empty($service_document)){
                        $service_document =$service_document;
                    }else{
                      $service_document = new ServiceDocuments;  
                    }
                       
                        $service_document->service_id = $id;
                        $service_document->document_types_id = $documents;
                		$service_document->save(); 
                 
        return redirect()->route('admin.service.index')
                        ->with('success','service updated successfully');
    }
    
    
   public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = services::find($request->services_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/service')->with('success','service Active successfully');
        }else{
             $FetchData = services::find($request->services_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/service')->with('success','service Inactive successfully');
        }
			
    }
    
     public function destroy(Request $request)
     {
      $delete = services::where('id', $request->service_delete_id)->delete();
    return redirect()->route('admin.service.index')
         ->withSuccess(__('Service deleted successfully.'));
}
    
       public function service_type_status(Request $request){
      $routes = Route::orderBy('id')->get();
	    $docs = DocType::orderBy('id')->get();
        $service_type_id = $request->service_type;
            return view('admin.service.create',compact('routes','docs','service_type_id'));
            
        
    } 
    
     public function service_routes(Request $request, $id)
    {
       

        $this->validate($request, [
            //'route' => 'required',
            'page_name' => 'required',
           
        ]);
        $blog = Route::find($id);
        $input = $request->all();
         $blog->update($input);
        $Services_id = Services::where('page_name',$request->route)->first();
        
          return redirect()->route('admin.service.edit',$Services_id->id)
                        ->with('success','Route updated successfully');
    }
    
   
}