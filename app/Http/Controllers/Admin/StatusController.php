<?php    
namespace App\Http\Controllers\Admin;    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Status;
use DB;
use Hash;
use Illuminate\Support\Arr;
use File;
use App\Http\Requests\StoreCoupon;
use Image;
class StatusController extends Controller

{
    public function index()
    {
         $data = Status::orderBy('id','ASC')->get();
       
         return view('admin.statues.index',compact('data'));
    }
    
    public function create()
    {
        return view('admin.statues.create');
    }
    
     public function show(Request $request,$id){
        
        $data = Status::find($id);
        
        return view('admin.statues.show',compact('data'));
    }    
    
    
      public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:status,name,',
            'order_by' => 'required|unique:status,order_by,',
           
        ]);
    
             
             
        $input = $request->all();
        $status = isset($request->status) ? 1 : 0;
        $input['status'] = $status;
        $input['name'] = $request->name;
        $input['order_by'] = $request->order_by;
        $input['status_massage'] = $request->status_massage;
        $input['status'] = $request->status;
        $blog = Status::create($input);
       
        return redirect()->route('admin.order_status.index')
                        ->with('success','Status created successfully');
    }
    
   
    
   

    	public function edit(Request $request,$id){
          $data = Status::find($id);
        return view('admin.statues.edit',compact('data'));
			
    }
        
     public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|unique:status,name,'.$id,
            'order_by' => 'required|unique:status,order_by,'.$id,
        ]);
        $blog = Status::find($id);
        $input = $request->all();
      
        $status = isset($request->status) ? 0 : 1;
        $input['status'] = $status;
         $blog->update($input);
         $blog->update($input);
         
          return redirect()->route('admin.order_status.index')
                        ->with('success','Status updated successfully');
    }
    
    
    public function change_status(Request $request){
        if($request->status_name == 'Active'){
            $FetchData = Status::find($request->news_letters_id);
            $FetchData->update(['status'=>0]);
            return redirect('admin/order_status')->with('success','status Active successfully');
        }else{
             $FetchData = Status::find($request->news_letters_id);
            $FetchData->update(['status'=>1]);
            return redirect('admin/order_status')->with('success','status Inactive successfully');
        }
		
    }
         
       public function destroy(Request $request)
     {
   $delete = Status::where('id', $request->order_delete_id)->delete();
    return redirect()->route('admin.order_status.index')
         ->withSuccess(__('status deleted successfully.'));
}
}

