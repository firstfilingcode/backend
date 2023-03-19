<?php    
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\OrderPriority;
use File;
use Image;
use Session;
    
class OrderPriorityController extends Controller
{
    
    public function create(Request $request){
	    
	    
        return view('admin.order_priority.create');
        
    }
    
     public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'color_code' => 'required',
           
            
            
        ]);
        
        $input = $request->all();
       
      
        $tamplate = OrderPriority::create($input);
        
       
        return redirect()->route('admin.order_priority.index')
                        ->with('success','tamplates created successfully');
    }
    
    public function index(Request $request){
	    
	    $data = OrderPriority::orderBy('id','DESC')->get();
	    
        return view('admin.order_priority.index',compact('data'));
        
    }
   
    
    public function edit(Request $request, $id){    
        
	    $data = OrderPriority::find($id);
	    
        return view('admin.order_priority.edit',compact('data'));
        
    }
   
    public function update(Request $request, $id)
    {
        $this->validate($request, [
         'name' => 'required',
            'color_code' => 'required',
           
        ]);
        $tamplate = OrderPriority::find($id);
        $input = $request->all();
      
        
        $tamplate->update($input);
        
         return redirect()->route('admin.order_priority.index')
                        ->with('success','Order Priority updated successfully');
    }
    
    
     public function destroy(Request $request)
{
   $delete = OrderPriority::where('id', $request->dalete_id)->delete();
    return redirect()->route('admin.templete_view.index') ->withSuccess(__('tamplate deleted successfully.'));
}

 public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = OrderPriority::find($request->order_priority_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/order_priority')->with('success','Order Priority Inactive successfully'); 
        }else{
             $FetchData = OrderPriority::find($request->order_priority_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/order_priority')->with('success','Order Priority Active successfully');
        }
		
    }
}