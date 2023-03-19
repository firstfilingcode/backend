<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\WebMeta;
use App\Models\Route;
use File;
use Image;
use Session;
    
class WebMetaController extends Controller
{
     public function index(Request $request){
        
         $data = WebMeta :: select ('web_meta.*','rotues.page_name as pgname')
        ->LeftJoin('routes as rotues','rotues.id','web_meta.page_name')->OrderBy('id','DESC')->get();
        return view('admin.web_meta.index',compact('data'));
        
    }
    
    public function create(Request $request){
        $routes = Route::orderBy('id')->get();
        return view('admin.web_meta.create',compact('routes'));
        
    }
    
    public function store(Request $request){
        
        $this->validate($request, [
            //'page_name' => 'required',
            'tittle' => 'required',
            'meta_kyewords' => 'required',
           'meta_description' => 'required',
           // 'photo' => 'required',
        ]);
    $photo = "";
        if($request->file('photo')){
            
                $image = $request->file('photo');
                $path = $image->getRealPath();      
                $photo =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'WebMeta';
                $image->move($destinationPath, $photo);
             }
             
        $input = $request->all();
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
        $input['photo'] = $photo;
        $offer = WebMeta::create($input);
       
        return redirect()->route('admin.web_meta.index')
                        ->with('success','Web Meta created successfully');
    }
    
   
    
    
    public function show(Request $request,$id){
        
        $data = WebMeta::all();
        
        return view('admin.web_meta.show',compact('data'));
    }
    
    public function edit(Request $request, $id){    
        
	    $data = WebMeta::find($id);
	     $page_name = Route :: orderBy('id')->get();
            return view('admin.web_meta.edit',compact('data','page_name'));
        
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
           
        ]);
        
        $web_meta = WebMeta::find($id);
        $input = $request->all();
        $photo = "";
         if($request->file('photo')){
            
                $image = $request->file('photo');
                $path = $image->getRealPath();      
                $photo =  time().uniqid().$image->getClientOriginalName();
                $destinationPath = env('IMAGE_UPLOAD_PATH').'WebMeta';
                $image->move($destinationPath, $photo);
              }
     $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
         $web_meta->update($input);
         $web_meta->update(['photo' => $photo]);
         return redirect()->route('admin.web_meta.index')
                        ->with('success','WebMeta updated successfully');
    }
    
   public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = WebMeta::find($request->web_meta_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/web_meta')->with('success','Web Meta Active successfully');
        }else{
             $FetchData = WebMeta::find($request->web_meta_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/web_meta')->with('success','Web Meta Inactive successfully');
        }
		
    }
       public function destroy(Request $request)
     {
   $delete = WebMeta::where('id', $request->WebMeta_id)->delete();
    return redirect()->route('admin.web_meta.index')
         ->withSuccess(__('WebMeta deleted successfully.'));
}
    
}