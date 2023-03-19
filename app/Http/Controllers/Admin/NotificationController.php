<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Illuminate\Support\Arr;
use App\Models\Notification;
use File;
use App\Http\Requests\StoreCustomer;
use Image;
use Session;
    
class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        
	$data = Notification::all();
       
         return view('admin.notification.index',compact('data'));
			
    }
    
    public function create(Request $request){
        
        return view('admin.notification.create');
        
    }
    
    public function store(Request $request){
        
        $this->validate($request, [
           'message' => 'required',
        ]);
        
        $input = $request->all();
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
        $data = Notification::create($input);
        
        return redirect()->route('admin.notification.index')
                        ->with('success','Notification created successfully');
        
    }
    
    public function edit(Request $request, $id){    
        
	    $data = Notification::find($id);
	    
        return view('admin.notification.edit',compact('data'));
        
    }
    
    public function update(Request $request,$id){
        
        $this->validate($request, [
           'message' => 'required',
        ]);
        
      $blog = Notification ::find($id);
        $input = $request->all();
       
       $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
         $blog->update($input);
        
        return redirect()->route('admin.notification.index')
                        ->with('success','Notification Updated successfully');
        
    }
    
    
    public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = Notification::find($request->notification_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/notification')->with('success','Notification Active successfully');
        }else{
             $FetchData = Notification::find($request->notification_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/notification')->with('success','Notification Inactive successfully');
        }
		
    }
    
    
     public function destroy(Request $request)
    {
       $delete = Notification::where('id', $request->notification_delete_id)->delete();
        return redirect()->route('admin.notification.index')
             ->withSuccess(__('Notification deleted successfully.'));
    }
	
	
    
}